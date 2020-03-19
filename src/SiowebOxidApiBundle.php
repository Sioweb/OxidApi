<?php

namespace Sioweb\Oxid\Api;

use Sioweb\Oxid\Api\Extension\Extension;
use Symfony\Component\HttpKernel\Bundle\Bundle AS BaseBundle;
use OxidCommunity\SymfonyKernel\Bundle\BundleRoutesInterface;
use Symfony\Component\Config\Loader\LoaderResolverInterface;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\RouteCollection;
use OxidCommunity\SymfonyKernel\DependencyInjection\ContainerBuilder;
use OxidCommunity\SymfonyKernel\Bundle\BundleConfigurationInterface;
use Symfony\Component\Config\FileLocator;
use OxidCommunity\SymfonyKernel\DependencyInjection\Loader\YamlFileLoader;

/**
 * Configures the Contao Glossar bundle.
 *
 * @author Sascha Weidner <https://www.sioweb.de>
 */
class SiowebOxidApiBundle extends BaseBundle implements BundleRoutesInterface, BundleConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getContainerExtension()
    {
        return new Extension();
    }
    
    /**
     * Returns a collection of routes for this bundle.
     *
     * @return RouteCollection|null
     */
    public function getRouteCollection(LoaderResolverInterface $resolver, KernelInterface $kernel)
    {
        return $resolver
            ->resolve(__DIR__ . '/Resources/config/routing.yml')
            ->load(__DIR__ . '/Resources/config/routing.yml')
        ;
    }

    public function getBundleConfiguration($name, ContainerBuilder $container) : array
    {
        // $loader = new YamlFileLoader(
        //     $container,
        //     new FileLocator(__DIR__.'/Resources/config')
        // );
        // $loader->load('security.yml');
        // $loader->containerConfig();
        
        return $container->getExtensionConfigs();
    }
}
