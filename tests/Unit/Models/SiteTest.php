<?php

namespace Bonnier\SiteManager\Tests\Unit\Models;

use Bonnier\SiteManager\Models\Site;
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
        $this->assertEquals($data->domain, $site->getDomain());
        $this->assertEquals($data->login_domain, $site->getLoginDomain());
        $this->assertEquals($data->api_domain, $site->getApiDomain());
        $this->assertEquals($data->language, $site->getLanguage());
        $this->assertEquals($data->locale, $site->getLocale());
        $this->assertEquals($data->shell_url, $site->getShellUrl());
        $this->assertEquals($data->created_at, $site->getCreated()->format('Y-m-d H:i:s'));
        $this->assertEquals($data->updated_at, $site->getUpdated()->format('Y-m-d H:i:s'));
        $this->assertTrue($site->isSecure());
        $this->assertEquals($data->cxense_site_id, $site->getCxenseSiteId());
        $this->assertEquals($data->facebook_id, $site->getFacebookId());
        $this->assertEquals($data->facebook_secret, $site->getFacebookSecret());
        $this->assertEquals($data->signup_lead_permission, $site->getSignupLeadPermission());
        $this->assertEquals($data->app->id, $site->getApp());
        $this->assertEquals($data->brand->id, $site->getBrand());
        $this->assertEquals($data->configuration, $site->getConfigurations());
        $this->assertEquals($data->configuration->facebook, $site->getConfiguration('facebook'));
        $this->assertEquals($data->configuration->facebook->app_id, $site->getConfiguration('facebook.app_id'));
        $this->assertEquals($data->configuration->facebook->app_secret, $site->getConfiguration('facebook.app_secret'));
        $this->assertEquals($data->configuration->cxense, $site->getConfiguration('cxense'));
        $this->assertEquals($data->configuration->cxense->site_id, $site->getConfiguration('cxense.site_id'));
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
