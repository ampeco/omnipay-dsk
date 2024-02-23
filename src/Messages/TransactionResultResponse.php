<?php

namespace Ampeco\OmnipayDsk\Messages;

/**
 * @see https://uat.dskbank.bg/sandbox/integration/api/rest/rest.html#order-status
 * the result param orderStatus options:
 * 0 - order was registered but not paid;
 * 1 - order was authorized only and wasn't captured yet (for two-phase payments);
 * 2 - order was authorized and captured;
 * 3 - authorization canceled;
 * 4 - transaction was refunded;
 * 5 - access control server of the issuing bank initiated authorization procedure;
 * 6 - authorization declined;
 * 7 - pending order payment;
 * 8 - intermediate completion for multiple partial completion.
 */
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
        return in_array((int)$this->data['orderStatus'], [0, 5, 7]);
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
