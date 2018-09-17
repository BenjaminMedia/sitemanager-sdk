<?php

namespace Bonnier\SiteManager\Repositories;

class BrandRepository extends BaseRepository
{
    public function getAll()
    {
        return $this->get('/api/v1/brands');
    }

    public function findById(int $brandId)
    {
        return $this->get(sprintf('/api/v1/brands/%s', $brandId));
    }
}
