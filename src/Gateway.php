<?php

namespace Ampeco\OmnipayDsk;

use Ampeco\OmnipayDsk\Messages\CreateCardRequest;
use Ampeco\OmnipayDsk\Messages\DeleteCardRequest;
use Ampeco\OmnipayDsk\Messages\ReverseRequest;
use Ampeco\OmnipayDsk\Messages\TransactionResultRequest;
use Omnipay\Common\AbstractGateway;
use Omnipay\Common\Message\RequestInterface;

class Gateway extends AbstractGateway
{

    use GetAndSet;

    /**
     * @return string
     */
    public function getName()
    {
        return 'DSK';
    }

    public function createCard(array $options = [])
    {
        return $this->createRequest(CreateCardRequest::class, $options);
    }

    public function fetchTransaction(array $options = []): RequestInterface
    {
        return $this->createRequest(TransactionResultRequest::class, $options);
    }

    public function void(array $options = [])
    {
        return $this->createRequest(ReverseRequest::class, $options);
    }

    public function deleteCard(array $options = array()): RequestInterface
    {
        return $this->createRequest(DeleteCardRequest::class, $options);
    }

    protected function createRequest($class, array $parameters)
    {
        return parent::createRequest($class, $parameters)->setGateway($this);
    }

//    public function __call($name, $arguments)
//    {
//        // TODO: Implement @method \Omnipay\Common\Message\NotificationInterface acceptNotification(array $options = array())
//        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface authorize(array $options = array())
//        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface completeAuthorize(array $options = array())
//        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface capture(array $options = array())
//        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface purchase(array $options = array())
//        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface completePurchase(array $options = array())
//        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface refund(array $options = array())
//        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface fetchTransaction(array $options = [])
//        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface void(array $options = array())
//        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface createCard(array $options = array())
//        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface updateCard(array $options = array())
//        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface deleteCard(array $options = array())
//    }

    public function signHeaders(string $body)
    {
        if ($signSettings = $this->signSettings()) {
           [$privateKey, $password] = $signSettings;
           $hash = hash('sha256', $body, true);
           $signature = $this->createSignature($privateKey, $password, $hash);
           return [
               'X-Hash' => base64_encode($hash),
               'X-Signature' => base64_encode($signature),
           ];
        }
        return [];
    }

    private function signSettings()
    {
        if($this->getUseSignature()){
            $privateKey = $this->getPrivateKey();
            $password = $this->getPrivateKeyPassword();
            if ($privateKey && $password) {
                return [$privateKey, $password];
            }
        }
        return null;
    }

    private function createSignature(string $privateKey, string $password, string $hash): string
    {
        $pKey = openssl_pkey_get_private($privateKey, $password);
        //$signature = '';
        openssl_sign($hash, $signature, $pKey, OPENSSL_ALGO_SHA256);
        return $signature;
    }

    public function setUseSignature($value)
    {
        $this->setParameter('use_signature', $value);
    }

    public function getUseSignature()
    {
        return $this->getParameter('use_signature');
    }

    public function setPrivateKey($value)
    {
        $this->setParameter('private_key', $value);
    }

    public function getPrivateKey()
    {
        return $this->getParameter('private_key');
    }

    public function setPrivateKeyPassword($value)
    {
        $this->setParameter('private_key_password', $value);
    }

    public function getPrivateKeyPassword()
    {
        return $this->getParameter('private_key_password');
    }
}
