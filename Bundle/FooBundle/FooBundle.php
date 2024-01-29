<?php

namespace FooBundle;

use FooBundle\DependencyInjection\FooExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class FooBundle.
 *
 * This class extends the Symfony Bundle class and is responsible for building the bundle.
 * It registers the FooExtension to load services and configuration.
 */
class FooBundle extends Bundle
{
    /**
     * Builds the container.
     *
     * @param ContainerBuilder $container the container builder
     *
     * @return void
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        // Register the extension to load services and configuration
        $container->registerExtension(new FooExtension());
    }
}
