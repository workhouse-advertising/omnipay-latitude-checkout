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
        // TODO: Check data and potentially throw a InvalidRequestException here.

        return new CompleteAuthorizeResponse($this, $data);
    }
}
