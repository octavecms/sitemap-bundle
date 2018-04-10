<?php

namespace Octave\SitemapBundle\Model;

/**
 * @author Igor Lukashov <igor.lukashov@octavecms.com>
 */
class Item
{
    const FREQ_ALWAYS = 'always';
    const FREQ_HOURLY = 'hourly';
    const FREQ_DAILY = 'daily';
    const FREQ_WEEKLY = 'weekly';
    const FREQ_MONTHLY = 'monthly';
    const FREQ_YEARLY = 'yearly';
    const FREQ_NEVER = 'never';

    /** @var string */
    private $location;

    /** @var string */
    private $lastmod;

    /** @var string */
    private $changefreq;

    /** @var float */
    private $priority;

    /**
     * Item constructor.
     * @param null $location
     * @param null $lastmod
     * @param null|string $changefreq
     * @param float|null $priority
     */
    public function __construct($location = null, $lastmod = null, $changefreq = self::FREQ_DAILY, $priority = 1.0)
    {
        $this->location = $location;
        $this->changefreq = $changefreq;
        $this->priority = $priority;

        if (!$lastmod) {
            $lastmod = new \DateTime();
        }

        if ($lastmod instanceof \DateTime) {
            $lastmod = $lastmod->format('c');
        }

        $this->lastmod = $lastmod;
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
     * @return float
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * @param float $priority
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;
    }
}