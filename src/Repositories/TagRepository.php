<?php

namespace Bonnier\SiteManager\Repositories;

class TagRepository extends BaseRepository
{
    public function getAll(int $page = 1)
    {
        return $this->get(
            '/api/v1/tags',
            [
                'query' => [
                    'page' => $page
                ]
            ]
        );
    }

    public function findById(int $tagId)
    {
        return $this->get(sprintf('/api/v1/tags/%s', $tagId));
    }

    public function findByBrandId(int $brandId, int $page = 1)
    {
        return $this->get(
            sprintf('/api/v1/tags/brand/%s', $brandId),
            [
                'query' => [
                    'page' => $page
                ]
            ]
        );
    }

    public function findByContentHubId(string $contenthubId)
    {
        return $this->get(sprintf('/api/v1/tags/content-hub-id/%s', $contenthubId));
    }
}
