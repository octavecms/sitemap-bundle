<?php

namespace Octave\SitemapBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * @author Igor Lukashov <igor.lukashov@octavecms.com>
 */
class SourcePass implements CompilerPassInterface
{
    /**
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->has('octave.sitemap.generator')) {
            return;
        }

        $definition = $container->findDefinition('octave.sitemap.generator');
        $taggedServices = $container->findTaggedServiceIds('octave.sitemap.source');

        foreach ($taggedServices as $id => $tags) {
            $definition->addMethodCall('addSource', [new Reference($id)]);
        }
    }
}