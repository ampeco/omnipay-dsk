<?php

namespace Ampeco\OmnipayDsk\Messages;

use Omnipay\Common\Message\RedirectResponseInterface;

class CreateCardResponse extends Response implements RedirectResponseInterface
{
    /**
     * @return bool
     */
    public function isSuccessful(): bool
    {
        return array_key_exists('orderId', $this->data)
            && array_key_exists('formUrl', $this->data);
    }

    public function isRedirect(): bool
    {
        return true;
    }

    public function getRedirectUrl()
    {
        return $this->data['formUrl'];
    }

    public function getTransactionReference()
    {
        return $this->data['orderId'];
    }
}
