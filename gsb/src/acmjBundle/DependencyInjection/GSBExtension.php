<?php
/**
 * Created by PhpStorm.
 * User: arnau
 * Date: 24/01/2019
 * Time: 10:20
 */

namespace acmjBundle\DependencyInjection;


use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

class GSBExtension extends Extension
{


    /**
     * Loads a specific configuration.
     *
     * @throws \InvalidArgumentException When provided tag is not defined in this extension
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new Loader\YamlFileLoader($container,
            new FileLocator(__DIR__.'/..Resources/config'));
        $loader->load('services.yml');
    }


}