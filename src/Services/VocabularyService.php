<?php

namespace Bonnier\SiteManager\Services;


use Bonnier\SiteManager\Repositories\VocabularyRepository;

class VocabularyService
{
    /** @var VocabularyRepository */
    protected $vocabularyRepository;

    /**
     * VocabularyService constructor.
     * @param VocabularyRepository $vocabularyRepository
     */
    public function __construct(VocabularyRepository $vocabularyRepository)
    {
        $this->vocabularyRepository = $vocabularyRepository;
    }

}
