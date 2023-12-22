<?php

namespace Ampeco\OmnipayDsk\Messages;

class ReverseRequest extends AbstractRequest
{

    /**
     * @return mixed
     */
    public function getEndpoint(): string
    {
        return '/rest/reverse.do';
    }

    public function getData(): array
    {
        return array_merge(parent::getData(), [
            'orderId' => $this->getOrderId(),
        ]);
    }

    /**
     * @param array $data
     * @param int $statusCode
     * @return mixed
     */
    protected function createResponse(array $data, int $statusCode): Response
    {
        return new Response($this, $data, $statusCode);
    }
}
