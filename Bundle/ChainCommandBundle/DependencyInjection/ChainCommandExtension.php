<?php

namespace ChainCommandBundle\DependencyInjection;

use ChainCommandBundle\EventListener\ConsoleCommandListener;
use ChainCommandBundle\Service\ChainCommandManager;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;

/**
 * The ChainCommandExtension class is responsible for loading the configuration
 * and registering services related to chain commands.
 */
class ChainCommandExtension extends Extension
{
    /**
     * Loads the configuration and registers services related to console commands.
     *
     * @param array            $configs   the array of configuration values
     * @param ContainerBuilder $container the container builder instance
     */
    public function load(array $configs, ContainerBuilder $container): void
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
