<?php

namespace Bonnier\SiteManager\Tests\Unit\Models;

use Bonnier\SiteManager\Models\Brand;
use Bonnier\SiteManager\Tests\Unit\Helpers\Asserts;
use Bonnier\SiteManager\Tests\Unit\Helpers\Generators;
use Illuminate\Support\Collection;
use PHPUnit\Framework\TestCase;

class BrandTest extends TestCase
{
    public function testCanHandleNullData()
    {
        $brand = new Brand(null);
        $this->assertNull($brand->getId());
        $this->assertNull($brand->getContenthubId());
        $this->assertNull($brand->getCode());
        $this->assertNull($brand->getCreated());
        $this->assertNull($brand->getUpdated());
        $this->assertNull($brand->getPrimaryColor());
        $this->assertNull($brand->getSecondaryColor());
        $this->assertNull($brand->getTertiaryColor());
        $this->assertFalse($brand->isLogoBgColorWhite());
        $this->assertEmpty($brand->getIssuesPerYear());
        $this->assertNull($brand->getLogoPath());
        $this->assertInstanceOf(Collection::class, $brand->getNames());
        $this->assertInstanceOf(Collection::class, $brand->getMailSenders());
        $this->assertEmpty($brand->getNames());
        $this->assertEmpty($brand->getMailSenders());
        $this->assertNull($brand->getName('da'));
        $this->assertNull($brand->getMailSender('da'));
    }

    public function testCanFormatDataProperly()
    {
        $data = Generators::generateBrand();

        $brand = new Brand($data);

        Asserts::assertBrand($brand, $data);
    }
}
