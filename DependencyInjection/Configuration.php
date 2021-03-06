<?php

namespace Kachkaev\CountersBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('kachkaev_counters');

        $rootNode
            -> children()
                ->booleanNode('disabled')->defaultFalse()->end()
                ->scalarNode('on_off_trigger')->defaultNull()->end()
            ->end();

        $this->addCounter('google_analytics', $rootNode);
        $this->addCounter('yandex_metrika', $rootNode);

        return $treeBuilder;
    }

    protected function addCounter($name, ArrayNodeDefinition $rootNode) {
        $rootNode
            ->children()
                ->arrayNode($name)
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('id')->defaultNull()
                    ->end()
                ->end()
            ->end();
    }
}
