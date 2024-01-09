<?php

namespace Ampeco\OmnipayDsk\Messages;

class CreateAuthorizeRequest extends CreatePurchaseRequest
{

    /**
     * @return string
     */
    public function getEndpoint(): string
    {
        return '/rest/registerPreAuth.do';
    }

    /**
     * @param array $data
     * @param int $statusCode
     * @return Response
     */
    protected function createResponse(array $data, int $statusCode): Response
    {
        return new CreateAuthorizeResponse($this, $data, $statusCode);
    }
}
