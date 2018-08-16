<?php

namespace Bonnier\SiteManager\Services;

use Bonnier\SiteManager\Repositories\CategoryRepository;

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

}
