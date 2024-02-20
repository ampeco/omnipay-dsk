<?php

namespace Ampeco\OmnipayDsk\Messages;

/**
 * @see https://uat.dskbank.bg/sandbox/integration/api/rest/rest.html#stored-credential-payment
 */
class CompleteOrderResponse extends Response
{

    public function getDisplayErrorMessage()
    {
        // the 'error' value is in the language of the request
        return $this->data['error'] ?? $this->data['displayErrorMessage'];
    }

    public function getInfo()
    {
        return $this->data['info'];
    }

    /**
     * In a successful response in case of a 3D-Secure payment. The URL address for redirecting to ACS.
     * @see https://uat.dskbank.bg/sandbox/integration/api/scripts.html#redirect-to-the-acs
     * @return string|null
     */
    public function getAcsUrl()
    {
        return $this->data['acsUrl'] ?? null;
    }

    /**
     * In a successful response in case of a 3D-Secure payment. PAReq (Payment Authentication Request) - a message that should be sent to ACS together with redirect.
     * This message contains the Base64-encoded data necessary for the cardholder authentication.
     * @see https://uat.dskbank.bg/sandbox/integration/api/scripts.html#redirect-to-the-acs
     * @return string|null
     */
    public function getPaReq()
    {
        return $this->data['paReq'] ?? null;
    }

    /**
     * In a successful response in case of a 3D-Secure payment. The URL address to which ACS redirects the cardholder after authentication.
     * @see https://uat.dskbank.bg/sandbox/integration/api/scripts.html#redirect-to-the-acs
     * @return mixed|null
     */
    public function getTermUrl()
    {
        return $this->data['termUrl'] ?? null;
    }

    public function getTransactionReference()
    {
        // orderId is not part of the response, so it should be passed by data param in constructor
        return $this->data['orderId'];
    }

    public function isSuccessful(): bool
    {
        return parent::isSuccessful()
            && !array_key_exists('errorTypeName', $this->data)
            && !array_key_exists('displayErrorMessage', $this->data);
    }
}
