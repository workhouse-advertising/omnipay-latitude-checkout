<?php

namespace Omnipay\LatitudeCheckout;

use Omnipay\Common\Item as BaseItem;
use Omnipay\LatitudeCheckout\ItemInterface;

class Item extends BaseItem implements ItemInterface
{
    /**
     * @inheritDoc
     */
    public function getSku()
    {
        return $this->getParameter('sku');
    }

    /**
     * Set the item sku
     */
    public function setSku($value)
    {
        return $this->setParameter('sku', $value);
    }

    /**
     * @inheritDoc
     */
    public function getProductUrl()
    {
        return $this->getParameter('productUrl');
    }

    /**
     * Set the product URL.
     */
    public function setProductUrl($value)
    {
        return $this->setParameter('productUrl', $value);
    }

    /**
     * @inheritDoc
     */
    public function getRequiresShipping()
    {
        return $this->getParameter('requiresShipping');
    }

    /**
     * Set if this item requires shipping.
     */
    public function setRequiresShipping($value)
    {
        return $this->setParameter('requiresShipping', $value);
    }

    /**
     * @inheritDoc
     */
    public function getIsGiftCard()
    {
        return $this->getParameter('isGiftCard');
    }

    /**
     * Set the product URL.
     */
    public function setIsGiftCard($value)
    {
        return $this->setParameter('isGiftCard', $value);
    }
}