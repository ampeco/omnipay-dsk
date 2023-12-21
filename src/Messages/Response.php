<?php

namespace Ampeco\OmnipayDsk\Messages;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;

class Response extends AbstractResponse
{

    public function __construct(RequestInterface $request, $data, protected int $code)
    {
        //$data = json_decode($data, true, flags: JSON_THROW_ON_ERROR);
        parent::__construct($request, $data);
    }

    /**
     * @return bool
     */
    public function isSuccessful(): bool
    {
        return array_key_exists('errorCode', $this->data)
            && (int)$this->data['errorCode'] === 0;
    }

    public function getCode()
    {
        return $this->code;
    }
}
