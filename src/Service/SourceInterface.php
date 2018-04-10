<?php

namespace Octave\SitemapBundle\Service;

interface SourceInterface
{
    /**
     * @return array
     */
    public function getItems();
}