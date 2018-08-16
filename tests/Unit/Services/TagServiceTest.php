<?php

namespace Bonnier\SiteManager\Tests\Unit\Services;

use Bonnier\SiteManager\Repositories\TagRepository;
use Bonnier\SiteManager\Services\TagService;

class TagServiceTest extends BaseService
{
    protected $repoClass = TagRepository::class;
    protected $serviceClass = TagService::class;
}
