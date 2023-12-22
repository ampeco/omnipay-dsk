<?php

namespace Ampeco\OmnipayDsk\Messages;

class TransactionResultRequest extends AbstractRequest
{

    /**
     * @return mixed
     */
    public function getEndpoint(): string
    {
        return '/rest/getOrderStatusExtended.do';
    }

    /**
     * @param array $data
     * @param int $statusCode
     * @return mixed
     */
    protected function createResponse(array $data, int $statusCode): Response
    {
        return new TransactionResultResponse($this, $data, $statusCode);
    }

    /**
     * @return mixed
     */
    public function getData(): array
    {
        return array_merge(parent::getData(), [
            'orderId' => $this->getOrderId(),
        ]);
    }
}
