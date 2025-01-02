<?php

namespace Emmo00\MockPaystack\Constants;

use Emmo00\MockPaystack\Constants\PaystackResponseTypes;

/**
 * This file contains the responses that Paystack API would return for the various requests.
 * 
 * @see https://paystack.com/docs/api/transaction
 * 
 * @return array
 */
return $responses = [
    PaystackResponseTypes::INITIALIZE_PAYMENT_SUCCESS => [
        'url' => 'https://api.paystack.co/transaction/initialize',
        'status_code' => 200,
        'headers' => [],
        'body' => json_encode([
            'status' => true,
            'message' => 'Authorization URL created',
            'data' => [
                'authorization_url' => 'https://checkout.paystack.com/checkout_link',
                'access_code' => 'access_code',
                'reference' => 'reference'
            ]
        ]),
        'version' => '1.1',
        'reason' => null
    ],
    PaystackResponseTypes::INITIALIZE_PAYMENT_FAILURE => [
        'url' => 'https://api.paystack.co/transaction/initialize',
        'status_code' => 400,
        'headers' => [],
        'body' => json_encode([
            'status' => false,
            'message' => 'Invalid request',
            'data' => null
        ]),
        'version' => '1.1',
        'reason' => null,
    ],
    PaystackResponseTypes::INITIALIZE_PAYMENT_INVALID_KEY => [
        'url' => 'https://api.paystack.co/transaction/initialize',
        'status_code' => 401,
        'headers' => [],
        'body' => json_encode([
            'status' => false,
            'message' => 'Invalid key',
            'data' => null
        ]),
        'version' => '1.1',
        'reason' => null
    ],
    PaystackResponseTypes::INITIALIZE_PAYMENT_INVALID_REQUEST => [
        'url' => 'https://api.paystack.co/transaction/initialize',
        'status_code' => 400,
        'headers' => [],
        'body' => json_encode([
            'status' => false,
            'message' => 'Invalid request',
            'data' => null
        ]),
        'version' => '1.1',
        'reason' => null
    ],
    PaystackResponseTypes::INITIALIZE_PAYMENT_INVALID_CURRENCY => [
        'url' => 'https://api.paystack.co/transaction/initialize',
        'status_code' => 400,
        'headers' => [],
        'body' => json_encode([
            'status' => false,
            'message' => 'Invalid currency',
            'data' => null
        ]),
        'version' => '1.1',
        'reason' => null
    ],
    PaystackResponseTypes::INITIALIZE_PAYMENT_INVALID_AMOUNT => [
        'url' => 'https://api.paystack.co/transaction/initialize',
        'status_code' => 400,
        'headers' => [],
        'body' => json_encode([
            'status' => false,
            'message' => 'Invalid amount',
            'data' => null
        ]),
        'version' => '1.1',
        'reason' => null
    ],
    PaystackResponseTypes::INITIALIZE_PAYMENT_INVALID_EMAIL => [
        'url' => 'https://api.paystack.co/transaction/initialize',
        'status_code' => 400,
        'headers' => [],
        'body' => json_encode([
            'status' => false,
            'message' => 'Invalid email',
            'data' => null
        ]),
        'version' => '1.1',
        'reason' => null
    ],
];
