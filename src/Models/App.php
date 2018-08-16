<?php

namespace Bonnier\SiteManager\Models;

class App
{
    protected $appData;

    /**
     * App constructor.
     * @param $app
     */
    public function __construct($app)
    {
        $this->appData = $app;
    }
}
