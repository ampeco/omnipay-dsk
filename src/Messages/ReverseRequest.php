<?php

namespace Ampeco\OmnipayDsk\Messages;

class ReverseRequest extends AbstractRequest
{

    /**
     * @return mixed
     */
    function getEndpoint()
    {
        return '/rest/reverse.do';
    }

    public function getData()
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
    function createResponse(array $data, int $statusCode)
    {
        return new Response($this, $data, $statusCode);
    }
}
