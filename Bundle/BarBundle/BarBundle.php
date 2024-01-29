<?php

namespace BarBundle;

use BarBundle\DependencyInjection\BarExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class BarBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        // Register the extension to load services and configuration
        $container->registerExtension(new BarExtension());
    }
}

