<?php

namespace Emmo00\MockPaystack\Utils;

use Emmo00\MockPaystack\Constants\PaystackResponseTypes;
use Illuminate\Http\Client\Request as HttpClientRequest;
use GuzzleHttp\Psr7\Request as GuzzleRequest;
use GuzzleHttp\Psr7\Response as GuzzleResponse;
use Illuminate\Support\Facades\Http;

/**
 * Easy interface for the Guzzle and Http client classes
 */
trait GuzzleHttpClientInterface
{
    /**
     * Get the request body
     * 
     * @param \GuzzleHttp\Psr7\Request|\Illuminate\Http\Client\Request $request
     * @return array
     */
    private function getRequestBody($request)
    {
        if ($request instanceof HttpClientRequest) {
            return json_decode($request->body(), true);
        }

        if ($request instanceof GuzzleRequest) {
            return json_decode($request->getBody()->getContents(), true);
        }

        return [];
    }

    /**
     * Get the request headers
     * 
     * @param \GuzzleHttp\Psr7\Request|\Illuminate\Http\Client\Request $request
     * @return array
     */
    private function getRequestHeaders($request)
    {
        if ($request instanceof HttpClientRequest) {
            return $request->headers();
        }

        if ($request instanceof GuzzleRequest) {
            return $request->getHeaders();
        }

        return [];
    }

    /**
     * make Guzzle response from array
     * 
     * @param callable|array|string $response
     * @return GuzzleResponse
     */
    private function makeGuzzleResponseFromArray($response)
    {
        $statusCode = $response['status_code'] ?? 200;
        $headers = $response['headers'] ?? [];
        $body = $response['body'] ?? '';
        $version = $response['version'] ?? '1.1';
        $reason = $response['reason'] ?? null;

        return new GuzzleResponse($statusCode, $headers, $body, $version, $reason);
    }

    /**
     * make Guzzle response
     * 
     * @param callable|array|string $response
     * @param array $response_array array of responses
     * @throws \Exception
     * @return GuzzleResponse|mixed
     */
    private function makeGuzzleResponse($response, $response_array = [])
    {
        if (is_callable($response)) {
            return $response();
        }

        if (is_array($response)) {
            return $this->makeGuzzleResponseFromArray($response);
        }

        if (is_string($response)) {
            $response = require __DIR__ . '/../Constants/paystack_responses.php'[$response] ?? null;

            if (!$response) {
                throw new \Exception('Invalid response type');
            }

            return $this->makeGuzzleResponseFromArray($response);
        }

        throw new \Exception('Invalid response type');
    }

    /**
     * make Http response from array
     * 
     * @param array $response
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function makeHttpClientResponseFromArray($response)
    {
        $statusCode = $response['status_code'] ?? 200;
        $headers = $response['headers'] ?? [];
        $body = $response['body'] ?? '';
        $version = $response['version'] ?? '1.1';
        $reason = $response['reason'] ?? null;

        return Http::response($body, $statusCode, $headers);
    }

    /**
     * make Http response
     * 
     * @param callable|array|string $response
     * @param array $response_array array of responses
     * @throws \Exception
     * @return \GuzzleHttp\Promise\PromiseInterface|mixed
     */
    private function makeHttpClientResponse($response, $response_array = [])
    {
        if (is_callable($response)) {
            return $response();
        }

        if (is_array($response)) {
            return $this->makeHttpClientResponseFromArray($response);
        }

        if (is_string($response)) {
            $response = $response_array[$response] ?? null;

            if (!$response) {
                throw new \Exception('Invalid response type');
            }

            return $this->makeHttpClientResponseFromArray($response);
        }

        throw new \Exception('Invalid response type');
    }
}