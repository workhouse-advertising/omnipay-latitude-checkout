<?php

namespace Omnipay\LatitudeCheckout;

use Omnipay\Common\AbstractGateway;
use Omnipay\LatitudeCheckout\Message\AuthorizeRequest;
use Omnipay\LatitudeCheckout\Message\CompleteAuthorizeRequest;
use Omnipay\LatitudeCheckout\Message\CaptureRequest;
use Omnipay\LatitudeCheckout\Message\CancelRequest;
use Omnipay\LatitudeCheckout\Message\RefundRequest;
use Omnipay\LatitudeCheckout\Traits\GatewayParameters;

class Gateway extends AbstractGateway
{
    use GatewayParameters;

    public function getName()
    {
        return 'LatitudeCheckout';
    }

    public function getDefaultParameters()
    {
        return [
            'merchantId' => '',
            'secretKey' => '',
            'testMode' => false,
        ];
    }

    /**
     * @inheritDoc
     */
    public function authorize(array $parameters = [])
    {
        return $this->createRequest(AuthorizeRequest::class, $parameters);
    }

    /**
     * @inheritDoc
     */
    public function completeAuthorize(array $options = [])
    {
        return $this->createRequest(CompleteAuthorizeRequest::class, $options);
    }

    // /**
    //  * @inheritDoc
    //  */
    // public function refund(array $options = [])
    // {
    //     return $this->createRequest(RefundRequest::class, $options);
    // }
}
