<?php

namespace Ampeco\OmnipayDsk\Messages;

trait RegisteredOrder
{
    /**
     * @return bool
     */
    public function isSuccessful(): bool
    {
        return parent::isSuccessful()
            && array_key_exists('orderId', $this->data)
            && array_key_exists('formUrl', $this->data);
    }

    public function getRedirectUrl()
    {
        return $this->data['formUrl'];
    }

    public function getTransactionReference()
    {
        return $this->data['orderId'];
    }

    public function getOrderId()
    {
        return $this->data['orderId'];
    }
}
