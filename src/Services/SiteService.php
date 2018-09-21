<?php

namespace Bonnier\SiteManager\Services;

use Bonnier\SiteManager\Models\Site;
use Bonnier\SiteManager\Repositories\SiteRepository;
use Illuminate\Support\Collection;

class SiteService
{
    /** @var SiteRepository */
    protected $repository;

    /**
     * SiteService constructor.
     * @param SiteRepository $siteRepository
     */
    public function __construct(SiteRepository $siteRepository)
    {
        $this->repository = $siteRepository;
    }

    public function getAll(): ?Collection
    {
        if ($sites = $this->repository->getAll()) {
            return collect($sites)->map(function ($site) {
                return new Site($site);
            });
        }

        return null;
    }

    public function getById(int $siteId): ?Site
    {
        if ($site = $this->repository->findById($siteId)) {
            return new Site($site);
        }

        return null;
    }

    public function getByDomain(string $domain): ?Site
    {
        if ($site = $this->repository->findByDomain($domain)) {
            return new Site($site);
        }

        return null;
    }

    public function getByLoginDomain(string $loginDomain): ?Site
    {
        if ($site = $this->repository->findByLoginDomain($loginDomain)) {
            return new Site($site);
        }

        return null;
    }
}
