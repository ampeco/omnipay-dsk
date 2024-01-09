<?php

namespace Ampeco\OmnipayDsk\Messages;


class CreateCardRequest extends AbstractRequest
{

    /**
     * @return mixed
     */
    public function getEndpoint(): string
    {
        return '/rest/register.do';
    }

    /**
     * @return mixed
     */
    public function getData(): array
    {
        return array_merge(parent::getData(), [
            'amount' => $this->getAmountInteger(),
            'currency' => $this->getCurrencyNumeric(),
            'orderNumber' => $this->getOrderNumber(),
            'returnUrl' => $this->getReturnUrl(),
            'clientId' => $this->getClientId(),
            'description' => $this->getDescription(),
            'features' => $this->getFeatures(),
        ]);
    }

    /**
     * @throws \JsonException
     */
    protected function createResponse(array $data, int $statusCode): Response
    {
        return new CreateCardResponse($this, $data, $statusCode);
    }
}
