<?php

namespace Emmo00\MockPaystack\Handlers;

use Illuminate\Support\Facades\Http;

trait BaseWebHookHandler
{
    /**
     * Array of paystack webhook payloads
     * @var array
     */
    private array $webhook_payloads;

    /**
     * prepare and send payload to specified route
     * 
     * @param string $route
     * @param array $payload
     * @param string $secret_key
     * @return void
     */
    private function prepareAndSendPayload($route, $payload, $secret_key)
    {
        $jsonPayload = json_encode($payload);
        $signature = hash_hmac('sha512', $jsonPayload, $secret_key);

        $this->postJson(
            $route,
            $payload,
            [
                'X-Paystack-Signature' => $signature,
                'Content-Type' => 'application/json'
            ]
        );
    }
}