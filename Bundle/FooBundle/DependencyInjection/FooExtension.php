<?php

namespace FooBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

/**
 * Represents a class that extends the Extension class and provides the functionality to load configuration from a file and configure services.
 */
class FooExtension extends Extension
{
    /**
     * Load the configuration and services for the given array of configs into the container.
     *
     * @param array            $configs   an array of configuration values
     * @param ContainerBuilder $container the container builder object
     *
     * @return void
     *
     * @throws \Exception thrown if there is an error loading the configuration or processing the configuration values
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        $configuration = $this->getConfiguration($configs, $container);
        $config = $this->processConfiguration($configuration, $configs);
    }
}
