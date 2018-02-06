<?php

namespace VideInfra\SitemapBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * @author Igor Lukashov <igor.lukashov@videinfra.com>
 */
class SourcePass implements CompilerPassInterface
{
    /**
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->has('vig.sitemap.generator')) {
            return;
        }

        $definition = $container->findDefinition('vig.sitemap.generator');
        $taggedServices = $container->findTaggedServiceIds('vig.sitemap.source');

        foreach ($taggedServices as $id => $tags) {
            $definition->addMethodCall('addSource', [new Reference($id)]);
        }
    }
}