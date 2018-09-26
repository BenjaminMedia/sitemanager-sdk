<?php

namespace Bonnier\SiteManager\Tests\Unit\Helpers;

use Faker\Factory;
use Faker\Generator;

class Generators
{
    const DATE_FORMAT = 'Y-m-d H:i:s';

    /** @var Generator */
    private static $faker;

    public static function generateSimpleBrand(array $config = [])
    {
        $brand = new \stdClass();
        $brand->id = $config['brand_id'] ?? self::faker()->randomNumber(2);
        $brand->name = $config['brand_name'] ?? self::faker()->words(2, true) . ' %s';
        $brand->brand_code = $config['brand_code'] ?? self::faker()->word;

        return $brand;
    }

    public static function generateSimpleVocabulary(array $config = [])
    {
        $vocabulary = new \stdClass();
        $vocabulary->id = $config['vocab_id'] ?? self::faker()->randomNumber(2);
        $vocabulary->name = $config['vocab_name'] ?? self::faker()->words(2, true);
        $vocabulary->machine_name = $config['vocab_machine_nanme'] ?? self::faker()->word;
        $vocabulary->content_hub_id = $config['vocab_contenthub_id'] ?? self::faker()->uuid;

        return $vocabulary;
    }

    public static function generateSimpleApp(array $config = [])
    {
        $app = new \stdClass();
        $app->id = $config['app_id'] ?? self::faker()->randomNumber(2);
        $app->name = $config['app_name'] ?? self::faker()->words(2, true);
        $app->app_code = $config['app_code'] ?? self::faker()->word;

        return $app;
    }

    public static function generateApp(array $config = [])
    {
        $app = new \stdClass();
        $app->id = $config['id'] ?? 1;
        $app->name = self::generateLocalization($config['name'] ?? self::faker()->words(2, true) . ' %s');
        $app->app_code = $config['code'] ?? self::faker()->word;
        $app->created_at = self::generateDate($config['created'] ?? sprintf('-%s days', self::faker()->randomDigit));
        $app->updated_at = self::generateDate($config['updated'] ?? sprintf('-%s days', self::faker()->randomDigit));
        $app->content_hub_id = $config['contenthub_id'] ?? self::faker()->uuid;

        return $app;
    }

    public static function generateLocalization(string $format)
    {
        $localization = new \stdClass();
        $localization->da = sprintf($format, 'DA');
        $localization->sv = sprintf($format, 'SV');
        $localization->fi = sprintf($format, 'FI');
        $localization->no = sprintf($format, 'NO');

        return $localization;
    }

    public static function generateDate(string $time = 'now')
    {
        $date = new \DateTime($time);

        return $date->format(self::DATE_FORMAT);
    }

    public static function generateBrand(array $config = [])
    {
        $brand = new \stdClass();
        $brand->id = $config['id'] ?? 1;
        $brand->name = self::generateLocalization($config['name'] ?? self::faker()->words(2, true) . ' %s');
        $brand->brand_code = $config['code'] ?? self::faker()->word;
        $brand->created_at = self::generateDate($config['created'] ?? sprintf('-%s days', self::faker()->randomDigit));
        $brand->updated_at = self::generateDate($config['updated'] ?? sprintf('-%s days', self::faker()->randomDigit));
        $brand->content_hub_id = $config['contenthub_id'] ?? self::faker()->uuid;
        $brand->primary_color = $config['primary'] ?? self::faker()->hexColor;
        $brand->secondary_color = $config['secondary'] ?? self::faker()->hexColor;
        $brand->tertiary_color = $config['tertiary'] ?? self::faker()->hexColor;
        $brand->logo_bg_color_white = $config['logo_bg'] ?? (self::faker()->boolean ? 1 : 0);
        $brand->issues_per_year = $config['issues'] ?? self::faker()->randomNumber();
        $brand->logo_path = $config['logo'] ?? self::faker()->imageUrl();
        $brand->mail_from_address = self::generateLocalization($config['email'] ?? self::faker()->email . '%s');

        return $brand;
    }

    public static function generateCategory(array $config = [])
    {
        $category = new \stdClass();
        $category->id = $config['id'] ?? self::faker()->randomNumber(2);
        $category->name = self::generateLocalization($config['name'] ?? self::faker()->words(2, true) . ' %s');
        $category->description = self::generateLocalization(
            $config['description'] ?? self::faker()->words(4, true) . ' %s'
        );
        $category->created_at = self::generateDate(
            $config['created'] ?? sprintf('-%s days', self::faker()->randomDigit)
        );
        $category->updated_at = self::generateDate(
            $config['updated'] ?? sprintf('-%s days', self::faker()->randomDigit)
        );
        $category->content_hub_ids = self::generateLocalization(
            $config['contenthub_id'] ?? self::faker()->uuid . '_%s'
        );
        $category->whitealbum_id = $config['whitealbum'] ?? self::faker()->uuid;
        $category->brand = self::generateSimpleBrand($config);
        $category->image_url = self::generateLocalization(
            $config['image'] ?? self::faker()->imageUrl() . '%s'
        );
        $category->body = self::generateLocalization($config['body'] ?? self::faker()->text(20) . ' %s');
        $category->meta_title = self::generateLocalization(
            $config['meta_title'] ?? self::faker()->words(4, true)  .' %s'
        );
        $category->meta_description = self::generateLocalization(
            $config['meta_description'] ?? self::faker()->text(20) . ' %s'
        );
        $category->parent = $config['parent'] ?? null;

        return $category;
    }

    public static function generateSite(array $config = [])
    {
        $site = new \stdClass();
        $site->id = $config['id'] ?? self::faker()->randomNumber(2);
        $site->name = $config['name'] ?? self::faker()->words(2, true);
        $site->description = $config['description'] ?? self::faker()->text(10);
        $site->domain = $config['domain'] ?? parse_url(self::faker()->url, PHP_URL_HOST);
        $site->login_domain = $config['login_domain'] ?? parse_url(self::faker()->url, PHP_URL_HOST);
        $site->api_domain = $config['api_domain'] ?? parse_url(self::faker()->url, PHP_URL_HOST);
        $site->shop_domain = $config['shop_domain'] ?? self::faker()->url;
        $site->language = $config['language'] ?? self::faker()->languageCode;
        $site->locale = $config['locale'] ?? self::faker()->locale;
        $site->shell_url = $config['shell'] ?? self::faker()->url;
        $site->created_at = self::generateDate($config['created'] ?? sprintf('-%s days', self::faker()->randomDigit));
        $site->updated_at = self::generateDate($config['updated'] ?? sprintf('-%s days', self::faker()->randomDigit));
        $site->is_secure = boolval($config['secure'] ?? self::faker()->boolean);
        $site->cxense_site_id = $config['cxense'] ?? self::faker()->uuid;
        $site->facebook_id = $config['fb_id'] ?? self::faker()->uuid;
        $site->facebook_secret = $config['fb_secret'] ?? self::faker()->uuid;
        $site->signup_lead_permission = $config['signup'] ?? self::faker()->randomDigit;
        $site->app = self::generateSimpleApp($config);
        $site->brand = self::generateBrand($config);
        $site->configuration = $config['configuration'] ?? self::generateSiteConfiguration();

        return $site;
    }

    public static function generateSiteConfiguration(array $config = [])
    {
        if ($config) {
            return json_decode(json_encode($config));
        }

        $configuration = new \stdClass();
        $configuration->facebook = new \stdClass();
        $configuration->facebook->app_id = self::faker()->uuid;
        $configuration->facebook->app_secret = self::faker()->uuid;
        $configuration->cxense = new \stdClass();
        $configuration->cxense->site_id = self::faker()->uuid;

        return $configuration;
    }

    public static function generateTag(array $config = [])
    {
        $tag = new \stdClass();
        $tag->id = $config['id'] ?? self::faker()->randomNumber(2);
        $tag->name = self::generateLocalization($config['name'] ?? self::faker()->words(2, true) . ' %s');
        $tag->created_at = self::generateDate($config['created'] ?? sprintf('-%s days', self::faker()->randomDigit));
        $tag->updated_at = self::generateDate($config['updated'] ?? sprintf('-%s days', self::faker()->randomDigit));
        $tag->content_hub_ids = self::generateLocalization($config['contenthub_id'] ?? self::faker()->uuid . '_%s');
        $tag->whitealbum_id = $config['whitealbum'] ?? self::faker()->uuid;
        $tag->internal = boolval($config['internal'] ?? self::faker()->boolean);
        $tag->brand = self::generateSimpleBrand($config);
        $tag->vocabulary = self::generateSimpleVocabulary($config);
        $tag->meta_title = self::generateLocalization($config['meta_title'] ?? self::faker()->words(4, true) . '%s');
        $tag->meta_description = self::generateLocalization(
            $config['meta_description'] ?? self::faker()->text(10) . ' %s'
        );

        return $tag;
    }

    public static function generateVocabulary(array $config = [])
    {
        $vocabulary = new \stdClass();
        $vocabulary->id = $config['id'] ?? self::faker()->randomNumber(2);
        $vocabulary->name = $config['name'] ?? self::faker()->words(2, true);
        $vocabulary->machine_name = $config['machine_name'] ?? self::faker()->word;
        $vocabulary->content_hub_id = $config['contenthub_id'] ?? self::faker()->uuid;
        $vocabulary->multi_select = boolval($config['multi_select'] ?? self::faker()->boolean);
        $vocabulary->brand = self::generateSimpleBrand($config);

        return $vocabulary;
    }

    public static function generateMetaPagination(int $currentPage, int $totalPages)
    {
        return [
            'pagination' => [
                'total' => 9,
                'count' => 3,
                'per_page' => 3,
                'current_page' => $currentPage,
                'total_pages' => $totalPages,
                'links' => []
            ],
        ];
    }

    private static function faker()
    {
        if (!self::$faker) {
            self::$faker = Factory::create();
        }

        return self::$faker;
    }
}
