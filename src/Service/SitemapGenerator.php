<?php

namespace Octave\SitemapBundle\Service;

use Symfony\Bundle\TwigBundle\TwigEngine;
use Symfony\Component\HttpKernel\Kernel;

/**
 * @author Igor Lukashov <igor.lukashov@octavecms.com>
 */
class SitemapGenerator
{
    /** @var string */
    private $path;

    /** @var TwigEngine */
    private $templating;

    /** @var array */
    private $sources = [];

    /**
     * SitemapGenerator constructor.
     * @param TwigEngine $templating
     * @param $rootDir
     * @param $path
     */
    public function __construct(TwigEngine $templating, $rootDir, $path)
    {
        $this->templating = $templating;
        if (Kernel::MAJOR_VERSION >= 4 ) {
            $this->path = realpath($rootDir . '/../public') . '/' . $path;
        } else {
            $this->path = realpath($rootDir . '/../web') . '/' . $path;
        }
    }

    /**
     * @param SourceInterface $source
     */
    public function addSource(SourceInterface $source)
    {
        $this->sources[] = $source;
    }

    /**
     * @return void
     */
    public function generate()
    {
        $items = [];

        /** @var SourceInterface $source */
        foreach ($this->sources as $source) {
            $items = array_merge($items, $source->getItems());
        }

        $content = $this->templating->render('OctaveSitemapBundle::sitemap.xml.twig', [
            'items' => $items
        ]);

        file_put_contents($this->path, $content);
    }
}