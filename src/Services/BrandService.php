<?php

namespace Bonnier\SiteManager\Services;

use Bonnier\SiteManager\Models\Brand;
use Bonnier\SiteManager\Repositories\BrandRepository;

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

    public function getAll()
    {
        if ($brands = $this->brandRepository->getAll()) {
            return collect($brands)->map(function ($brand) {
                return new Brand($brand);
            });
        }
    }

}
