<?php

namespace Ampeco\OmnipayDsk\Messages;

class CreatePurchaseResponse extends Response
{
    public function isSuccessful(): bool
    {
        return parent::isSuccessful()
            && array_key_exists('orderId', $this->data)
            && array_key_exists('formUrl', $this->data);
    }

    public function getOrderId()
    {
        return $this->data['orderId'];
    }

    public function getRedirectUrl()
    {
        return $this->data['formUrl'];
    }
}
