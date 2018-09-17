<?php

namespace Bonnier\SiteManager\Tests\Unit\Models;

use Bonnier\SiteManager\Models\App;
use Bonnier\SiteManager\Tests\Unit\Helpers\Asserts;
use Bonnier\SiteManager\Tests\Unit\Helpers\Generators;
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
        $this->assertEmpty($app->getNames());
    }

    public function testCanFormatDataProperly()
    {
        $data = Generators::generateApp();

        $app = new App($data);

        Asserts::assertApp($app, $data);
    }

    public function testCanSetCollectionDirectly()
    {
        $app = new App(null);
        $app->setNames(collect([
            'da' => 'test DA',
            'sv' => 'test SV'
        ]));

        $this->assertEquals('test DA', $app->getName('da'));
        $this->assertEquals('test SV', $app->getName('sv'));
    }
}
