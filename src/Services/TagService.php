<?php

namespace Bonnier\SiteManager\Services;

use Bonnier\SiteManager\Models\Tag;
use Bonnier\SiteManager\Repositories\TagRepository;
use Bonnier\SiteManager\Traits\PaginationTrait;
use Illuminate\Support\Collection;

class TagService
{
    use PaginationTrait;

    /** @var TagRepository */
    protected $repository;

    /**
     * TagService constructor.
     * @param TagRepository $tagRepository
     */
    public function __construct(TagRepository $tagRepository)
    {
        $this->repository = $tagRepository;
    }

    public function getAll(): ?Collection
    {
        if ($tags = $this->unravelPagination()) {
            return $tags->map(function ($tag) {
                return new Tag($tag);
            });
        }

        return null;
    }

    public function getById(int $tagId): ?Tag
    {
        if ($tag = $this->repository->findById($tagId)) {
            return new Tag($tag);
        }

        return null;
    }

    public function getByContenthubId(string $contenthubId): ?Tag
    {
        if ($tag = $this->repository->findByContentHubId($contenthubId)) {
            return new Tag($tag);
        }

        return null;
    }

    public function getByBrandId(int $brandId): ?Collection
    {
        if ($tags = $this->unravelEndpointPagination('findByBrandId', $brandId)) {
            return $tags->map(function ($tag) {
                return new Tag($tag);
            });
        }

        return null;
    }
}
