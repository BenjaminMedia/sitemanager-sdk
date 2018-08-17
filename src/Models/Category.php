<?php

namespace Bonnier\SiteManager\Models;

use Illuminate\Support\Collection;

class Category
{
    /** @var int */
    protected $categoryId;

    /** @var Collection */
    protected $names;

    /** @var Collection */
    protected $descriptions;

    /** @var \DateTime */
    protected $created;

    /** @var \DateTime */
    protected $updated;

    /** @var Collection */
    protected $contenthubIds;

    /** @var int */
    protected $brand;

    /** @var Collection */
    protected $images;

    /** @var Collection */
    protected $bodies;

    /** @var Collection */
    protected $metaTitles;

    /** @var Collection */
    protected $metaDescriptions;

    /** @var Category */
    protected $parent;

    /**
     * Category constructor.
     * @param $category
     */
    public function __construct($category)
    {
        $this->setId($category->id ?? null)
            ->setNames($category->name ?? null)
            ->setDescriptions($category->description ?? null)
            ->setContenthubIds($category->content_hub_ids ?? null)
            ->setBrand($category->brand->id ?? null)
            ->setImages($category->image_url ?? null)
            ->setBodies($category->body ?? null)
            ->setMetaTitles($category->meta_title ?? null)
            ->setMetaDescriptions($category->meta_description ?? null)
            ->setParent($category->parent ?? null);

        if ($created = $category->created_at ?? null) {
            $this->setCreated(new \DateTime($created));
        }
        if ($updated = $category->updated_at ?? null) {
            $this->setUpdated(new \DateTime($updated));
        }
    }

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->categoryId;
    }

    /**
     * @param int $categoryId
     * @return Category
     */
    public function setId(?int $categoryId): Category
    {
        $this->categoryId = $categoryId;
        return $this;
    }

    /**
     * @return Collection
     */
    public function getNames(): Collection
    {
        return $this->names;
    }

    public function getName(string $locale): ?string
    {
        return $this->names->get($locale);
    }

    /**
     * @param $names
     * @return Category
     */
    public function setNames($names): Category
    {
        if ($names instanceof Collection) {
            $this->names = $names;
        } else {
            $this->names = collect($names);
        }
        return $this;
    }

    /**
     * @return Collection
     */
    public function getDescriptions(): Collection
    {
        return $this->descriptions;
    }

    public function getDescription(string $locale): ?string
    {
        return $this->descriptions->get($locale);
    }

    /**
     * @param $descriptions
     * @return Category
     */
    public function setDescriptions($descriptions): Category
    {
        if ($descriptions instanceof Collection) {
            $this->descriptions = $descriptions;
        } else {
            $this->descriptions = collect($descriptions);
        }
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
     * @return Category
     */
    public function setCreated(\DateTime $created): Category
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
     * @return Category
     */
    public function setUpdated(\DateTime $updated): Category
    {
        $this->updated = $updated;
        return $this;
    }

    /**
     * @return Collection
     */
    public function getContenthubIds(): Collection
    {
        return $this->contenthubIds;
    }

    public function getContenthubId(string $locale): ?string
    {
        return $this->contenthubIds->get($locale);
    }

    /**
     * @param $contenthubIds
     * @return Category
     */
    public function setContenthubIds($contenthubIds): Category
    {
        if ($contenthubIds instanceof Collection) {
            $this->contenthubIds = $contenthubIds;
        } else {
            $this->contenthubIds = collect($contenthubIds);
        }

        return $this;
    }

    /**
     * @return int
     */
    public function getBrand(): ?int
    {
        return $this->brand;
    }

    /**
     * @param int $brand
     * @return Category
     */
    public function setBrand(?int $brand): Category
    {
        $this->brand = $brand;
        return $this;
    }

    /**
     * @return Collection
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function getImage(string $locale): ?string
    {
        return $this->images->get($locale);
    }

    /**
     * @param $images
     * @return Category
     */
    public function setImages($images): Category
    {
        if ($images instanceof Collection) {
            $this->images = $images;
        } else {
            $this->images = collect($images);
        }
        return $this;
    }

    /**
     * @return Collection
     */
    public function getBodies(): Collection
    {
        return $this->bodies;
    }

    public function getBody(string $locale): ?string
    {
        return $this->bodies->get($locale);
    }

    /**
     * @param $bodies
     * @return Category
     */
    public function setBodies($bodies): Category
    {
        if ($bodies instanceof Collection) {
            $this->bodies = $bodies;
        } else {
            $this->bodies = collect($bodies);
        }

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
     * @param $metaTitles
     * @return Category
     */
    public function setMetaTitles($metaTitles): Category
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
     * @param $metaDescriptions
     * @return Category
     */
    public function setMetaDescriptions($metaDescriptions): Category
    {
        if ($metaDescriptions instanceof Collection) {
            $this->metaDescriptions = $metaDescriptions;
        } else {
            $this->metaDescriptions = collect($metaDescriptions);
        }

        return $this;
    }

    /**
     * @return Category
     */
    public function getParent(): ?Category
    {
        return $this->parent;
    }

    /**
     * @param $parent
     * @return Category
     */
    public function setParent($parent): Category
    {
        if (!is_null($parent)) {
            $this->parent = new Category($parent);
        }
        return $this;
    }
}
