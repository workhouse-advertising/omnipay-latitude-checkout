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

    public function getStoreMerchantId()
    {
        return $this->getParameter('storeMerchantId');
    }

    public function setStoreMerchantId($value)
    {
        return $this->setParameter('storeMerchantId', $value);
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

    public function getPlatformType()
    {
        return $this->getParameter('platformType');
    }

    public function setPlatformType($value)
    {
        return $this->setParameter('platformType', $value);
    }

    public function getPlatformVersion()
    {
        return $this->getParameter('platformVersion');
    }

    public function setPlatformVersion($value)
    {
        return $this->setParameter('platformVersion', $value);
    }
}
