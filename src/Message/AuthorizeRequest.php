<?php
namespace Omnipay\LatitudeCheckout\Message;

use Omnipay\LatitudeCheckout\ItemInterface;
use Omnipay\LatitudeCheckout\ItemTypeInterface;
use Omnipay\LatitudeCheckout\Message\AuthorizeResponse;

/**
 * Authorize Request
 *
 * @method Response send()
 */
class AuthorizeRequest extends AbstractRequest
{
    /**
     * @inheritDoc
     */
    public function getEndpoint($service = null)
    {
        // No endpoint as the response is a redirect.
        return null;
    }

    /**
     * @inheritDoc
     */
    public function getData()
    {
        $this->validate(
            'amount',
            'currency',
        );

        $data = $this->getBaseData();

        return $data;
    }

    /**
     * @inheritDoc
     */
    public function sendData($data)
    {
        // The response is a redirect.
        return new AuthorizeResponse($this, $data);
    }
}
