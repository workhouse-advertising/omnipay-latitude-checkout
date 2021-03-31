<?php

namespace Omnipay\LatitudeCheckout\Message;

use Omnipay\Common\Exception\InvalidRequestException;
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

    /**
     * @inheritDoc
     */
    public function sendData($data)
    {
        throw new InvalidRequestException("Refunds need to be handled manually, for now.");
    }
}
