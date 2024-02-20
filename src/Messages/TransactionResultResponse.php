<?php

namespace Ampeco\OmnipayDsk\Messages;


class TransactionResultResponse extends Response implements ProvidesCardInfo
{

    /**
     * @return bool
     */
    public function isSuccessful(): bool
    {
        return parent::isSuccessful() && array_key_exists('orderStatus', $this->data)
            && (int)$this->data['orderStatus'] < 3; // 0-pending; 1-authorized; 2-paid

    }

    public function isPending()
    {
        return (int)$this->data['orderStatus'] === 0;
    }

    public function getTransactionReference()
    {
        foreach ((array)@$this->data['attributes'] as $attribute) {
            if ($attribute['name'] === 'mdOrder') {
                return $attribute['value'];
            }
        }
        return null;
    }

    /**
     * @return int
     */
    public function getLast4(): string
    {
        return substr($this->data['cardAuthInfo']['pan'], -4);
    }

    /**
     * @return mixed
     */
    public function getExpireMonth()
    {
        return (int)substr($this->data['cardAuthInfo']['expiration'], -2);
    }

    /**
     * @return mixed
     */
    public function getExpireYear()
    {
        return (int)substr($this->data['cardAuthInfo']['expiration'], 0, 4);
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->data['cardAuthInfo']['paymentSystem'] ?? 'unknown';
    }

    public function getToken()
    {
        return $this->data['bindingInfo']['bindingId'];
    }
}
