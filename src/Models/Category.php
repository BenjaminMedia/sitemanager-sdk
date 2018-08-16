<?php

namespace Bonnier\SiteManager\Models;

class Category
{
    protected $categoryData;

    /**
     * Category constructor.
     * @param $category
     */
    public function __construct($category)
    {
        $this->categoryData = $category;
    }
}
