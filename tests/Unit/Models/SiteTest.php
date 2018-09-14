<?php

namespace Bonnier\SiteManager\Tests\Unit\Models;

use Bonnier\SiteManager\Models\Site;
use Bonnier\SiteManager\Tests\Unit\Helpers\Asserts;
use Bonnier\SiteManager\Tests\Unit\Helpers\Generators;
use PHPUnit\Framework\TestCase;

class SiteTest extends TestCase
{
    public function testCanHandleNullData()
    {
        $site = new Site(null);

        $this->assertNull($site->getId());
        $this->assertNull($site->getName());
        $this->assertNull($site->getDescription());
        $this->assertNull($site->getDomain());
        $this->assertNull($site->getLoginDomain());
        $this->assertNull($site->getApiDomain());
        $this->assertNull($site->getLanguage());
        $this->assertNull($site->getLocale());
        $this->assertNull($site->getShellUrl());
        $this->assertNull($site->getCreated());
        $this->assertNull($site->getUpdated());
        $this->assertFalse($site->isSecure());
        $this->assertNull($site->getCxenseSiteId());
        $this->assertNull($site->getFacebookId());
        $this->assertNull($site->getFacebookSecret());
        $this->assertNull($site->getSignupLeadPermission());
        $this->assertNull($site->getApp());
        $this->assertNull($site->getBrand());
        $this->assertNull($site->getConfigurations());
    }

    public function testCanFormatDataProperly()
    {
        $data = Generators::generateSite();

        $site = new Site($data);

        Asserts::assertSite($site, $data);
    }
}
