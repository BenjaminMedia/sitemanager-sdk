<?php

namespace Bonnier\SiteManager\Tests\Unit\Models;

use Bonnier\SiteManager\Models\Category;
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

        $this->assertCount(0, $category->getNames());
        $this->assertCount(0, $category->getDescriptions());
        $this->assertCount(0, $category->getContenthubIds());
        $this->assertCount(0, $category->getImages());
        $this->assertCount(0, $category->getBodies());
        $this->assertCount(0, $category->getMetaTitles());
        $this->assertCount(0, $category->getMetaDescriptions());

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
        $parent = $this->generateData(1, 'Test Parent Category');

        $data = $this->generateData(2, 'Test Category', $parent);

        $category = new Category($data);

        $this->assertCategory($category, $data);
    }

    private function generateData($categoryId, $textSalt, $parent = null)
    {
        $data = new \stdClass();

        $data->id = $categoryId;
        $data->created_at = '2018-08-01 08:00:00';
        $data->updated_at = '2018-08-17 08:55:00';

        $data->name = new \stdClass();
        $data->name->da = $textSalt . ' Name DA';
        $data->name->sv = $textSalt . ' Name SV';
        $data->name->fi = $textSalt . ' Name FI';
        $data->name->no = $textSalt . ' Name NO';

        $data->description = new \stdClass();
        $data->description->da = $textSalt . ' Description DA';
        $data->description->sv = $textSalt . ' Description SV';
        $data->description->fi = $textSalt . ' Description FI';
        $data->description->no = $textSalt . ' Description NO';

        $data->content_hub_ids = new \stdClass();
        $data->content_hub_ids->da = $textSalt . '_CONTENTHUB_ID_DA';
        $data->content_hub_ids->sv = $textSalt . '_CONTENTHUB_ID_SV';
        $data->content_hub_ids->fi = $textSalt . '_CONTENTHUB_ID_FI';
        $data->content_hub_ids->no = $textSalt . '_CONTENTHUB_ID_NO';

        $data->brand = new \stdClass();
        $data->brand->id = 1;
        $data->brand->name = 'Test Brand';
        $data->brand->brand_code = 'TEST_BRAND';

        $data->image_url = new \stdClass();
        $data->image_url->da = 'https://bonnier.cloud/path/to/image_da.png';
        $data->image_url->sv = 'https://bonnier.cloud/path/to/image_sv.png';
        $data->image_url->fi = 'https://bonnier.cloud/path/to/image_fi.png';
        $data->image_url->no = 'https://bonnier.cloud/path/to/image_no.png';

        $data->body = new \stdClass();
        $data->body->da = $textSalt . ' Body DA';
        $data->body->sv = $textSalt . ' Body SV';
        $data->body->fi = $textSalt . ' Body FI';
        $data->body->no = $textSalt . ' Body NO';

        $data->meta_title = new \stdClass();
        $data->meta_title->da = $textSalt . ' Meta Title DA';
        $data->meta_title->sv = $textSalt . ' Meta Title SV';
        $data->meta_title->fi = $textSalt . ' Meta Title FI';
        $data->meta_title->no = $textSalt . ' Meta Title NO';

        $data->meta_description = new \stdClass();
        $data->meta_description->da = $textSalt . ' Meta Description DA';
        $data->meta_description->sv = $textSalt . ' Meta Description SV';
        $data->meta_description->fi = $textSalt . ' Meta Description FI';
        $data->meta_description->no = $textSalt . ' Meta Description NO';

        if ($parent) {
            $data->parent = $parent;
        }

        return $data;
    }

    private function assertCategory(Category $category, \stdClass $data)
    {
        $this->assertEquals($data->id, $category->getId());
        $this->assertEquals($data->created_at, $category->getCreated()->format('Y-m-d H:i:s'));
        $this->assertEquals($data->updated_at, $category->getUpdated()->format('Y-m-d H:i:s'));
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
