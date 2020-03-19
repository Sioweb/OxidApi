<?php

namespace Sioweb\Oxid\Api\Security\Component;

use Symfony\Component\HttpKernel\KernelEvents;

use Symfony\Component\Security\Http\Firewall as BaseFirewall;

class Firewall extends BaseFirewall
{
    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            KernelEvents::REQUEST => array('onKernelRequest', 900),
            KernelEvents::FINISH_REQUEST => 'onKernelFinishRequest',
        );
    }
}
