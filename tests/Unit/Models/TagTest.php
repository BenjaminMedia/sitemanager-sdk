<?php

namespace Bonnier\SiteManager\Tests\Unit\Models;

use Bonnier\SiteManager\Models\Tag;
use Bonnier\SiteManager\Tests\Unit\Helpers\Asserts;
use Bonnier\SiteManager\Tests\Unit\Helpers\Generators;
use Illuminate\Support\Collection;
use function PHPSTORM_META\map;
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

    public function testCanSetCollectionsDirectly()
    {
        $tag = new Tag(null);
        $tag->setNames(collect([
            'da' => 'name da',
            'sv' => 'name sv',
        ]));
        $tag->setContentHubIds(collect([
            'da' => 'contenthub id da',
            'sv' => 'contenthub id sv',
        ]));
        $tag->setMetaTitles(collect([
            'da' => 'meta title da',
            'sv' => 'meta title sv'
        ]));
        $tag->setMetaDescriptions(collect([
            'da' => 'meta description da',
            'sv' => 'meta description sv'
        ]));

        $this->assertEquals('name da', $tag->getName('da'));
        $this->assertEquals('name sv', $tag->getName('sv'));

        $this->assertEquals('contenthub id da', $tag->getContentHubId('da'));
        $this->assertEquals('contenthub id sv', $tag->getContentHubId('sv'));

        $this->assertEquals('meta title da', $tag->getMetaTitle('da'));
        $this->assertEquals('meta title sv', $tag->getMetaTitle('sv'));

        $this->assertEquals('meta description da', $tag->getMetaDescription('da'));
        $this->assertEquals('meta description sv', $tag->getMetaDescription('sv'));
    }
}
