<?php

declare(strict_types=1);

namespace Leapt\CoreBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('leapt_core');
        $rootNode = $treeBuilder->getRootNode();

        $rootNode
            ->children()
                ->scalarNode('upload_dir')->defaultValue('%kernel.project_dir%/public')->end()
                ->arrayNode('google_analytics')
                ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('tracking_id')->defaultNull()->end()
                        ->scalarNode('domain_name')->defaultValue('auto')->end()
                        ->booleanNode('allow_linker')->defaultValue(false)->end()
                        ->booleanNode('debug')->defaultValue(false)->end()
                    ->end()
                ->end()
                ->arrayNode('google_tags_manager')
                ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('id')->defaultNull()->end()
                    ->end()
                ->end()
                ->arrayNode('facebook')
                ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('app_id')->defaultNull()->end()
                    ->end()
                ->end()
                ->arrayNode('paginator')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('template')->defaultValue('@LeaptCore/Paginator/paginator_default_layout.html.twig')->end()
                    ->end()
                ->end()
                ->arrayNode('recaptcha')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('public_key')->defaultNull()->end()
                        ->scalarNode('private_key')->defaultNull()->end()
                        ->booleanNode('enabled')->defaultTrue()->end()
                        ->booleanNode('verify_host')->defaultFalse()->end()
                        ->booleanNode('ajax')->defaultFalse()->end()
                        ->scalarNode('locale_key')->defaultValue('%kernel.default_locale%')->end()
                        ->booleanNode('locale_from_request')->defaultFalse()->end()
                        ->scalarNode('api_host')->defaultValue('www.google.com')->end()
                        ->booleanNode('hide_badge')->defaultValue(false)->end()
                        ->floatNode('score_threshold')->min(0.0)->max(1.0)->defaultValue(0.5)->end()
                        ->arrayNode('http_proxy')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('host')->defaultValue(null)->end()
                                ->scalarNode('port')->defaultValue(null)->end()
                                ->scalarNode('auth')->defaultValue(null)->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
        ;

        return $treeBuilder;
    }
}
