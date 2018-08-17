<?php

namespace Bonnier\SiteManager\Models;

use Illuminate\Support\Collection;

class Site
{
    /** @var int|null */
    protected $siteId;

    /** @var string|null */
    protected $name;

    /** @var string|null */
    protected $description;

    /** @var string|null */
    protected $domain;

    /** @var string|null */
    protected $loginDomain;

    /** @var string|null */
    protected $apiDomain;

    /** @var string|null */
    protected $language;

    /** @var string|null */
    protected $locale;

    /** @var string|null */
    protected $shellUrl;

    /** @var \DateTime|null */
    protected $created;

    /** @var \DateTime|null */
    protected $updated;

    /** @var bool */
    protected $secure;

    /** @var string|null */
    protected $cxenseSiteId;

    /** @var string|null */
    protected $facebookId;

    /** @var string|null */
    protected $facebookSecret;

    /** @var int|null */
    protected $signupLeadPermission;

    /** @var int|null */
    protected $app;

    /** @var int|null */
    protected $brand;

    /** @var \stdClass|null */
    protected $configuration;

    /**
     * Site constructor.
     * @param $site
     */
    public function __construct($site)
    {
        $this->setId($site->id ?? null)
            ->setName($site->name ?? null)
            ->setDescription($site->description ?? null)
            ->setDomain($site->domain ?? null)
            ->setLoginDomain($site->login_domain ?? null)
            ->setApiDomain($site->api_domain ?? null)
            ->setLanguage($site->language ?? null)
            ->setLocale($site->locale ?? null)
            ->setShellUrl($site->shell_url ?? null)
            ->setSecure(boolval($site->is_secure ?? false))
            ->setCxenseSiteId($site->cxense_site_id ?? null)
            ->setFacebookId($site->facebook_id ?? null)
            ->setFacebookSecret($site->facebook_secret ?? null)
            ->setSignupLeadPermission($site->signup_lead_permission ?? null)
            ->setApp($site->app->id ?? null)
            ->setBrand($site->brand->id ?? null)
            ->setConfigurations($site->configuration ?? null);

        if ($created = $site->created_at ?? null) {
            $this->setCreated(new \DateTime($created));
        }

        if ($updated = $site->updated_at ?? null) {
            $this->setUpdated(new \DateTime($updated));
        }
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->siteId;
    }

    /**
     * @param int|null $siteId
     * @return Site
     */
    public function setId(?int $siteId): Site
    {
        $this->siteId = $siteId;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param null|string $name
     * @return Site
     */
    public function setName(?string $name): Site
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param null|string $description
     * @return Site
     */
    public function setDescription(?string $description): Site
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getDomain(): ?string
    {
        return $this->domain;
    }

    /**
     * @param null|string $domain
     * @return Site
     */
    public function setDomain(?string $domain): Site
    {
        $this->domain = $domain;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getLoginDomain(): ?string
    {
        return $this->loginDomain;
    }

    /**
     * @param null|string $loginDomain
     * @return Site
     */
    public function setLoginDomain(?string $loginDomain): Site
    {
        $this->loginDomain = $loginDomain;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getApiDomain(): ?string
    {
        return $this->apiDomain;
    }

    /**
     * @param null|string $apiDomain
     * @return Site
     */
    public function setApiDomain(?string $apiDomain): Site
    {
        $this->apiDomain = $apiDomain;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getLanguage(): ?string
    {
        return $this->language;
    }

    /**
     * @param null|string $language
     * @return Site
     */
    public function setLanguage(?string $language): Site
    {
        $this->language = $language;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getLocale(): ?string
    {
        return $this->locale;
    }

    /**
     * @param null|string $locale
     * @return Site
     */
    public function setLocale(?string $locale): Site
    {
        $this->locale = $locale;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getShellUrl(): ?string
    {
        return $this->shellUrl;
    }

    /**
     * @param null|string $shellUrl
     * @return Site
     */
    public function setShellUrl(?string $shellUrl): Site
    {
        $this->shellUrl = $shellUrl;
        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getCreated(): ?\DateTime
    {
        return $this->created;
    }

    /**
     * @param \DateTime|null $created
     * @return Site
     */
    public function setCreated(?\DateTime $created): Site
    {
        $this->created = $created;
        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getUpdated(): ?\DateTime
    {
        return $this->updated;
    }

    /**
     * @param \DateTime|null $updated
     * @return Site
     */
    public function setUpdated(?\DateTime $updated): Site
    {
        $this->updated = $updated;
        return $this;
    }

    /**
     * @return bool
     */
    public function isSecure(): bool
    {
        return $this->secure;
    }

    /**
     * @param bool $secure
     * @return Site
     */
    public function setSecure(bool $secure): Site
    {
        $this->secure = $secure;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getCxenseSiteId(): ?string
    {
        return $this->cxenseSiteId;
    }

    /**
     * @param null|string $cxenseSiteId
     * @return Site
     */
    public function setCxenseSiteId(?string $cxenseSiteId): Site
    {
        $this->cxenseSiteId = $cxenseSiteId;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getFacebookId(): ?string
    {
        return $this->facebookId;
    }

    /**
     * @param null|string $facebookId
     * @return Site
     */
    public function setFacebookId(?string $facebookId): Site
    {
        $this->facebookId = $facebookId;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getFacebookSecret(): ?string
    {
        return $this->facebookSecret;
    }

    /**
     * @param null|string $facebookSecret
     * @return Site
     */
    public function setFacebookSecret(?string $facebookSecret): Site
    {
        $this->facebookSecret = $facebookSecret;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getSignupLeadPermission(): ?int
    {
        return $this->signupLeadPermission;
    }

    /**
     * @param int|null $signupLeadPermission
     * @return Site
     */
    public function setSignupLeadPermission(?int $signupLeadPermission): Site
    {
        $this->signupLeadPermission = $signupLeadPermission;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getApp(): ?int
    {
        return $this->app;
    }

    /**
     * @param int|null $app
     * @return Site
     */
    public function setApp(?int $app): Site
    {
        $this->app = $app;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getBrand(): ?int
    {
        return $this->brand;
    }

    /**
     * @param int|null $brand
     * @return Site
     */
    public function setBrand(?int $brand): Site
    {
        $this->brand = $brand;
        return $this;
    }

    /**
     * @return \stdClass|null
     */
    public function getConfigurations(): ?\stdClass
    {
        return $this->configuration;
    }

    /**
     * @param \stdClass|null $configuration
     * @return Site
     */
    public function setConfigurations(?\stdClass $configuration): Site
    {
        $this->configuration = $configuration;
        return $this;
    }
}
