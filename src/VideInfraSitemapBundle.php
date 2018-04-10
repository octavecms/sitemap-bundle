<?php

namespace Octave\SitemapBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Octave\SitemapBundle\DependencyInjection\Compiler\SourcePass;

/**
 * @author Igor Lukashov <igor.lukashov@octavecms.com>
 */
class OctaveSitemapBundle extends Bundle
{
    /**
     * @param ContainerBuilder $container
     */
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new SourcePass());
    }
}