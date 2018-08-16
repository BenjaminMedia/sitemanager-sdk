<?php

namespace Bonnier\SiteManager\Models;

class Tag
{
    protected $tagData;

    /**
     * Tag constructor.
     * @param $tag
     */
    public function __construct($tag)
    {
        $this->tagData = $tag;
    }
}
