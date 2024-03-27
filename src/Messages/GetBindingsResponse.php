<?php

namespace Ampeco\OmnipayDsk\Messages;

class GetBindingsResponse extends Response
{
    public function getBindings()
    {
        return $this->data['bindings'];
    }

    public function hasBindingId($bindingId): bool
    {
        foreach ($this->getBindings() as $binding) {
            if (@$binding['bindingId'] === $bindingId) {
                return true;
            }
        }
        return false;
    }
}
