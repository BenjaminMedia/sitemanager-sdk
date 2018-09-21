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
        return $this->get(sprintf('/api/v1/sites/%s', $siteId));
    }

    public function findByDomain(string $domain)
    {
        return $this->get(sprintf('/api/v1/sites/domain/%s', $domain));
    }

    public function findByLoginDomain(string $loginDomain)
    {
        return $this->get(sprintf('/api/v1/sites/login-domain/%s', $loginDomain));
    }
}
