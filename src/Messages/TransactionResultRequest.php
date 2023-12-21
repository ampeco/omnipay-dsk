<?php

namespace Ampeco\OmnipayDsk\Messages;

class TransactionResultRequest extends AbstractRequest
{

    /**
     * @return mixed
     */
    function getEndpoint()
    {
        return '/rest/getOrderStatusExtended.do';
    }

    /**
     * @param array $data
     * @param int $statusCode
     * @return mixed
     */
    function createResponse(array $data, int $statusCode)
    {
        return new TransactionResultResponse($this, $data, $statusCode);
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return array_merge(parent::getData(), [
            'orderId' => $this->getOrderId(),
        ]);
    }
}
