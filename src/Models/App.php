<?php

namespace Bonnier\SiteManager\Models;

use Illuminate\Support\Collection;

class App
{
    /** @var int */
    protected $appId;

    /** @var Collection */
    protected $names;

    /** @var string */
    protected $code;

    /** @var \DateTime */
    protected $created;

    /** @var \DateTime */
    protected $updated;

    /** @var string */
    protected $contenthubId;

    /**
     * App constructor.
     * @param $app
     */
    public function __construct($app)
    {
        $this->setId($app->id ?? null)
            ->setNames($app->name ?? null)
            ->setCode($app->app_code ?? null)
            ->setContenthubId($app->content_hub_id ?? null);

        if ($created = $app->created_at ?? null) {
            $this->setCreated(new \DateTime($created));
        }

        if ($updated = $app->updated_at ?? null) {
            $this->setUpdated(new \DateTime($updated));
        }
    }

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->appId;
    }

    /**
     * @param int $appId
     * @return App
     */
    public function setId(?int $appId): App
    {
        $this->appId = $appId;
        return $this;
    }

    public function getNames(): ?Collection
    {
        return $this->names;
    }

    public function getName(string $locale): ?string
    {
        if ($this->names) {
            return $this->names->get($locale);
        }

        return null;
    }

    public function setNames($names): App
    {
        if ($names instanceof Collection) {
            $this->names = $names;
        } else {
            $this->names = collect($names);
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * @param string $code
     * @return App
     */
    public function setCode(?string $code): App
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreated(): ?\DateTime
    {
        return $this->created;
    }

    /**
     * @param \DateTime $created
     * @return App
     */
    public function setCreated(\DateTime $created): App
    {
        $this->created = $created;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUpdated(): ?\DateTime
    {
        return $this->updated;
    }

    /**
     * @param \DateTime $updated
     * @return App
     */
    public function setUpdated(\DateTime $updated): App
    {
        $this->updated = $updated;
        return $this;
    }

    /**
     * @return string
     */
    public function getContenthubId(): ?string
    {
        return $this->contenthubId;
    }

    /**
     * @param string $contenthubId
     * @return App
     */
    public function setContenthubId(?string $contenthubId): App
    {
        $this->contenthubId = $contenthubId;
        return $this;
    }
}
