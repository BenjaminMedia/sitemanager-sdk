<?php

namespace Bonnier\SiteManager\Traits;

use Illuminate\Support\Collection;

trait PaginationTrait
{
    protected function unravelPagination(?Collection $items = null, int $page = 1): Collection
    {
        return $this->unravelEndpointPagination('getAll', null, $items, $page);
    }

    protected function unravelEndpointPagination(string $endpoint, $param, ?Collection $items = null, int $page = 1)
    {
        if (!$items) {
            $items = new Collection();
        }

        if ($param) {
            $response = $this->repository->$endpoint($param, $page);
        } else {
            $response = $this->repository->$endpoint($page);
        }
        if ($response) {
            $items = $items->concat($response->data);
            if ($page < $response->meta->pagination->total_pages) {
                $nextPage = $page + 1;
                return $this->unravelEndpointPagination($endpoint, $param, $items, $nextPage);
            }
        }

        return $items;
    }
}
