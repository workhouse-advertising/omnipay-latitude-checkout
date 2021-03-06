<?php

namespace Omnipay\LatitudeCheckout\Message;

/**
 * Send the user to the Hosted Payment Page to authorize their payment.
 */

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;

class AuthorizeResponse extends AbstractResponse implements RedirectResponseInterface
{
    /**
     * @inheritDoc
     */
    public function isSuccessful()
    {
        return false;
    }

    /**
     * @inheritDoc
     */
    public function isRedirect()
    {
        $data = $this->getData();
        return isset($data['redirectUrl']);
    }

    /**
     * @inheritDoc
     */
    public function getRedirectUrl()
    {
        $data = $this->getData();
        return $data['redirectUrl'] ?? null;
    }

    /**
     * @inheritDoc
     */
    public function getMessage()
    {
        return $this->getData()['error'] ?? null;
    }
}
