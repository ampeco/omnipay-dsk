<?php

namespace Ampeco\OmnipayDsk\Messages;


class CreateCardRequest extends AbstractRequest
{

    /**
     * @return mixed
     */
    function getEndpoint()
    {
        return '/rest/register.do';
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return array_merge(parent::getData(), [
            'amount' => $this->getAmountInteger(),
            'currency' => $this->getCurrencyNumeric(),
            'orderNumber' => $this->getOrderNumber(),
            'returnUrl' => $this->getReturnUrl(),
            'clientId' => $this->getClientId(),
            'description' => $this->getDescription(),
            //'pageView' => $this->getPageView(),
            'features' => $this->getFeatures(),
        ]);
    }

    /**
     * @throws \JsonException
     */
    public function createResponse(array $data, int $statusCode): CreateCardResponse
    {
        return new CreateCardResponse($this, $data, $statusCode);
    }
}
