<?php

namespace Emmo00\MockPaystack\Handlers;

use Emmo00\MockPaystack\Constants\PaystackWebhookPayloadTypes;

/**
 * Send Paystack mock notification handler
 */
trait ChargeSuccessWebhookHandler
{
    use BaseWebHookHandler;

    /**
     * send a fake webhook `charge success` notification to your paystack webhook handler route
     * @param string $route
     * @param string $secret_key
     * @param array $metadata
     * @param int $amount
     * @param string $currency
     * @param string $reference
     * @param string $channel
     * @param string $ip_address
     * @param array $customer
     * @param array $authorization
     * @param bool $reusable_authorization
     * @return void
     */
    private function fakeWebHookChargeSuccess(
        $route,
        $secret_key,
        $metadata = [],
        $amount = 10000,
        $currency = 'NGN',
        $reference = 'reference',
        $channel = 'card',
        $ip_address = '0.0.0.0',
        $customer = [],
        $authorization = [],
        $reusable_authorization = true,
    ) {
        $webhookData = $this->webhook_payloads[PaystackWebhookPayloadTypes::CHARGE_SUCCESS];
        $webhookData['data']['metadata'] = $metadata;
        $webhookData['data']['amount'] = $amount;
        $webhookData['data']['currency'] = $currency;
        $webhookData['data']['reference'] = $reference;
        $webhookData['data']['channel'] = $channel;
        $webhookData['data']['ip_address'] = $ip_address;
        $webhookData['data']['customer'] = $customer;
        if ($authorization)
            $webhookData['data']['authorization'] = $authorization;
        $webhookData['data']['authorization']['reusable'] = $reusable_authorization;

        $this->prepareAndSendPayload($route, $webhookData, $secret_key);
    }
}