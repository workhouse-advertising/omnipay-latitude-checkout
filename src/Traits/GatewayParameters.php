<?php

namespace Omnipay\LatitudeCheckout\Traits;

trait GatewayParameters
{
    public function getMerchantId()
    {
        return $this->getParameter('merchantId');
    }

    public function setMerchantId($value)
    {
        return $this->setParameter('merchantId', $value);
    }

    public function getSecretKey()
    {
        return $this->getParameter('secretKey');
    }

    public function setSecretKey($value)
    {
        return $this->setParameter('secretKey', $value);
    }

    public function getReference()
    {
        return $this->getParameter('reference');
    }

    public function setReference($value)
    {
        return $this->setParameter('reference', $value);
    }

    public function getPromotionReference()
    {
        return $this->getParameter('promotionReference');
    }

    public function setPromotionReference($value)
    {
        return $this->setParameter('promotionReference', $value);
    }
}
