<?php

namespace Bonnier\SiteManager\Tests\Unit\Models;

use Bonnier\SiteManager\Models\Category;
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

        $this->assertCategory($category, $data);
    }

    private function assertCategory(Category $category, \stdClass $data)
    {
        $this->assertEquals($data->id, $category->getId());
        $this->assertEquals($data->created_at, $category->getCreated()->format(Generators::DATE_FORMAT));
        $this->assertEquals($data->updated_at, $category->getUpdated()->format(Generators::DATE_FORMAT));
        $this->assertEquals($data->brand->id, $category->getBrand());

        $this->assertInstanceOf(Collection::class, $category->getNames());
        $this->assertInstanceOf(Collection::class, $category->getDescriptions());
        $this->assertInstanceOf(Collection::class, $category->getContenthubIds());
        $this->assertInstanceOf(Collection::class, $category->getImages());
        $this->assertInstanceOf(Collection::class, $category->getBodies());
        $this->assertInstanceOf(Collection::class, $category->getMetaTitles());
        $this->assertInstanceOf(Collection::class, $category->getMetaDescriptions());

        $this->assertCount(4, $category->getNames());
        $this->assertCount(4, $category->getDescriptions());
        $this->assertCount(4, $category->getContenthubIds());
        $this->assertCount(4, $category->getImages());
        $this->assertCount(4, $category->getBodies());
        $this->assertCount(4, $category->getMetaTitles());
        $this->assertCount(4, $category->getMetaDescriptions());

        $this->assertEquals($data->name->da, $category->getName('da'));
        $this->assertEquals($data->description->da, $category->getDescription('da'));
        $this->assertEquals($data->content_hub_ids->da, $category->getContenthubId('da'));
        $this->assertEquals($data->image_url->da, $category->getImage('da'));
        $this->assertEquals($data->body->da, $category->getBody('da'));
        $this->assertEquals($data->meta_title->da, $category->getMetaTitle('da'));
        $this->assertEquals($data->meta_description->da, $category->getMetaDescription('da'));

        if ($data->parent ?? false) {
            $this->assertInstanceOf(Category::class, $category->getParent());
            $this->assertCategory($category->getParent(), $data->parent);
        }
    }
}
