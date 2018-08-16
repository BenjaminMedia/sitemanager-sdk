<?php

namespace Bonnier\SiteManager\Models;

class Site
{
    protected $siteData;

    /**
     * Site constructor.
     * @param $site
     */
    public function __construct($site)
    {
        $this->siteData = $site;
    }
}
