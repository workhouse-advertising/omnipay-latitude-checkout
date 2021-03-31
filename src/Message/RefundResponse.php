<?php

namespace Omnipay\LatitudeCheckout\Message;

use Omnipay\LatitudeCheckout\Message\Response;

class RefundResponse extends Response
{
    public function isSuccessful()
    {
        return false;
    }
}
