<?php

namespace Bonnier\SiteManager\Services;

use Bonnier\SiteManager\Models\Category;
use Bonnier\SiteManager\Repositories\CategoryRepository;
use Bonnier\SiteManager\Traits\PaginationTrait;
use Illuminate\Support\Collection;

class CategoryService
{
    use PaginationTrait;

    /** @var CategoryRepository */
    protected $repository;

    /**
     * CategoryService constructor.
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->repository = $categoryRepository;
    }

    public function getAll(): ?Collection
    {
        if ($categories = $this->unravelPagination()) {
            return $categories->map(function ($category) {
                return new Category($category);
            });
        }

        return null;
    }

    public function getById(int $categoryId): ?Category
    {
        if ($category = $this->repository->findById($categoryId)) {
            return new Category($category);
        }

        return null;
    }

    public function getByContenthubId(string $contenthubId): ?Category
    {
        if ($category = $this->repository->findByContentHubId($contenthubId)) {
            return new Category($category);
        }

        return null;
    }

    public function getByBrandId(int $brandId): ?Collection
    {
        if ($categories = $this->unravelEndpointPagination('findByBrandId', $brandId)) {
            return $categories->map(function ($category) {
                return new Category($category);
            });
        }

        return null;
    }
}
