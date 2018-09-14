<?php

namespace Bonnier\SiteManager\Tests\Unit\Models;

use Bonnier\SiteManager\Models\Tag;
use Bonnier\SiteManager\Tests\Unit\Helpers\Generators;
use Illuminate\Support\Collection;
use PHPUnit\Framework\TestCase;

class TagTest extends TestCase
{
    public function testCanHandleNullData()
    {
        $tag = new Tag(null);

        $this->assertNull($tag->getId());
        $this->assertNull($tag->getCreated());
        $this->assertNull($tag->getUpdated());
        $this->assertNull($tag->getBrand());
        $this->assertNull($tag->getVocabulary());

        $this->assertEmpty($tag->getNames());
        $this->assertEmpty($tag->getContentHubIds());
        $this->assertEmpty($tag->getMetaTitles());
        $this->assertEmpty($tag->getMetaDescriptions());

        $this->assertInstanceOf(Collection::class, $tag->getNames());
        $this->assertInstanceOf(Collection::class, $tag->getContentHubIds());
        $this->assertInstanceOf(Collection::class, $tag->getMetaTitles());
        $this->assertInstanceOf(Collection::class, $tag->getMetaDescriptions());

        $this->assertNull($tag->getName('da'));
        $this->assertNull($tag->getContentHubId('da'));
        $this->assertNull($tag->getMetaTitle('da'));
        $this->assertNull($tag->getMetaDescription('da'));
    }

    public function testCanFormatDataProperly()
    {
        $data = Generators::generateTag();

        $tag = new Tag($data);

        $this->assertEquals($data->id, $tag->getId());
        $this->assertEquals($data->created_at, $tag->getCreated()->format(Generators::DATE_FORMAT));
        $this->assertEquals($data->updated_at, $tag->getUpdated()->format(Generators::DATE_FORMAT));
        $this->assertEquals($data->brand->id, $tag->getBrand());
        $this->assertEquals($data->vocabulary->id, $tag->getVocabulary());

        $this->assertInstanceOf(Collection::class, $tag->getNames());
        $this->assertInstanceOf(Collection::class, $tag->getContentHubIds());
        $this->assertInstanceOf(Collection::class, $tag->getMetaTitles());
        $this->assertInstanceOf(Collection::class, $tag->getMetaDescriptions());

        $this->assertCount(4, $tag->getNames());
        $this->assertCount(4, $tag->getContentHubIds());
        $this->assertCount(4, $tag->getMetaTitles());
        $this->assertCount(4, $tag->getMetaDescriptions());

        $this->assertEquals($data->name->da, $tag->getName('da'));
        $this->assertEquals($data->content_hub_ids->da, $tag->getContentHubId('da'));
        $this->assertEquals($data->meta_title->da, $tag->getMetaTitle('da'));
        $this->assertEquals($data->meta_description->da, $tag->getMetaDescription('da'));
    }
}
