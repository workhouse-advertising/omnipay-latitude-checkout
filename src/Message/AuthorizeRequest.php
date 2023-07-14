<?php

namespace Omnipay\LatitudeCheckout\Message;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\LatitudeCheckout\ItemInterface;
use Omnipay\LatitudeCheckout\Message\AuthorizeResponse;

/**
 * Authorize Request
 *
 * @method Response send()
 */
class AuthorizeRequest extends AbstractRequest
{
    /**
     * @inheritDoc
     */
    public function getData()
    {
        $this->validate(
            'amount',
            'currency',
        );

        // TODO: Consider if we need the `getBaseData()` method for this gateway.
        $data = $this->getBaseData();

        $data = array_merge($data, [
            'merchantReference' => $this->getReference(), 
            // NOTE: Have to cast to a float/double otherwise we receive an empty response from the gateway.
            // TODO: Report a bug to Latitude Checkout and ensure that float casting won't cause rounding errors.
            'amount' => (float) $this->getAmount(),
            'currency' => $this->getCurrency(), 
            'promotionReference' => $this->getPromotionReference(),
            'orderLines' => $this->getOrderLines(),
            'merchantUrls' => [
                'cancel' => $this->getCancelUrl(), 
                'complete' => $this->getReturnUrl(),
            ], 
            'customer' => $this->getCustomer(),
            'billingAddress' => $this->getBillingAddress(),
            'shippingAddress' => $this->getShippingAddress(),
            // TODO: Add support for shipping amounts.
            // 'totalShippingAmount' => 50.00,
            // NOTE: The fields `platformType` and `platformVersion` are just metadata references for the system
            //       that is integrating with Latitude Checkout.
            'platformType' => $this->getPlatformType(),
            'platformVersion' => $this->getPlatformVersion(),
        ]);

        return $data;
    }

    /**
     * Get the customer data.
     *
     * @return array
     */
    protected function getCustomer() : array
    {
        $customer = [];
        $card = $this->getCard();
        if ($card) {
            $customer = [
                'firstName' => $card->getFirstName(), 
                'lastName' => $card->getLastName(), 
                'phone' => $card->getPhone(), 
                'email' => $card->getEmail(),
            ];
        }
        return $customer;
    }

    /**
     * Get the billing address data.
     *
     * @return array
     */
    protected function getBillingAddress()
    {
        $billingAddress = [];
        $card = $this->getCard();
        if ($card) {
            $billingAddress = [
                'name' => $card->getBillingName(), 
                'line1' => $card->getBillingAddress1(), 
                'line2' => $card->getBillingAddress2(), 
                'city' => $card->getBillingCity(), 
                'postcode' => $card->getBillingPostCode(), 
                'state' => $card->getBillingState(), 
                'countryCode' => $card->getBillingCountry(), 
                'phone' => $card->getBillingPhone(),
            ];
        }
        return $billingAddress;
    }

    /**
     * Get the shipping address data.
     *
     * @return array
     */
    protected function getShippingAddress()
    {
        $shippingAddress = [];
        $card = $this->getCard();
        if ($card) {
            $shippingAddress = [
                'name' => $card->getShippingName(), 
                'line1' => $card->getShippingAddress1(), 
                'line2' => $card->getShippingAddress2(), 
                'city' => $card->getShippingCity(), 
                'postcode' => $card->getShippingPostCode(), 
                'state' => $card->getShippingState(), 
                'countryCode' => $card->getShippingCountry(), 
                'phone' => $card->getShippingPhone(),
            ];
        }
        return $shippingAddress;
    }

    /**
     * Get the order lines to add to the request.
     *
     * @return array
     */
    protected function getOrderLines() : array
    {
        $orderLines = [];
        foreach ($this->getItems() as $item) {
            $orderLines[] = [
                'name' => $item->getName(), 
                'quantity' => $item->getQuantity(), 
                'unitPrice' => $item->getPrice(), 
                'amount' => $item->getPrice() * $item->getQuantity(), 
                // TODO: Consider enforcing instances of \Omnipay\LatitudeCheckout\ItemInterface.
                'productUrl' => $item instanceof ItemInterface ? $item->getProductUrl() : null, 
                'sku' => $item instanceof ItemInterface ? $item->getSku() : null, 
                'requiresShipping' => $item instanceof ItemInterface ? $item->getRequiresShipping() : false, 
                'isGiftCard' => $item instanceof ItemInterface ? $item->getIsGiftCard() : false 
            ];
        }
        return $orderLines;
    }

    /**
     * @inheritDoc
     */
    public function sendData($data)
    {
        $headers = [
            'Authorization' => "Basic {$this->getAuthorisationBasicPassword()}",
            'Content-Type' => 'application/json',
        ];

        $httpResponse = $this->httpClient->request('POST', $this->getEndpoint(), $headers, json_encode($data));
        $responseData = json_decode($httpResponse->getBody(), true);
        if ($httpResponse->getStatusCode() != 200) {
            // TODO: Consider filtering the response body in case it may have sensitive information in there.
            //       Although that _should_ never occur.
            // TODO: Consider adding support for accessing the errors in the body. Perhaps return an AuthorizeResponse with errors?
            //       Or maybe add a "debug" mode to this package?
            throw new InvalidRequestException("Invalid request to the Latitude Checkout API. Received status code '{$httpResponse->getStatusCode()}'.");
            // throw new InvalidRequestException("Invalid request to the Latitude Checkout API. Received status code '{$httpResponse->getStatusCode()}' and body: '{$httpResponse->getBody()}'.");
        }

        return new AuthorizeResponse($this, $responseData);
    }
}
