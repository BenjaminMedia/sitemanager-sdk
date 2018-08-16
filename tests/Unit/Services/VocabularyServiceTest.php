<?php

namespace Bonnier\SiteManager\Tests\Unit\Services;

use Bonnier\SiteManager\Repositories\VocabularyRepository;
use Bonnier\SiteManager\Services\VocabularyService;

class VocabularyServiceTest extends BaseService
{
    protected $repoClass = VocabularyRepository::class;
    protected $serviceClass = VocabularyService::class;
}
