<?php

namespace Emmo00\MockPaystack\Handlers;

use Emmo00\MockPaystack\Constants\PaystackResponseTypes;
use GuzzleHttp\Psr7\Request;

/**
 * Handle mocking paystack payment initialization
 */
trait InitializePaymentHandler
{
    use BaseHandler;

    /**
     * Validate and return an initialize payment request
     * 
     * @param \GuzzleHttp\Psr7\Request $request
     * @return \GuzzleHttp\Psr7\Response
     */
    private static function validateAndFakeInitializePayment(Request $request)
    {
        $body = json_decode($request->getBody()->getContents(), true);
        $headers = $request->getHeaders();

        if (!isset($body['email'])) {
            return static::makeResponse(static::responses[PaystackResponseTypes::INITIALIZE_PAYMENT_INVALID_EMAIL]);
        }

        if (!isset($body['amount'])) {
            return static::makeResponse(static::responses[PaystackResponseTypes::INITIALIZE_PAYMENT_INVALID_AMOUNT]);
        }

        if (!isset($body['currency'])) {
            return static::makeResponse(static::$responses[PaystackResponseTypes::INITIALIZE_PAYMENT_INVALID_CURRENCY]);
        }

        if (!isset($headers['Authorization']) || count(explode(' ', $headers['Authorization'])) !== 2) {
            return static::makeResponse(static::$responses[PaystackResponseTypes::INITIALIZE_PAYMENT_INVALID_KEY]);
        }

        return static::makeResponse(static::$responses[PaystackResponseTypes::INITIALIZE_PAYMENT_SUCCESS]);
    }

    /**
     * fake initialize paystack payment
     * 
     * makes sure the following properties are present on the request
     * - email
     * - amount
     * - currency
     * - Authorization header, and the bearer token
     * @return void
     */
    private function fakeInitializePayment()
    {
        $this->fakeCustomResponse($this->validateAndFakeInitializePayment);
    }

    /**
     * fake initialize payment success
     * @return void
     */
    private function fakeInitializePaymentSuccess()
    {
        $this->fakePaystackResponse(PaystackResponseTypes::INITIALIZE_PAYMENT_SUCCESS);
    }

    /**
     * fake initialize payment failure
     * @return void
     */
    private function fakeInitializePaymentFailure()
    {
        $this->fakePaystackResponse(PaystackResponseTypes::INITIALIZE_PAYMENT_FAILURE);
    }

    /**
     * fake initialize payment initialize key
     * @return void
     */
    private function fakeInitializePaymentInvalidKey()
    {
        $this->fakePaystackResponse(PaystackResponseTypes::INITIALIZE_PAYMENT_INVALID_KEY);
    }

    /**
     * fake initialize payment invalid request
     * @return void
     */
    private function fakeInitializePaymentInvalidRequest()
    {
        $this->fakePaystackResponse(PaystackResponseTypes::INITIALIZE_PAYMENT_INVALID_REQUEST);
    }

    /**
     * fake initialize payment invalid currency
     * @return void
     */
    private function fakeInitializePaymentInvalidCurrency()
    {
        $this->fakePaystackResponse(PaystackResponseTypes::INITIALIZE_PAYMENT_INVALID_CURRENCY);
    }

    /**
     * fake initialize payment invalid amount
     * @return void
     */
    private function fakeInitializePaymentInvalidAmount()
    {
        $this->fakePaystackResponse(PaystackResponseTypes::INITIALIZE_PAYMENT_INVALID_AMOUNT);
    }

    /**
     * fake initialize payment invalid email
     * @return void
     */
    private function fakeInitializePaymentInvalidEmail()
    {
        $this->fakePaystackResponse(PaystackResponseTypes::INITIALIZE_PAYMENT_INVALID_EMAIL);
    }
}