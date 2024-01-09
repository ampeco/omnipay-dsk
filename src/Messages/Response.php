<?php

namespace Ampeco\OmnipayDsk\Messages;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;

class Response extends AbstractResponse
{

    public function __construct(RequestInterface $request, $data, protected int $code)
    {
        parent::__construct($request, $data);
    }

    /**
     * @return bool
     */
    public function isSuccessful(): bool
    {
        return $this->code >= 200 && $this->code < 300
                && (!array_key_exists('errorCode', $this->data)
                    || (int)$this->data['errorCode'] === 0);
    }



    public function getCode(): int
    {
        return $this->code;
    }

    public function getErrorCode()
    {
        return $this->data['errorCode'] ?? null;
    }

    public function getErrorMessage()
    {
        return $this->data['errorMessage'] ?? null;
    }
}
