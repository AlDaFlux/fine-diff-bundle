<?php

namespace Aldaflux\FineDiffBundle\DependencyInjection;

use Aldaflux\FineDiffBundle\FineDiff\FineDiff;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
 
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder() :TreeBuilder
    {
        $treeBuilder = new TreeBuilder('aldaflux_fine_diff');
        $rootNode = $treeBuilder->getRootNode(); 
        $rootNode
            ->children()
                ->enumNode('default_granularity')
                    ->values(array_keys(self::getGranularities()))
                    ->defaultValue('character')
                ->end()
            ->end()
        ;


        return $treeBuilder;
    }

    public static function getGranularities()
    {
        return [
            'character' => FineDiff::$characterGranularity,
            'word'      => FineDiff::$wordGranularity,
            'sentence'  => FineDiff::$sentenceGranularity,
            'paragraph' => FineDiff::$paragraphGranularity,
        ];
    }
}
