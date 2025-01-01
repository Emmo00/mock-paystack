<?php

namespace Emmo00\MockPaystack\Handlers;

/**
 * Combination of all MockPaystack methods
 */
trait Core
{
    use InitializePaymentHandler;
    use WebHookHandler;
}