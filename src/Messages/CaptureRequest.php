<?php

namespace Ampeco\OmnipayDsk\Messages;

class CaptureRequest extends AbstractRequest
{

    /**
     * @return string
     */
    public function getEndpoint(): string
    {
        return '/rest/deposit.do';
    }

    public function getData(): array
    {
        return array_merge(parent::getData(), [
            'orderId' => $this->getOrderId(),
            'amount' => $this->getAmountInteger(),
        ]);
    }

    /**
     * @param array $data
     * @param int $statusCode
     * @return Response
     */
    protected function createResponse(array $data, int $statusCode): Response
    {
        return new Response($this, $data, $statusCode);
    }
}
