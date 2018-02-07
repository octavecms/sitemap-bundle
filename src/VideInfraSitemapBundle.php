<?php

namespace VideInfra\SitemapBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use VideInfra\SitemapBundle\DependencyInjection\Compiler\SourcePass;

/**
 * @author Igor Lukashov <igor.lukashov@videinfra.com>
 */
class VideInfraSitemapBundle extends Bundle
{
    /**
     * @param ContainerBuilder $container
     */
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new SourcePass());
    }
}