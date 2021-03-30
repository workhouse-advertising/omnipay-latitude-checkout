<?php
namespace Omnipay\LatitudeCheckout\Message;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\LatitudeCheckout\Message\CompleteAuthorizeResponse;

class CompleteAuthorizeRequest extends AbstractRequest
{
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
