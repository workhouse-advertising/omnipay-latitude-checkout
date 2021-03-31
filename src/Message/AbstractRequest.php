<?php

namespace Omnipay\LatitudeCheckout\Message;

use Omnipay\Common\Message\AbstractRequest as BaseAbstractRequest;
use Omnipay\LatitudeCheckout\Traits\GatewayParameters;

abstract class AbstractRequest extends BaseAbstractRequest
{
    use GatewayParameters;

    protected $liveEndpoint = 'https://api.latitudefinancial.com/v1/applybuy-checkout-service/purchase';
    protected $testEndpoint = 'https://api.test.latitudefinancial.com/v1/applybuy-checkout-service/purchase';

    public function getHttpMethod()
    {
        return 'POST';
    }

    protected function getBaseData()
    {
        return [
            'merchantId' => $this->getMerchantId(), 
            'isTest' => (bool) $this->getTestMode(), 
        ];
    }

    protected function getEndpoint()
    {
        return $this->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;
    }

    protected function getAuthorisationBasicPassword()
    {
        $merchantId = $this->getMerchantId();
        $secretKey = $this->getSecretKey();
        return base64_encode("{$merchantId}:{$secretKey}");
    }
}
