<?php

namespace BarBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration.
 *
 * This class implements the ConfigurationInterface and is responsible for providing configuration options for the bar_bundle.
 */
class Configuration implements ConfigurationInterface
{
    /**
     * Returns the configuration tree builder for the bar_bundle.
     *
     * The configuration tree builder allows you to define the configuration structure
     * and validation rules for the bar_bundle.
     *
     * @return TreeBuilder the configuration tree builder for the bar_bundle
     */
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('bar_bundle');
        $rootNode = $treeBuilder->getRootNode();

        return $treeBuilder;
    }
}
