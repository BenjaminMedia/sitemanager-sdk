<?php

namespace Bonnier\SiteManager\Tests\Unit\Services;

use Bonnier\SiteManager\Repositories\CategoryRepository;
use Bonnier\SiteManager\Services\CategoryService;

class CategoryServiceTest extends BaseService
{
    protected $repoClass = CategoryRepository::class;
    protected $serviceClass = CategoryService::class;
}
