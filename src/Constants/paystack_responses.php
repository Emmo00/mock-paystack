<?php

use Emmo00\MockPaystack\Constants\PaystackResponseTypes;

/**
 * This file contains the responses that Paystack API would return for the various requests.
 * 
 * @see https://paystack.com/docs/api/transaction
 * 
 * @return array
 */
return [
    PaystackResponseTypes::INITIALIZE_PAYMENT_SUCCESS => [
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
