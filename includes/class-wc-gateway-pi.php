<?php
// Class file for WooCommerce Pi Gateway

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class WC_Gateway_Pi extends WC_Payment_Gateway {

    public function __construct() {
        $this->id = 'pi_gateway';
        $this->icon = apply_filters('woocommerce_gateway_icon', '');
        $this->has_fields = false;
        $this->method_title = 'Pi Gateway';
        $this->method_description = 'Accept payments via Pi Network.';

        // Load the settings.
        $this->init_form_fields();
        $this->init_settings();

        // Define user set variables.
        $this->title = $this->get_option('title');
        $this->description = $this->get_option('description');

        // Actions
        add_action('woocommerce_update_options_payment_gateways_' . $this->id, array($this, 'process_admin_options'));
        add_action('woocommerce_thankyou_' . $this->id, array($this, 'thankyou_page'));

        // Payment listener/API hook
        add_action('woocommerce_api_wc_gateway_pi', array($this, 'check_response'));
    }

    public function init_form_fields() {
        $this->form_fields = array(
            'enabled' => array(
                'title'       => 'Enable/Disable',
                'label'       => 'Enable Pi Gateway',
                'type'        => 'checkbox',
                'description' => '',
                'default'     => 'no',
            ),
            'title' => array(
                'title'       => 'Title',
                'type'        => 'text',
                'description' => 'This controls the title which the user sees during checkout.',
                'default'     => 'Pi Payment',
                'desc_tip'    => true,
            ),
            'description' => array(
                'title'       => 'Description',
                'type'        => 'textarea',
                'description' => 'This controls the description which the user sees during checkout.',
                'default'     => 'Pay with Pi Network.',
            ),
        );
    }

    public function process_payment($order_id) {
        $order = wc_get_order($order_id);
        $order->update_status('on-hold', 'Awaiting Pi payment');
        wc_reduce_stock_levels($order_id);
        WC()->cart->empty_cart();
        return array(
            'result' => 'success',
            'redirect' => $this->get_return_url($order),
        );
    }

    public function check_response() {
        // Handle response from Pi Network API
    }

    public function thankyou_page() {
        if ($this->description) {
            echo wpautop(wptexturize($this->description));
        }
    }
}
?>
