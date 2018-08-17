<?php

namespace Bonnier\SiteManager\Tests\Unit\Models;

use Bonnier\SiteManager\Models\Site;
use Illuminate\Support\Collection;
use PHPUnit\Framework\TestCase;

class SiteTest extends TestCase
{
    public function testCanHandleNullData()
    {
        $site = new Site(null);

        $this->assertNull($site->getId());
        $this->assertNull($site->getName());
        $this->assertNull($site->getDescription());
        $this->assertNull($site->getDomain());
        $this->assertNull($site->getLoginDomain());
        $this->assertNull($site->getApiDomain());
        $this->assertNull($site->getLanguage());
        $this->assertNull($site->getLocale());
        $this->assertNull($site->getShellUrl());
        $this->assertNull($site->getCreated());
        $this->assertNull($site->getUpdated());
        $this->assertFalse($site->isSecure());
        $this->assertNull($site->getCxenseSiteId());
        $this->assertNull($site->getFacebookId());
        $this->assertNull($site->getFacebookSecret());
        $this->assertNull($site->getSignupLeadPermission());
        $this->assertNull($site->getApp());
        $this->assertNull($site->getBrand());
        $this->assertNull($site->getConfigurations());
    }

    public function testCanFormatDataProperly()
    {
        $data = $this->generateData();

        $site = new Site($data);

        $this->assertEquals($data->id, $site->getId());
        $this->assertEquals($data->name, $site->getName());
        $this->assertEquals($data->description, $site->getDescription());
    }

    private function generateData()
    {
        $data = new \stdClass();
        $data->id = 1;
        $data->name = 'Test Site';
        $data->description = 'Test Site Description';
        $data->domain = 'willow.test';
        $data->login_domain = 'login.willow.test';
        $data->api_domain = 'api.willow.test';
        $data->language = 'da';
        $data->locale = 'da_dk';
        $data->shell_url = 'http://shell.willow.test';
        $data->created_at = '2018-08-01 08:00:00';
        $data->updated_at = '2018-08-17 12:48:00';
        $data->is_secure = true;
        $data->cxense_site_id = 'CXENSE_SITE_ID';
        $data->facebook_id = 'FACEBOOK_ID';
        $data->facebook_secret = 'FACEBOOK_SECRET';
        $data->signup_lead_permission = "1";

        $data->app = new \stdClass();
        $data->app->id = 1;
        $data->app->name = 'Test App';
        $data->app->app_code = 'TEST_APP';

        $data->brand = new \stdClass();
        $data->brand->id = 1;
        $data->brand->name = 'Test Brand';
        $data->brand->brand_code = 'TEST_BRAND';

        $data->configuration = $this->generateConfiguration();

        return $data;
    }

    private function generateConfiguration()
    {
        $configuration = new \stdClass();
        $configuration->facebook = new \stdClass();
        $configuration->facebook->app_id = '1234';
        $configuration->facebook->app_secret = 'abcd';
        $configuration->cxense = new \stdClass();
        $configuration->cxense->site_id = '1234';

        return $configuration;
    }
}
