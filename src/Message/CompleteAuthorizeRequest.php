<?php
namespace Omnipay\LatitudeCheckout\Message;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\LatitudeCheckout\Message\CompleteAuthorizeResponse;

class CompleteAuthorizeRequest extends AbstractRequest
{
    protected $liveEndpoint = 'https://api.latitudefinancial.com/v1/applybuy-checkout-service/purchase/verify';
    protected $testEndpoint = 'https://api.test.latitudefinancial.com/v1/applybuy-checkout-service/purchase/verify';

    /**
     * @inheritDoc
     */
    public function getData()
    {
        return $this->httpRequest->query->all();
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

        // TODO: Confirm all expected responses once the Latitude Checkout documentation has been completed and account for each one.

        $httpResponse = $this->httpClient->request('POST', $this->getEndpoint(), $headers, json_encode($data));
        $responseData = json_decode($httpResponse->getBody(), true);
        if ($httpResponse->getStatusCode() != 200) {
            // TODO: Consider filtering the response body in case it may have sensitive information in there.
            //       Although that _should_ never occur.
            // TODO: Consider adding support for accessing the errors in the body. Perhaps return an AuthorizeResponse with errors?
            //       Or maybe add a "debug" mode to this package?
            throw new InvalidRequestException("Invalid verification request to the Latitude Checkout API. Received status code '{$httpResponse->getStatusCode()}'.");
            // throw new InvalidRequestException("Invalid verification request to the Latitude Checkout API. Received status code '{$httpResponse->getStatusCode()}' and body: '{$httpResponse->getBody()}'.");
        }

        return new CompleteAuthorizeResponse($this, $responseData);
    }
}
