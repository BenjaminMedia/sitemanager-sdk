<?php

namespace Bonnier\SiteManager\Models;

class Brand
{
    protected $brandData;

    /**
     * Brand constructor.
     * @param $brand
     */
    public function __construct($brand)
    {
        $this->brandData = $brand;
    }
}
