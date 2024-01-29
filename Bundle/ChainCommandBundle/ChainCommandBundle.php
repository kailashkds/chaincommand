<?php

namespace ChainCommandBundle;

use ChainCommandBundle\DependencyInjection\ChainCommandExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Represents a bundle class that extends Bundle.
 * This class is responsible for building the container and registering the extension to load services and configuration.
 *
 * @see Bundle
 */
class ChainCommandBundle extends Bundle
{
    /**
     * Builds the container.
     *
     * @param ContainerBuilder $container the container builder instance
     *
     * @return void
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        // Register the extension to load services and configuration
        $container->registerExtension(new ChainCommandExtension());
    }
}
