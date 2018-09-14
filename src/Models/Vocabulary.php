<?php

namespace Bonnier\SiteManager\Models;

class Vocabulary
{
    /** @var int */
    protected $vocabularyId;

    /** @var string */
    protected $name;

    /** @var string */
    protected $machineName;

    /** @var string */
    protected $contentHubId;

    /** @var bool */
    protected $multiSelect;

    /** @var int */
    protected $brand;

    /**
     * Vocabulary constructor.
     * @param $vobabulary
     */
    public function __construct($vobabulary)
    {
        $this->setId($vobabulary->id ?? null)
            ->setName($vobabulary->name ?? null)
            ->setMachineName($vobabulary->machine_name ?? null)
            ->setContentHubId($vobabulary->content_hub_id ?? null)
            ->setMultiSelect(boolval($vobabulary->multi_select ?? false))
            ->setBrand($vobabulary->brand->id ?? null);
    }

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->vocabularyId;
    }

    /**
     * @param int $vocabularyId
     * @return Vocabulary
     */
    public function setId(?int $vocabularyId): Vocabulary
    {
        $this->vocabularyId = $vocabularyId;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Vocabulary
     */
    public function setName(?string $name): Vocabulary
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getMachineName(): ?string
    {
        return $this->machineName;
    }

    /**
     * @param string $machineName
     * @return Vocabulary
     */
    public function setMachineName(?string $machineName): Vocabulary
    {
        $this->machineName = $machineName;
        return $this;
    }

    /**
     * @return string
     */
    public function getContentHubId(): ?string
    {
        return $this->contentHubId;
    }

    /**
     * @param string $contentHubId
     * @return Vocabulary
     */
    public function setContentHubId(?string $contentHubId): Vocabulary
    {
        $this->contentHubId = $contentHubId;
        return $this;
    }

    /**
     * @return bool
     */
    public function isMultiSelect(): bool
    {
        return $this->multiSelect;
    }

    /**
     * @param bool $multiSelect
     * @return Vocabulary
     */
    public function setMultiSelect(bool $multiSelect): Vocabulary
    {
        $this->multiSelect = $multiSelect;
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
     * @return Vocabulary
     */
    public function setBrand(?int $brand): Vocabulary
    {
        $this->brand = $brand;
        return $this;
    }
}
