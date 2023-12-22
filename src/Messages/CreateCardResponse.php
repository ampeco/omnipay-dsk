<?php

namespace Ampeco\OmnipayDsk\Messages;

use Omnipay\Common\Message\RedirectResponseInterface;

class CreateCardResponse extends Response implements RedirectResponseInterface
{

    use RegisteredOrder;


    public function isRedirect(): bool
    {
        return true;
    }
}
