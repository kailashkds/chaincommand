<?php

namespace BarBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

/**
 * Represents a BarExtension class which extends the Extension class.
 *
 * The BarExtension class is responsible for loading and configuring the services
 * in the container using a YAML file loader and processing the configuration options.
 */
class BarExtension extends Extension
{
    /**
     * Loads the configuration for the given array of configs and populates the container with necessary services.
     *
     * @param array            $configs   An array of configuration values
     * @param ContainerBuilder $container The service container builder instance
     *
     * @throws \Exception If an error occurs while loading the configuration
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        $configuration = $this->getConfiguration($configs, $container);
        $config = $this->processConfiguration($configuration, $configs);
    }
}
