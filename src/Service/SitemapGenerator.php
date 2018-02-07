<?php

namespace VideInfra\SitemapBundle\Service;

use Symfony\Bundle\TwigBundle\TwigEngine;

/**
 * @author Igor Lukashov <igor.lukashov@videinfra.com>
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
        $this->path = realpath($rootDir . '/../web') . '/' . $path;
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

        $content = $this->templating->render('VideInfraSitemapBundle::sitemap.xml.twig', [
            'items' => $items
        ]);

        file_put_contents($this->path, $content);
    }
}