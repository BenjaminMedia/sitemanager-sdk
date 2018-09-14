<?php

namespace Bonnier\SiteManager\Tests\Unit\Services;

use Bonnier\SiteManager\Repositories\TagRepository;
use Bonnier\SiteManager\Services\TagService;
use Bonnier\SiteManager\Tests\Unit\ServiceTestCase;

class TagServiceTest extends ServiceTestCase
{
    protected $repoClass = TagRepository::class;
    protected $serviceClass = TagService::class;
}
