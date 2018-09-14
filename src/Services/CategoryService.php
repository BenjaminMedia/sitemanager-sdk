<?php

namespace Bonnier\SiteManager\Services;

use Bonnier\SiteManager\Repositories\CategoryRepository;
use Illuminate\Support\Collection;

class CategoryService
{
    /** @var CategoryRepository */
    protected $categoryRepository;

    /**
     * CategoryService constructor.
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getAll(int $page = 1)
    {
        if ($response = $this->categoryRepository->getAll($page)) {

        }
    }

    private function unravelPagination($items, $page = 1)
    {
        if (!$items) {
            $items = new Collection();
        }

        if ($response = $this->categoryRepository->getAll($page)) {
            
        }

        return $items;
    }
}
