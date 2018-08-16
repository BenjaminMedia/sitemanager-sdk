<?php

namespace Bonnier\SiteManager\Models;

class Vocabulary
{
    protected $vobabularyData;

    /**
     * Vocabulary constructor.
     * @param $vobabulary
     */
    public function __construct($vobabulary)
    {
        $this->vobabularyData = $vobabulary;
    }
}
