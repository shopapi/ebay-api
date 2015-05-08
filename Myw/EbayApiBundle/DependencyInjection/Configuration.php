<?php

namespace Myw\EbayApiBundle\DependencyInjection;

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
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('myw_ebay_api');

        $rootNode
            ->children()
                ->scalarNode('auth_token')
                    ->validate()
                        ->ifNull()
                        ->thenInvalid('The auth_token must be defined')
                    ->end()
                ->end()
                ->scalarNode('version')
                ->end()
                ->scalarNode('warning_level')
                ->end()
                ->arrayNode('sandbox')
                    ->children()
                        ->scalarNode('dev_id')->cannotBeEmpty()->end()
                        ->scalarNode('app_name')->cannotBeEmpty()->end()
                        ->scalarNode('cert_name')->cannotBeEmpty()->end()
                    ->end()
                ->end()

                ->arrayNode('production')
                    ->children()
                        ->scalarNode('dev_id')->cannotBeEmpty()->end()
                        ->scalarNode('app_name')->cannotBeEmpty()->end()
                        ->scalarNode('cert_name')->cannotBeEmpty()->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
