<?php

namespace Ampeco\OmnipayDsk\Messages;


use Ampeco\OmnipayDsk\Gateway;
use Ampeco\OmnipayDsk\GetAndSet;
use Omnipay\Common\Message\AbstractRequest as OmniPayAbstractRequest;

abstract class AbstractRequest extends OmniPayAbstractRequest
{
    use GetAndSet;
    protected const HTTP_METHOD = 'POST';
    protected const BASE_URL = 'https://uat.dskbank.bg/payment';

    private Gateway $gateway;

    abstract function getEndpoint();

    abstract function createResponse(array $data, int $statusCode);

    public function setGateway(Gateway $gateway): static
    {
        $this->gateway = $gateway;
        return $this;
    }

    private function getHeaders(string $body)
    {
        return array_merge($this->gateway->signHeaders($body), [
            'Content-Type' => 'application/x-www-form-urlencoded',
            'Accept' => 'application/json',
            'Content-Length' => (string)strlen($body),
        ]);
    }

    public function sendData($data)
    {
        $body = http_build_query($data);
        $response = $this->httpClient->request(
            self::HTTP_METHOD,
            self::BASE_URL . $this->getEndpoint(),
            $this->getHeaders($body),
            $body
        );
        return $this->createResponse(
            json_decode($response->getBody()->getContents(), true),
            $response->getStatusCode(),
        );
    }

    public function getData()
    {
        return [
            'userName' => $this->getParameter('username'),
            'password' => $this->getParameter('password'),
            'language' => $this->getParameter('language'),
        ];
    }

}
