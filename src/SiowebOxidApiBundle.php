<?php

namespace Sioweb\Oxid\Api;

use Sioweb\Oxid\Api\Extension\Extension;
use Symfony\Component\HttpKernel\Bundle\Bundle AS BaseBundle;
use Sioweb\Oxid\Kernel\Bundle\BundleRoutesInterface;
use Symfony\Component\Config\Loader\LoaderResolverInterface;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Config\Loader\LoaderInterface;
use Sioweb\Oxid\Kernel\Bundle\BundleConfigInterface;

/**
 * Configures the Contao Glossar bundle.
 *
 * @author Sascha Weidner <https://www.sioweb.de>
 */
class SiowebOxidApiBundle extends BaseBundle implements BundleRoutesInterface
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
            ->resolve(__DIR__ . '/Resources/config/routing.yml')
            ->load(__DIR__ . '/Resources/config/routing.yml')
        ;
    }
}
