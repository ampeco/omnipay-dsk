<?php

namespace Ampeco\OmnipayDsk\Messages;

class CreatePurchaseRequest extends CreateCardRequest
{

    public function getData(): array
    {
        $data = parent::getData();
        unset($data['features']);
        $data['bindingId'] = $this->getBindingId();
        return $data;
    }

    /**
     * @param array $data
     * @param int $statusCode
     * @return mixed
     */
    protected function createResponse(array $data, int $statusCode): Response
    {
        return new CreatePurchaseResponse($this, $data, $statusCode);
    }
}
