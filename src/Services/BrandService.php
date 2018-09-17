<?php

namespace Bonnier\SiteManager\Services;

use Bonnier\SiteManager\Models\Brand;
use Bonnier\SiteManager\Repositories\BrandRepository;
use Illuminate\Support\Collection;

class BrandService
{
    /** @var BrandRepository */
    protected $repository;

    /**
     * BrandService constructor.
     * @param BrandRepository $brandRepository
     */
    public function __construct(BrandRepository $brandRepository)
    {
        $this->repository = $brandRepository;
    }

    public function getAll(): ?Collection
    {
        if ($brands = $this->repository->getAll()) {
            return collect($brands)->map(function ($brand) {
                return new Brand($brand);
            });
        }

        return null;
    }

    public function getById(int $brandId): ?Brand
    {
        if ($brand = $this->repository->findById($brandId)) {
            return new Brand($brand);
        }

        return null;
    }
}
