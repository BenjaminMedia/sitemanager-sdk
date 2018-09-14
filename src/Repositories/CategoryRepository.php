<?php

namespace Bonnier\SiteManager\Repositories;

class CategoryRepository extends BaseRepository
{
    public function getAll(int $page = 1)
    {
        return $this->get(
            '/api/v1/categories',
            [
                'query' => [
                    'page' => $page
                ]
            ]
        );
    }

    public function findById(int $categoryId)
    {
        return $this->get(sprintf('/api/v1/categories/%s', $categoryId));
    }

    public function findByContentHubId(string $contenthubId)
    {
        return $this->get(sprintf('/api/v1/categories/content-hub-id/%s', $contenthubId));
    }

    public function findByBrandId(int $brandId, int $page = 1)
    {
        return $this->get(
            sprintf('/api/v1/categories/brand/%s', $brandId),
            [
                'query' => [
                    'page' => $page
                ]
            ]
        );
    }
}
