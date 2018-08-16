<?php

namespace Bonnier\SiteManager\Repositories;

class SiteRepository extends BaseRepository
{
    public function getAll()
    {
        return $this->get('/api/v1/sites');
    }

    public function findById(int $siteId)
    {
        $this->get(sprintf('/api/v1/sites/%s', $siteId));
    }
}
