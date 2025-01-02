<?php

namespace Emmo00\MockPaystack\Constants;

/**
 * Types of responses you could get from paystack
 */
enum PaystackResponseTypes
{
    const INITIALIZE_PAYMENT_SUCCESS = 'initialize_payment_success';
    const INITIALIZE_PAYMENT_FAILURE = 'initialize_payment_failure';
    const INITIALIZE_PAYMENT_INVALID_KEY = 'initialize_payment_invalid_key';
    const INITIALIZE_PAYMENT_INVALID_REQUEST = 'initialize_payment_invalid_request';
    const INITIALIZE_PAYMENT_INVALID_CURRENCY = 'initialize_payment_invalid_currency';
    const INITIALIZE_PAYMENT_INVALID_AMOUNT = 'initialize_payment_invalid_amount';
    const INITIALIZE_PAYMENT_INVALID_EMAIL = 'initialize_payment_invalid_email';
}