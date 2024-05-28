<?php

require_once('../path/to/pi-sdk/autoload.php');

class PiSDKIntegration {
    private $pi_sdk;

    public function __construct() {
        $this->pi_sdk = new PiSdk\PiPayment();
    }

    public function createPayment($amount, $currency, $metadata) {
        try {
            $payment_request = $this->pi_sdk->createPayment([
                'amount' => $amount,
                'currency' => $currency,
                'metadata' => $metadata
            ]);

            return ['transaction_id' => $payment_request->id];
        } catch (Exception $e) {
            return ['error' => 'Pi payment creation failed: ' . $e->getMessage()];
        }
    }

    public function verifyTransaction($transaction_id) {
        try {
            $transaction = $this->pi_sdk->getTransaction($transaction_id);
            return $transaction->status === 'completed';
        } catch (Exception $e) {
            return false;
        }
    }
}
