<?php

namespace Bonnier\SiteManager\Repositories;

class VocabularyRepository extends BaseRepository
{
    public function getAll(int $page = 1)
    {
        return $this->get(
            '/api/v1/vocabularies',
            [
                'query' => [
                    'page' => $page
                ]
            ]
        );
    }

    public function findById(int $vocabularyId)
    {
        return $this->get(sprintf('/api/v1/vocabularies/%s', $vocabularyId));
    }

    public function findByBrandId(int $brandId, $page = 1)
    {
        return $this->get(
            sprintf('/api/v1/vocabularies/brand/%s', $brandId),
            [
                'query' => [
                    'page' => $page
                ]
            ]
        );
    }
}
