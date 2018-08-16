<?php

namespace Bonnier\SiteManager\Services;

use Bonnier\SiteManager\Models\App;
use Bonnier\SiteManager\Repositories\AppRepository;
use Illuminate\Support\Collection;

class AppService
{
    /** @var AppRepository */
    protected $appRepository;

    /**
     * AppService constructor.
     * @param AppRepository $appRepository
     */
    public function __construct(AppRepository $appRepository)
    {
        $this->appRepository = $appRepository;
    }

    public function getAll(): ?Collection
    {
        if ($apps = $this->appRepository->getAll()) {
            return collect($apps)->map(function ($app) {
                return new App($app);
            });
        }

        return null;
    }

    public function getById(int $appId): ?App
    {
        if ($app = $this->appRepository->getById($appId)) {
            return new App($app);
        }

        return null;
    }
}
