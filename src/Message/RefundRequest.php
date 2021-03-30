<?php

namespace Omnipay\LatitudeCheckout\Message;

use Omnipay\LatitudeCheckout\Message\RefundResponse;

class RefundRequest extends AbstractRequest
{
    protected $liveEndpoint = 'https://api.latitudefinancial.com/v1/applybuy-checkout-service/purchase';
    protected $testEndpoint = 'https://api.test.latitudefinancial.com/v1/applybuy-checkout-service/purchase';

    /**
     * @inheritDoc
     */
    protected function getEndpoint()
    {
        return $this->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;
    }

    /**
     * @inheritDoc
     */
    public function getData()
    {
        $this->validate(
            'amount',
            'transactionReference',
        );

        
        return $data;
    }

    // /**
    //  * @inheritDoc
    //  */
    // public function sendData($data)
    // {
    //     $headers = [
    //         'Content-Type' => 'application/json',
    //     ];
    //     $httpResponse = $this->httpClient->request('POST', $this->getEndpoint(), $headers, json_encode($data));
    //     $responseData = json_decode($httpResponse->getBody(), true);

    //     $response = new RefundResponse($this, $responseData);
    //     $response->setHttpResponse($httpResponse);

    //     return $response;
    // }
}
