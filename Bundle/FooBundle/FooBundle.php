<?php

namespace FooBundle;

use FooBundle\DependencyInjection\FooExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class FooBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        // Register the extension to load services and configuration
        $container->registerExtension(new FooExtension());
    }
}

