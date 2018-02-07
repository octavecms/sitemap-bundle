<?php

namespace VideInfra\SitemapBundle\Model;

/**
 * @author Igor Lukashov <igor.lukashov@videinfra.com>
 */
class Item
{
    /** @var string */
    private $location;

    /** @var string */
    private $lastmod;

    /** @var string */
    private $changefreq;

    /** @var integer */
    private $priority;

    /**
     * Item constructor.
     * @param null $location
     * @param null $lastmod
     * @param null $changefreq
     * @param null $priority
     */
    public function __construct($location = null, $lastmod = null, $changefreq = null, $priority = null)
    {
        $this->location = $location;
        $this->lastmod = $lastmod;
        $this->changefreq = $changefreq;
        $this->priority = $priority;
    }

    /**
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param string $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }

    /**
     * @return string
     */
    public function getLastmod()
    {
        return $this->lastmod;
    }

    /**
     * @param string $lastmod
     */
    public function setLastmod($lastmod)
    {
        $this->lastmod = $lastmod;
    }

    /**
     * @return string
     */
    public function getChangefreq()
    {
        return $this->changefreq;
    }

    /**
     * @param string $changefreq
     */
    public function setChangefreq($changefreq)
    {
        $this->changefreq = $changefreq;
    }

    /**
     * @return int
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * @param int $priority
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;
    }
}