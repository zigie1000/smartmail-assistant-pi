<?php

require_once('pi-sdk-integration.php');

class PiSpecificFunctions {
    private $pi_integration;

    public function __construct() {
        $this->pi_integration = new PiSDKIntegration();
    }

    public function processPayment($order_id, $amount, $currency, $metadata) {
        $result = $this->pi_integration->createPayment($amount, $currency, $metadata);
        if (isset($result['transaction_id'])) {
            return $result['transaction_id'];
        } else {
            return false;
        }
    }

    public function handleWebhook($transaction_id) {
        $is_verified = $this->pi_integration->verifyTransaction($transaction_id);
        if ($is_verified) {
            return true;
        } else {
            return false;
        }
    }
}
