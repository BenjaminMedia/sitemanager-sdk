<?php

namespace Bonnier\SiteManager\Repositories;

class AppRepository extends BaseRepository
{
    public function getAll()
    {
        return $this->get('/api/v1/apps');
    }

    public function getById(int $appId)
    {
        return $this->get(sprintf('/api/v1/apps/%s', $appId));
    }
}
