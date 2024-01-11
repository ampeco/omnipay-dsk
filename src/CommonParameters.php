<?php

namespace Ampeco\OmnipayDsk;

trait CommonParameters
{

    public function setClientId($value): void
    {
        $this->setParameter('clientId', $value);
    }

    public function getClientId()
    {
        return $this->getParameter('clientId');
    }

    public function setOrderId($value): void
    {
        $this->setParameter('orderId', $value);
    }

    public function getOrderId()
    {
        return $this->getParameter('orderId');
    }

    public function setOrderNumber($value): void
    {
        $this->setParameter('orderNumber', $value);
    }

    public function getOrderNumber()
    {
        return $this->getParameter('orderNumber');
    }

    public function setPageView($value): void
    {
        $this->setParameter('pageView', $value);
    }

    public function getPageView()
    {
        return $this->getParameter('pageView');
    }

    public function setFeatures($value): void
    {
        $this->setParameter('features', $value);
    }

    public function getFeatures()
    {
        return $this->getParameter('features');
    }

    public function setBindingId($value): void
    {
        $this->setParameter('bindingId', $value);
    }

    public function getBindingId()
    {
        return $this->getParameter('bindingId');
    }

    public function setUsername($value): void
    {
        $this->setParameter('username', $value);
    }

    public function getUsername()
    {
        return $this->getParameter('username');
    }

    public function setPassword($value)
    {
        $this->setParameter('password', $value);
    }

    public function getPassword()
    {
        return $this->getParameter('password');
    }

    public function setLanguage($value)
    {
        $this->setParameter('language', $value);
    }

    public function getLanguage()
    {
        return $this->getparameter('language');
    }
}
