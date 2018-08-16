<?php

namespace Bonnier\SiteManager\Tests\Unit\Services;

use Bonnier\SiteManager\Repositories\SiteRepository;
use Bonnier\SiteManager\Services\SiteService;

class SiteServiceTest extends BaseService
{
    protected $repoClass = SiteRepository::class;
    protected $serviceClass = SiteService::class;
}
