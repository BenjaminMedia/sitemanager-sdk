<?php

namespace Bonnier\SiteManager\Services;

use Bonnier\SiteManager\Repositories\TagRepository;

class TagService
{
    /** @var TagRepository */
    protected $tagRepository;

    /**
     * TagService constructor.
     * @param TagRepository $tagRepository
     */
    public function __construct(TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

}
