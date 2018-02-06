<?php

namespace VideInfra\SitemapBundle\Service;

interface SourceInterface
{
    /**
     * @return array
     */
    public function getItems();
}