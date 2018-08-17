<?php

namespace Bonnier\SiteManager\Tests\Unit\Models;

use Bonnier\SiteManager\Models\Tag;
use PHPUnit\Framework\TestCase;

class TagTest extends TestCase
{
    /**
    $tagId;
    $names;
    $created;
    $updated;
    $contentHubIds;
    $internal;
    $brand;
    $vocabulary;
    $metaTitles;
    $metaDescriptions;
     */
    public function testCanHandleNullData()
    {
        $tag = new Tag(null);

        $this->assertNull($tag->getId());
    }

    public function testCanFormatDataProperly()
    {
        $data = $this->generateData();

        $tag = new Tag($data);

        $this->assertEquals($data->id, $tag->getId());
    }

    private function generateData()
    {
        $data = new \stdClass();
        $data->id = 1;
        $data->name = $this->generateLocalization('Tag Name');
        $data->created_at = '2018-08-01 08:00:00';
        $data->updated_at = '2018-08-17 15:02:00';

        return $data;
    }

    private function generateLocalization(string $prefix)
    {
        $localization = new \stdClass();
        $localization->da = $prefix . ' DA';
        $localization->sv = $prefix . ' SV';
        $localization->fi = $prefix . ' FI';
        $localization->no = $prefix . ' NO';

        return $localization;
    }
}
