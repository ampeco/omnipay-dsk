<?php

namespace Ampeco\OmnipayDsk\Messages;

class DeleteCardRequest extends AbstractRequest
{

    /**
     * @return mixed
     */
    function getEndpoint()
    {
        return '/rest/unBindCard.do';
    }

    public function getData()
    {
        $data = parent::getData();
        unset($data['language']);
        $data['bindingId'] = $this->getBindingId();
        return $data;
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
