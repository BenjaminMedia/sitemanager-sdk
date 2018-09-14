<?php

namespace Bonnier\SiteManager\Tests\Unit\Services;

use Bonnier\SiteManager\Repositories\VocabularyRepository;
use Bonnier\SiteManager\Services\VocabularyService;
use Bonnier\SiteManager\Tests\Unit\ServiceTestCase;

class VocabularyServiceTest extends ServiceTestCase
{
    protected $repoClass = VocabularyRepository::class;
    protected $serviceClass = VocabularyService::class;
}
