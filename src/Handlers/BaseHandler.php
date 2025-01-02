<?php

namespace Emmo00\MockPaystack\Handlers;


use Emmo00\MockPaystack\Utils\GuzzleHttpClientInterface;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\Http;

/**
 * Base Handler
 */
trait BaseHandler
{
    use GuzzleHttpClientInterface;

    /**
     * Array of paystack responses
     * @var array
     */
    private array $responses;

    /**
     * mock custom response
     * 
     * appends the response to the mock handler
     * 
     * @param callable $response
     * @return void
     */
    private function fakeCustomResponse($response)
    {
        // fake guzzle
        $this->mockHandler->append(function (Request $request) use ($response) {
            return $this->makeGuzzleResponse($response($request), $this->responses);
        });


        // fake http
        Http::fake(function (\Illuminate\Http\Client\Request $request) use ($response) {
            $responseType = $response($request);

            return $this->makeHttpClientResponse($responseType, $this->responses);
        });
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

        // guzzle fake
        $this->appendToGuzzleHandler($response['status_code'], $response['headers'], $response['body'], $response['version'], $response['reason']);

        // http fake
        Http::fake([
            $response['url'] => Http::response($response['body'], $response['status_code'], ),
        ]);
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
    private function appendToGuzzleHandler($statusCode = 200, $headers = [], $body = '', $version = '1.1', $reason = null)
    {
        if (!$this->mockHandler) {
            $this->setupTestGuzzleClient();
        }

        $this->mockHandler->append(new Response($statusCode, $headers, $body, $version, $reason));
    }
}