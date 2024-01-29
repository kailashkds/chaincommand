<?php

namespace ChainCommandBundle\DependencyInjection;

use ChainCommandBundle\EventListener\ConsoleCommandListener;
use ChainCommandBundle\Service\ChainCommandManager;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;

use Symfony\Component\DependencyInjection\Reference;

use function Symfony\Component\DependencyInjection\Loader\Configurator\tagged_locator;

class ChainCommandExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->register(ChainCommandManager::class)
                  ->addMethodCall('setChainCommands', [$config['chains']]);
        $container
            ->register(ConsoleCommandListener::class)
            ->setAutowired(true)
            ->addTag('kernel.event_listener', ['event' => 'console.command', 'method' => 'onConsoleCommand']);

    }


}
