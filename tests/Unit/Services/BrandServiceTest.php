<?php

namespace Bonnier\SiteManager\Tests\Unit\Services;

use Bonnier\SiteManager\Repositories\BrandRepository;
use Bonnier\SiteManager\Services\BrandService;

class BrandServiceTest extends BaseService
{
    protected $repoClass = BrandRepository::class;
    protected $serviceClass = BrandService::class;
}
