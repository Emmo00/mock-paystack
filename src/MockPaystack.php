<?php

namespace Emmo00\MockPaystack;

use Emmo00\MockPaystack\Handlers\Core;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;

/**
 * Mock Paystack
 */
trait MockPaystack
{
    use Core;

    /**
     * Set up the mock Paystack client
     *
     * @return void
     */
    public function setUpMockPaystack()
    {
        $this->mockHandler = new MockHandler;
        $this->mockHandler->append();
        $handler = HandlerStack::create($this->mockHandler);
        $client = new Client(['handler' => $handler]);

        $this->setResponses();
        $this->setWebHookPayloads();
        $this->app->instance(Client::class, $client);
    }

    private function setResponses()
    {
        $this->responses = require(__DIR__ . '/Constants/paystack_responses.php');
    }

    private function setWebHookPayloads()
    {
        $this->payloads = require(__DIR__ . '/Constants/paystack_webhook_payloads.php');
    }
}