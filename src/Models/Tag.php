<?php

namespace Bonnier\SiteManager\Models;

use Illuminate\Support\Collection;

class Tag
{
    /** @var int|null */
    protected $tagId;

    /** @var Collection */
    protected $names;

    /** @var \DateTime|null */
    protected $created;

    /** @var \DateTime|null */
    protected $updated;

    /** @var Collection */
    protected $contentHubIds;

    /** @var bool */
    protected $internal;

    /** @var int|null */
    protected $brand;

    /** @var int|null */
    protected $vocabulary;

    /** @var Collection */
    protected $metaTitles;

    /** @var Collection */
    protected $metaDescriptions;
    /**
     * Tag constructor.
     * @param $tag
     */
    public function __construct($tag)
    {
        $this->setId($tag->id ?? null)
            ->setNames($tag->name ?? null)
            ->setContentHubIds($tag->content_hub_ids ?? null)
            ->setInternal(boolval($tag->internal ?? false))
            ->setBrand($tag->brand->id ?? null)
            ->setVocabulary($tag->vocabulary->id ?? null)
            ->setMetaTitles($tag->meta_title ?? null)
            ->setMetaDescriptions($tag->meta_description ?? null);

        if ($created = $tag->created_at ?? null) {
            $this->setCreated(new \DateTime($created));
        }

        if ($updated = $tag->updated_at ?? null) {
            $this->setUpdated(new \DateTime($updated));
        }
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->tagId;
    }

    /**
     * @param int|null $tagId
     * @return Tag
     */
    public function setId(?int $tagId): Tag
    {
        $this->tagId = $tagId;
        return $this;
    }

    /**
     * @return Collection
     */
    public function getNames(): Collection
    {
        return $this->names;
    }

    /**
     * @param Collection $names
     * @return Tag
     */
    public function setNames($names): Tag
    {
        if ($names instanceof Collection) {
            $this->names = $names;
        } else {
            $this->names = collect($names);
        }
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
     * @return Tag
     */
    public function setCreated(?\DateTime $created): Tag
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
     * @return Tag
     */
    public function setUpdated(?\DateTime $updated): Tag
    {
        $this->updated = $updated;
        return $this;
    }

    /**
     * @return Collection
     */
    public function getContentHubIds(): Collection
    {
        return $this->contentHubIds;
    }

    public function getContentHubId(string $locale): ?string
    {
        return $this->contentHubIds->get($locale);
    }

    /**
     * @param Collection $contentHubIds
     * @return Tag
     */
    public function setContentHubIds($contentHubIds): Tag
    {
        if ($contentHubIds instanceof Collection) {
            $this->contentHubIds = $contentHubIds;
        } else {
            $this->contentHubIds = collect($contentHubIds);
        }

        return $this;
    }

    /**
     * @return bool
     */
    public function isInternal(): bool
    {
        return $this->internal;
    }

    /**
     * @param bool $internal
     * @return Tag
     */
    public function setInternal(bool $internal): Tag
    {
        $this->internal = $internal;
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
     * @return Tag
     */
    public function setBrand(?int $brand): Tag
    {
        $this->brand = $brand;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getVocabulary(): ?int
    {
        return $this->vocabulary;
    }

    /**
     * @param int|null $vocabulary
     * @return Tag
     */
    public function setVocabulary(?int $vocabulary): Tag
    {
        $this->vocabulary = $vocabulary;
        return $this;
    }

    /**
     * @return Collection
     */
    public function getMetaTitles(): Collection
    {
        return $this->metaTitles;
    }

    public function getMetaTitle(string $locale): ?string
    {
        return $this->metaTitles->get($locale);
    }

    /**
     * @param Collection $metaTitles
     * @return Tag
     */
    public function setMetaTitles($metaTitles): Tag
    {
        if ($metaTitles instanceof Collection) {
            $this->metaTitles = $metaTitles;
        } else {
            $this->metaTitles = collect($metaTitles);
        }

        return $this;
    }

    /**
     * @return Collection
     */
    public function getMetaDescriptions(): Collection
    {
        return $this->metaDescriptions;
    }

    public function getMetaDescription(string $locale): ?string
    {
        return $this->metaDescriptions->get($locale);
    }

    /**
     * @param Collection $metaDescriptions
     * @return Tag
     */
    public function setMetaDescriptions($metaDescriptions): Tag
    {
        if ($metaDescriptions instanceof Collection) {
            $this->metaDescriptions = $metaDescriptions;
        } else {
            $this->metaDescriptions = collect($metaDescriptions);
        }

        return $this;
    }
}
