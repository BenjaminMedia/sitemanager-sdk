<?php

namespace Bonnier\SiteManager\Services;

use Bonnier\SiteManager\Models\Vocabulary;
use Bonnier\SiteManager\Repositories\VocabularyRepository;
use Bonnier\SiteManager\Traits\PaginationTrait;
use Illuminate\Support\Collection;

class VocabularyService
{
    use PaginationTrait;

    /** @var VocabularyRepository */
    protected $repository;

    /**
     * VocabularyService constructor.
     * @param VocabularyRepository $vocabularyRepository
     */
    public function __construct(VocabularyRepository $vocabularyRepository)
    {
        $this->repository = $vocabularyRepository;
    }

    public function getAll(): ?Collection
    {
        if ($vocabularies = $this->unravelPagination()) {
            return $vocabularies->map(function ($vocabulary) {
                return new Vocabulary($vocabulary);
            });
        }

        return null;
    }

    public function getById(int $vocabularyId): ?Vocabulary
    {
        if ($vocabulary = $this->repository->findById($vocabularyId)) {
            return new Vocabulary($vocabulary);
        }

        return null;
    }

    public function getByBrandId(int $brandId): ?Collection
    {
        if ($vocabularies = $this->unravelEndpointPagination('findByBrandId', $brandId)) {
            return $vocabularies->map(function ($vocabulary) {
                return new Vocabulary($vocabulary);
            });
        }

        return null;
    }
}
