<?php

namespace Bonnier\SiteManager\Tests\Unit\Models;

use Bonnier\SiteManager\Models\Brand;
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
        $this->assertEquals(0, $brand->getIssuesPerYear());
        $this->assertNull($brand->getLogoPath());
        $this->assertInstanceOf(Collection::class, $brand->getNames());
        $this->assertInstanceOf(Collection::class, $brand->getMailSenders());
        $this->assertCount(0, $brand->getNames());
        $this->assertCount(0, $brand->getMailSenders());
        $this->assertNull($brand->getName('da'));
        $this->assertNull($brand->getMailSender('da'));
    }

    public function testCanFormatDataProperly()
    {
        $data = new \stdClass();

        $data->id = 1;
        $data->name = new \stdClass();
        $data->name->da = 'Test Brand DA';
        $data->name->sv = 'Test Brand SV';
        $data->name->fi = 'Test Brand FI';
        $data->name->no = 'Test Brand NO';
        $data->brand_code = 'Test Brand Code';
        $data->created_at = '2018-08-01 08:00:00';
        $data->updated_at = '2018-08-17 08:55:00';
        $data->content_hub_id = 'TEST_CONTENTHUB_ID';
        $data->primary_color = '#abefed';
        $data->secondary_color = '#fedabe';
        $data->tertiary_color = '#b00b1e';
        $data->logo_bg_color_white = 1;
        $data->issues_per_year = 18;
        $data->logo_path = 'https://bonnier.cloud/path/to/logo.png';
        $data->mail_from_address = new \stdClass();
        $data->mail_from_address->da = 'test@example.dk';
        $data->mail_from_address->sv = 'test@example.sv';
        $data->mail_from_address->fi = 'test@example.fi';
        $data->mail_from_address->no = 'test@example.no';

        $brand = new Brand($data);

        $this->assertEquals($data->id, $brand->getId());
        $this->assertEquals($data->brand_code, $brand->getCode());
        $this->assertEquals($data->content_hub_id, $brand->getContenthubId());
        $this->assertEquals($data->primary_color, $brand->getPrimaryColor());
        $this->assertEquals($data->secondary_color, $brand->getSecondaryColor());
        $this->assertEquals($data->tertiary_color, $brand->getTertiaryColor());
        $this->assertTrue($brand->isLogoBgColorWhite());
        $this->assertEquals($data->issues_per_year, $brand->getIssuesPerYear());
        $this->assertEquals($data->logo_path, $brand->getLogoPath());

        $this->assertInstanceOf(\DateTime::class, $brand->getCreated());
        $this->assertInstanceOf(\DateTime::class, $brand->getUpdated());
        $this->assertInstanceOf(Collection::class, $brand->getNames());
        $this->assertInstanceOf(Collection::class, $brand->getMailSenders());
        $this->assertEquals($data->created_at, $brand->getCreated()->format('Y-m-d H:i:s'));
        $this->assertEquals($data->updated_at, $brand->getUpdated()->format('Y-m-d H:i:s'));
        $this->assertCount(4, $brand->getNames());
        $this->assertCount(4, $brand->getMailSenders());
        $this->assertEquals($data->name->da, $brand->getName('da'));
        $this->assertEquals($data->name->sv, $brand->getName('sv'));
        $this->assertEquals($data->name->fi, $brand->getName('fi'));
        $this->assertEquals($data->name->no, $brand->getName('no'));
        $this->assertEquals($data->mail_from_address->da, $brand->getMailSender('da'));
        $this->assertEquals($data->mail_from_address->sv, $brand->getMailSender('sv'));
        $this->assertEquals($data->mail_from_address->fi, $brand->getMailSender('fi'));
        $this->assertEquals($data->mail_from_address->no, $brand->getMailSender('no'));
    }
}
