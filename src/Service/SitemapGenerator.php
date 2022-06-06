<?php

namespace Octave\SitemapBundle\Service;

use Symfony\Bundle\TwigBundle\TwigEngine;
use Symfony\Component\HttpKernel\Kernel;
use Twig\Environment;

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

    /** @var string */
    private $host;

    /** @var string */
    private $webPath;

    /**
     * SitemapGenerator constructor.
     * @param Environment $templating
     * @param $rootDir
     * @param $path
     * @param $host
     */
    public function __construct(Environment $templating, $rootDir, $path, $host)
    {
        $this->templating = $templating;
        $this->host = $host;
        $this->webPath = $path;

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

    /**
     * @param int $sliceCount
     */
    public function generateIndex($sliceCount = 10000)
    {
        $sitemaps = [];

        foreach ($this->sources as $index => $source) {

            $items = $source->getItems();
            $itemsCount = count($items);
            if (!$itemsCount) continue;

            if ($itemsCount > $sliceCount) {

                $chunks = array_chunk($items, $sliceCount);
                foreach ($chunks as $chunkIndex => $chunk) {

                    $sitemapName = sprintf('%s/sitemap-%s-%s.xml', $this->path, $index, $chunkIndex);
                    $content = $this->templating->render('OctaveSitemapBundle::sitemap.xml.twig', [
                        'items' => $chunk
                    ]);

                    file_put_contents($sitemapName, $content);
                    $sitemaps[] = sprintf('%s/%s/sitemap-%s-%s.xml', $this->host, $this->webPath, $index, $chunkIndex);
                }
            }
            else {

                $sitemapName = sprintf('%s/sitemap-%s.xml', $this->path, $index);
                $content = $this->templating->render('OctaveSitemapBundle::sitemap.xml.twig', [
                    'items' => $items
                ]);

                file_put_contents($sitemapName, $content);
                $sitemaps[] = sprintf('%s/%s/sitemap-%s.xml', $this->host, $this->webPath, $index);
            }
        }

        $index = $this->templating->render('OctaveSitemapBundle::index.xml.twig', [
            'sitemaps' => $sitemaps
        ]);

        file_put_contents($this->path . '/sitemap.xml', $index);
    }
}