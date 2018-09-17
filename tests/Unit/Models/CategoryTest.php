<?php

namespace Bonnier\SiteManager\Tests\Unit\Models;

use Bonnier\SiteManager\Models\Category;
use Bonnier\SiteManager\Tests\Unit\Helpers\Asserts;
use Bonnier\SiteManager\Tests\Unit\Helpers\Generators;
use Illuminate\Support\Collection;
use PHPUnit\Framework\TestCase;

class CategoryTest extends TestCase
{
    public function testCanHandleNullData()
    {
        $category = new Category(null);
        $this->assertNull($category->getId());
        $this->assertNull($category->getCreated());
        $this->assertNull($category->getUpdated());
        $this->assertNull($category->getBrand());
        $this->assertNull($category->getParent());

        $this->assertInstanceOf(Collection::class, $category->getNames());
        $this->assertInstanceOf(Collection::class, $category->getDescriptions());
        $this->assertInstanceOf(Collection::class, $category->getContenthubIds());
        $this->assertInstanceOf(Collection::class, $category->getImages());
        $this->assertInstanceOf(Collection::class, $category->getBodies());
        $this->assertInstanceOf(Collection::class, $category->getMetaTitles());
        $this->assertInstanceOf(Collection::class, $category->getMetaDescriptions());

        $this->assertEmpty($category->getNames());
        $this->assertEmpty($category->getDescriptions());
        $this->assertEmpty($category->getContenthubIds());
        $this->assertEmpty($category->getImages());
        $this->assertEmpty($category->getBodies());
        $this->assertEmpty($category->getMetaTitles());
        $this->assertEmpty($category->getMetaDescriptions());

        $this->assertNull($category->getName('da'));
        $this->assertNull($category->getDescription('da'));
        $this->assertNull($category->getContenthubId('da'));
        $this->assertNull($category->getImage('da'));
        $this->assertNull($category->getBody('da'));
        $this->assertNull($category->getMetaTitle('da'));
        $this->assertNull($category->getMetaDescription('da'));
    }

    public function testCanFormatDataProperly()
    {
        $parent = Generators::generateCategory([
            'id' => 1,
            'name' => 'Parent Category %s',
        ]);

        $data = Generators::generateCategory([
            'id' => 2,
            'name' => 'Child Category %s',
            'parent' => $parent
        ]);

        $category = new Category($data);

        Asserts::assertCategory($category, $data);
    }
}
