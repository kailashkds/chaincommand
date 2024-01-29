<?php

namespace ChainCommandBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use ChainCommandBundle\DependencyInjection\ChainCommandExtension;

class ChainCommandBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        // Register the extension to load services and configuration
        $container->registerExtension(new ChainCommandExtension());
    }
}

