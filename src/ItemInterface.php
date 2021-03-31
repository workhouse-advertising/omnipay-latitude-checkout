<?php

namespace Omnipay\LatitudeCheckout;

use Omnipay\Common\ItemInterface as BaseItemInterface;

interface ItemInterface extends BaseItemInterface
{
    public function getSku();

    public function getProductUrl();

    public function getRequiresShipping();

    public function getIsGiftCard();
}
