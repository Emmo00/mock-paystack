<?php

namespace Emmo00\MockPaystack\Constants;

/**
 * Paystack notification event types
 */
enum PaystackWebhookPayloadTypes
{
    const CHARGE_SUCCESS = 'charge.success';
    const TRANSFER_SUCCESS = 'transfer.success';
    const TRANSFER_FAILED = 'transfer.failed';
    const TRANSFER_REVERSED = 'transfer.reversed';
}