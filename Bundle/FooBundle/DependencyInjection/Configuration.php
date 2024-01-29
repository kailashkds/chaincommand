<?php

namespace FooBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration.
 *
 * This class implements the ConfigurationInterface and provides a way to create a configuration tree builder.
 */
class Configuration implements ConfigurationInterface
{
    /**
     * Returns the configuration tree builder for the foo_bundle.
     *
     * @return TreeBuilder the configuration tree builder instance
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('foo_bundle');
        $rootNode = $treeBuilder->getRootNode();

        return $treeBuilder;
    }
}
