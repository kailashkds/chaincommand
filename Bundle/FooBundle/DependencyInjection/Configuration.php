<?php

namespace FooBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('foo_bundle');
        $rootNode = $treeBuilder->getRootNode();

        return $treeBuilder;
    }
}
