<?php

namespace Bonnier\SiteManager\Services;

use Bonnier\SiteManager\Models\Brand;
use Bonnier\SiteManager\Repositories\BrandRepository;
use Illuminate\Support\Collection;

class BrandService
{
    /** @var BrandRepository */
    protected $brandRepository;

    /**
     * BrandService constructor.
     * @param BrandRepository $brandRepository
     */
    public function __construct(BrandRepository $brandRepository)
    {
        $this->brandRepository = $brandRepository;
    }

    public function getAll(): ?Collection
    {
        if ($brands = $this->brandRepository->getAll()) {
            return collect($brands)->map(function ($brand) {
                return new Brand($brand);
            });
        }

        return null;
    }

    public function getById(int $brandId): ?Brand
    {
        if ($brand = $this->brandRepository->findById($brandId)) {
            return new Brand($brand);
        }

        return null;
    }
}
