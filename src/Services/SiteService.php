<?php

namespace Bonnier\SiteManager\Services;

use Bonnier\SiteManager\Repositories\SiteRepository;

class SiteService
{
    /** @var SiteRepository */
    protected $siteRepository;

    /**
     * SiteService constructor.
     * @param SiteRepository $siteRepository
     */
    public function __construct(SiteRepository $siteRepository)
    {
        $this->siteRepository = $siteRepository;
    }


}
