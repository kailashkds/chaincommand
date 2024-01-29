<?php

namespace BarBundle;

use BarBundle\DependencyInjection\BarExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * BarBundle is a class that extends the Symfony Bundle class.
 * It is responsible for building the container and registering the BarExtension.
 */
class BarBundle extends Bundle
{
    /**
     * Registers the extension to load services and configuration.
     *
     * @param ContainerBuilder $container the container builder
     */
    public function build(ContainerBuilder $container): void
    {
        parent::build($container);

        // Register the extension to load services and configuration
        $container->registerExtension(new BarExtension());
    }
}
