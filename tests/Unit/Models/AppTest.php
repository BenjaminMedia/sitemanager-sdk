<?php

namespace Bonnier\SiteManager\Tests\Unit\Models;

use Bonnier\SiteManager\Models\App;
use Illuminate\Support\Collection;
use PHPUnit\Framework\TestCase;

class AppTest extends TestCase
{
    public function testCanHandleNullData()
    {
        $app = new App(null);
        $this->assertNull($app->getId());
        $this->assertNull($app->getContenthubId());
        $this->assertNull($app->getCode());
        $this->assertNull($app->getName('da'));
        $this->assertNull($app->getCreated());
        $this->assertNull($app->getUpdated());
        $this->assertInstanceOf(Collection::class, $app->getNames());
        $this->assertCount(0, $app->getNames());
    }

    public function testCanFormatDataProperly()
    {
        $data = new \stdClass();

        $data->id = 1;
        $data->name = new \stdClass();
        $data->name->da = 'Test App DA';
        $data->name->sv = 'Test App SV';
        $data->name->fi = 'Test App FI';
        $data->name->no = 'Test App NO';
        $data->app_code = 'Test App Code';
        $data->created_at = '2018-08-01 08:00:00';
        $data->updated_at = '2018-08-17 08:55:00';
        $data->content_hub_id = 'TEST_CONTENTHUB_ID';

        $app = new App($data);

        $this->assertEquals($data->id, $app->getId());
        $this->assertEquals($data->app_code, $app->getCode());
        $this->assertEquals($data->content_hub_id, $app->getContenthubId());

        $this->assertInstanceOf(\DateTime::class, $app->getCreated());
        $this->assertInstanceOf(\DateTime::class, $app->getUpdated());
        $this->assertInstanceOf(Collection::class, $app->getNames());
        $this->assertEquals($data->created_at, $app->getCreated()->format('Y-m-d H:i:s'));
        $this->assertEquals($data->updated_at, $app->getUpdated()->format('Y-m-d H:i:s'));
        $this->assertCount(4, $app->getNames());
        $this->assertEquals($data->name->da, $app->getName('da'));
        $this->assertEquals($data->name->sv, $app->getName('sv'));
        $this->assertEquals($data->name->fi, $app->getName('fi'));
        $this->assertEquals($data->name->no, $app->getName('no'));
    }
}
