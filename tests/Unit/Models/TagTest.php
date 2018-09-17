<?php

namespace Bonnier\SiteManager\Tests\Unit\Models;

use Bonnier\SiteManager\Models\Tag;
use Bonnier\SiteManager\Tests\Unit\Helpers\Asserts;
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

        Asserts::assertTag($tag, $data);
    }
}
