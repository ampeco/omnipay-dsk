<?php

namespace Ampeco\OmnipayDsk\Messages;

class GetBindingsRequest extends AbstractRequest
{

    /**
     * @return string
     */
    public function getEndpoint(): string
    {
        return '/rest/getBindings.do';
    }

    public function getData(): array
    {
        return array_merge(parent::getData(), [
            'clientId' => $this->getClientId(),
        ]);
    }

    /**
     * @param array $data
     * @param int $statusCode
     * @return Response
     */
    protected function createResponse(array $data, int $statusCode): GetBindingsResponse
    {
        return new GetBindingsResponse($this, $data, $statusCode);
    }
}
