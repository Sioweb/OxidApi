<?php

namespace Sioweb\Oxid\Kernel;

use Sioweb\Oxid\Api\Extension\Extension;
use Symfony\Component\HttpKernel\Bundle\Bundle AS BaseBundle;

/**
 * Configures the Contao Glossar bundle.
 *
 * @author Sascha Weidner <https://www.sioweb.de>
 */
class SiowebOxidApiBundle extends BaseBundle
{
    /**
     * {@inheritdoc}
     */
    public function getContainerExtension()
    {
        return new Extension();
    }
    
    /**
     * {@inheritdoc}
     */
    public function getRouteCollection(LoaderResolverInterface $resolver, KernelInterface $kernel)
    {
        return $resolver
            ->resolve(__DIR__ . '/../Resources/config/routing.yml')
            ->load(__DIR__ . '/../Resources/config/routing.yml')
        ;
    }
    
}
