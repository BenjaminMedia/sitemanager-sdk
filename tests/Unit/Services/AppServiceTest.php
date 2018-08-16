<?php

namespace Bonnier\SiteManager\Tests\Unit\Services;

use Bonnier\SiteManager\Repositories\AppRepository;
use Bonnier\SiteManager\Services\AppService;

class AppServiceTest extends BaseService
{
    protected $repoClass = AppRepository::class;
    protected $serviceClass = AppService::class;
}
