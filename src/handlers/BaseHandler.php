<?php

namespace Emmo00\MockPaystack\Handlers;


use GuzzleHttp\Psr7\Response;

/**
 * Base Handler
 */
trait BaseHandler
{
    /**
     * Array of paystack responses
     * @var array
     */
    public static $responses = require(__DIR__ . '/../constants/paystack_responses.php');

    /**
     * mock custom response
     * 
     * appends the response to the mock handler
     * 
     * @param callable|\GuzzleHttp\Psr7\Request $response
     * @return void
     */
    private function fakeCustomResponse($response)
    {
        $this->mockHandler->append($response);
    }

    /**
     * Mock a particular paystack response type
     * 
     * @param \Emmo00\MockPaystack\Constants\PaystackResponseTypes|string $responseType
     * @return void
     */
    private function fakePaystackResponse($responseType)
    {
        $response = $this->responses[(string) $responseType];

        $this->appendToHandler($response['status_code'], $response['headers'], $response['body'], $response['version'], $response['reason']);
    }

    /**
     * build and append a response to the mock handler
     * 
     * @param int $statusCode
     * @param array $headers
     * @param string|array $body
     * @param string $version
     * @param string|null $reason
     * @return void
     */
    private function appendToHandler($statusCode = 200, $headers = [], $body = '', $version = '1.1', $reason = null)
    {
        if (!$this->mockHandler) {
            $this->setupTestGuzzleClient();
        }

        $this->mockHandler->append(new Response($statusCode, $headers, $body, $version, $reason));
    }

    /**
     * Build a response
     * 
     * @param mixed $responseData
     * @return Response
     */
    private static function makeResponse($responseData)
    {
        $statusCode = $responseData['status_code'] ?? 200;
        $headers = $responseData['headers'] ?? [];
        $body = $responseData['body'] ?? '';
        $version = $responseData['version'] ?? '1.1';
        $reason = $responseData['reason'] ?? null;

        return new Response($statusCode, $headers, $body, $version, $reason);
    }
}