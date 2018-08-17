<?php

require_once 'vendor/autoload.php';

dd(collect(null));

$sitemanager = new \Bonnier\SiteManager\SiteManager('http://site-manager.test');

dd($sitemanager->app()->getById(1));

