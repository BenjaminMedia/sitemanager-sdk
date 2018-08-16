<?php

namespace Bonnier\SiteManager\Repositories;

class CategoryRepository extends BaseRepository
{
    public function getAll()
    {
        return $this->get('/api/v1/categories');
    }

    public function findById(int $categoryId)
    {
        return $this->get(sprintf('/api/v1/categories/%s', $categoryId));
    }

    public function findByContentHubId(int $contenthubId)
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
