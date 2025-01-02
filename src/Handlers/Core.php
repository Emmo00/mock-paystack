<?php

namespace Emmo00\MockPaystack\Handlers;

/**
 * Combination of all MockPaystack methods
 */
trait Core
{
    use InitializePaymentHandler;
    use ChargeSuccessWebhookHandler;

    /**
     * Array of paystack responses
     * @var array
     */
    private array $responses;
    
    /**
     * Array of paystack webhook payloads
     * @var array
     */
    private array $webhook_payloads;
}