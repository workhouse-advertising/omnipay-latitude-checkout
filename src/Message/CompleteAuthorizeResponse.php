<?php

namespace Omnipay\LatitudeCheckout\Message;

use Omnipay\LatitudeCheckout\Message\Response;

class CompleteAuthorizeResponse extends Response
{
    const RESULT_COMPLETE = 'completed';

    /**
     * @inheritDoc
     */
    public function isSuccessful()
    {
        return ($this->getData()['result'] ?? null) === static::RESULT_COMPLETE;
    }

    /**
     * @inheritDoc
     */
    public function getTransactionId()
    {
        return $this->getData()['merchantReference'] ?? null;
    }

    /**
     * @inheritDoc
     */
    public function getTransactionReference()
    {
        // TODO: Check which of `gatewayReference` or `transactionReference` is more appropriate.
        // return $this->getData()['gatewayReference'] ?? null;
        return $this->getData()['transactionReference'] ?? null;
    }

    /**
     * @inheritDoc
     */
    public function getMessage()
    {
        return $this->getData()['message'] ?? null;
    }
}
