<?php

namespace Omnipay\LatitudeCheckout\Message;

use Omnipay\LatitudeCheckout\Message\Response;

class CompleteAuthorizeResponse extends Response
{
    const RESULT_COMPLETE = 'completed';

    public function isSuccessful()
    {
        return ($this->getData()['result'] ?? null) === static::RESULT_COMPLETE;
    }

    public function getTransactionId()
    {
        return $this->getData()['merchantReference'] ?? null;
    }

    public function getTransactionReference()
    {
        // TODO: Check which of `gatewayReference` or `transactionReference` is more appropriate.
        // return $this->getData()['gatewayReference'] ?? null;
        return $this->getData()['transactionReference'] ?? null;
    }
}
