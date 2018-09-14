<?php

namespace Bonnier\SiteManager\Services;

use Bonnier\SiteManager\Models\Site;
use Bonnier\SiteManager\Repositories\SiteRepository;
use Illuminate\Support\Collection;

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

    public function getAll(): ?Collection
    {
        if ($sites = $this->siteRepository->getAll()) {
            return collect($sites)->map(function ($site) {
                return new Site($site);
            });
        }

        return null;
    }

    public function getById(int $siteId): ?Site
    {
        if ($site = $this->siteRepository->findById($siteId)) {
            return new Site($site);
        }

        return null;
    }
}
