<?php
namespace Omnipay\LatitudeCheckout\Message;

class CancelRequest extends AbstractRequest
{
    protected function getEndpoint()
    {

    }

    public function getData()
    {
        return $this->getBaseData();
    }
}
