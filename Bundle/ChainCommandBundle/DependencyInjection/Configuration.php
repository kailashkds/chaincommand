<?php

namespace ChainCommandBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration.
 *
 * This class is responsible for defining the configuration structure for the ChainCommandBundle.
 * It implements the ConfigurationInterface.
 */
class Configuration implements ConfigurationInterface
{
    /**
     * Returns the configuration tree builder for the ChainCommandBundle.
     *
     * @return TreeBuilder the configuration tree builder
     */
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('chain_command_bundle');
        $rootNode = $treeBuilder->getRootNode();

        $rootNode
            ->children()
                ->arrayNode('chains')
                    ->useAttributeAsKey('chain_name')
                    ->arrayPrototype()
                        ->arrayPrototype()
                            ->arrayPrototype()->end()
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
