<?php

/**
 * Contao Open Source CMS
 */

declare (strict_types = 1);

namespace Sioweb\Oxid\Api\Extension;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Sioweb\Oxid\Kernel\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder AS BaseContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension AS BaseExtension;
use Symfony\Bundle\SecurityBundle\DependencyInjection\SecurityExtension;

/**
 * @file Extension.php
 * @class Extension
 * @author Sascha Weidner
 * @package sioweb.contao.extensions.glossar
 * @copyright Sascha Weidner, Sioweb
 */

class Extension extends BaseExtension implements PrependExtensionInterface //implements OxidKernelExtensionInterface
{
	/**
	 * {@inheritdoc}
	 */
	public function getAlias()
	{
		return 'oxid-api';
    }
  
    public function load(array $configs, BaseContainerBuilder $container)
    {
        $loader = new YamlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../Resources/config')
        );
        $loader->load('services.yml');
        $loader->load('listener.yml');
    }

    public function prepend(BaseContainerBuilder $container)
    {
        $loader = new YamlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../Resources/config')
        );
        $loader->load('services.yml');
        $loader->load('security.yml');
        $loader->load('listener.yml');
    }
}
