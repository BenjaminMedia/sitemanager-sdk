<?php

namespace Bonnier\SiteManager\Services;

use Bonnier\SiteManager\Models\App;
use Bonnier\SiteManager\Repositories\AppRepository;
use Illuminate\Support\Collection;

class AppService
{
    /** @var AppRepository */
    protected $repository;

    /**
     * AppService constructor.
     * @param AppRepository $appRepository
     */
    public function __construct(AppRepository $appRepository)
    {
        $this->repository = $appRepository;
    }

    public function getAll(): ?Collection
    {
        if ($apps = $this->repository->getAll()) {
            return collect($apps)->map(function ($app) {
                return new App($app);
            });
        }

        return null;
    }

    public function getById(int $appId): ?App
    {
        if ($app = $this->repository->getById($appId)) {
            return new App($app);
        }

        return null;
    }
}
