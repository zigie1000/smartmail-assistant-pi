<?php

if (!defined('ABSPATH')) {
    exit;
}

require_once(plugin_dir_path(__FILE__) . 'path/to/pi-sdk/autoload.php'); // Ensure the correct path to the Pi SDK

class WC_Gateway_Pi extends WC_Payment_Gateway {
    public function __construct() {
        $this->id = 'pi';
        $this->icon = ''; // Add a custom icon if needed
        $this->has_fields = true;
        $this->method_title = 'Pi Payment';
        $this->method_description = 'Accept payments in Pi cryptocurrency';

        $this->init_form_fields();
        $this->init_settings();

        $this->title = $this->get_option('title');
        $this->description = $this->get_option('description');

        add_action('woocommerce_update_options_payment_gateways_' . $this->id, array($this, 'process_admin_options'));
        add_action('woocommerce_thankyou_' . $this->id, array($this, 'thankyou_page'));
        add_action('woocommerce_api_' . strtolower(get_class($this)), array($this, 'webhook'));
    }

    public function init_form_fields() {
        $this->form_fields = array(
            'enabled' => array(
                'title' => 'Enable/Disable',
                'type' => 'checkbox',
                'label' => 'Enable Pi Payment',
                'default' => 'yes'
            ),
            'title' => array(
                'title' => 'Title',
                'type' => 'text',
                'description' => 'This controls the title the user sees during checkout.',
                'default' => 'Pi Payment',
                'desc_tip' => true,
            ),
            'description' => array(
                'title' => 'Description',
                'type' => 'textarea',
                'description' => 'This controls the description the user sees during checkout.',
                'default' => 'Pay with Pi cryptocurrency.',
            ),
        );
    }

    public function process_payment($order_id) {
        $order = wc_get_order($order_id);
        $amount = $order->get_total();
        $currency = get_option('woocommerce_currency');

        // Create a new Pi payment request
        $pi_payment_request = $this->create_pi_payment_request($order, $amount, $currency);
        if ($pi_payment_request && isset($pi_payment_request['transaction_id'])) {
            // Save transaction ID and wait for confirmation
            update_post_meta($order_id, '_pi_transaction_id', $pi_payment_request['transaction_id']);
            return array(
                'result' => 'success',
                'redirect' => $this->get_return_url($order),
            );
        } else {
            wc_add_notice('Payment error: Please try again.', 'error');
            return;
        }
    }

    private function create_pi_payment_request($order, $amount, $currency) {
        $pi_sdk = new PiSdk\PiPayment();

        try {
            $payment_request = $pi_sdk->createPayment([
                'amount' => $amount,
                'currency' => $currency,
                'metadata' => [
                    'order_id' => $order->get_id(),
                    'customer_email' => $order->get_billing_email()
                ]
            ]);

            return ['transaction_id' => $payment_request->id];
        } catch (Exception $e) {
            $order->add_order_note('Pi payment creation failed: ' . $e->getMessage());
            return false;
        }
    }

    public function webhook() {
        $request_body = file_get_contents('php://input');
        $request_data = json_decode($request_body, true);

        if (isset($request_data['transaction_id']) && isset($request_data['status'])) {
            $order_id = $this->get_order_id_by_transaction_id($request_data['transaction_id']);
            $order = wc_get_order($order_id);

            if ($request_data['status'] === 'completed') {
                $order->payment_complete();
                $order->add_order_note('Pi payment successful. Transaction ID: ' . $request_data['transaction_id']);
                $this->send_payment_notification($order, 'completed');
            } else {
                $order->update_status('failed');
                $order->add_order_note('Pi payment failed. Transaction ID: ' . $request_data['transaction_id']);
                $this->send_payment_notification($order, 'failed');
            }
        }
    }

    private function get_order_id_by_transaction_id($transaction_id) {
        global $wpdb;
        $order_id = $wpdb->get_var($wpdb->prepare("
            SELECT post_id FROM $wpdb->postmeta
            WHERE meta_key = '_pi_transaction_id'
            AND meta_value = %s
        ", $transaction_id));
        return $order_id;
    }

    private function send_payment_notification($order, $status) {
        $to = $order->get_billing_email();
        $subject = "Payment " . $status;
        $message = "Your payment for order #" . $order->get_id() . " has been " . $status . ".";
        wp_mail($to, $subject, $message);
    }

    public function thankyou_page() {
        if ($description = $this->get_description()) {
            echo wpautop(wptexturize($description));
        }
    }
}

add_filter('woocommerce_payment_gateways', 'add_pi_payment_gateway');
function add_pi_payment_gateway($gateways) {
    $gateways[] = 'WC_Gateway_Pi';
    return $gateways;
}

?>
