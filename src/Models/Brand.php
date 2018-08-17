<?php

namespace Bonnier\SiteManager\Models;

use Illuminate\Support\Collection;

class Brand
{
    /** @var int */
    protected $brandId;

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

    /** @var string */
    protected $primaryColor;

    /** @var string */
    protected $secondaryColor;

    /** @var string */
    protected $tertiaryColor;

    /** @var bool */
    protected $logoBgColorWhite;

    /** @var int */
    protected $issuesPerYear;

    /** @var string */
    protected $logoPath;

    /** @var Collection */
    protected $mailSenders;

    /**
     * Brand constructor.
     * @param $brand
     */
    public function __construct($brand)
    {
        $this->setId($brand->id ?? null)
            ->setNames($brand->name ?? null)
            ->setCode($brand->brand_code ?? null)
            ->setContenthubId($brand->content_hub_id ?? null)
            ->setPrimaryColor($brand->primary_color ?? null)
            ->setSecondaryColor($brand->secondary_color ?? null)
            ->setTertiaryColor($brand->tertiary_color ?? null)
            ->setLogoBgColorWhite(boolval($brand->logo_bg_color_white ?? false))
            ->setIssuesPerYear(intval($brand->issues_per_year ?? 0))
            ->setLogoPath($brand->logo_path ?? null)
            ->setMailSenders($brand->mail_from_address ?? null);

        if ($created = $brand->created_at ?? null) {
            $this->setCreated(new \DateTime($created));
        }

        if ($updated = $brand->updated_at ?? null) {
            $this->setUpdated(new \DateTime($updated));
        }
    }

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->brandId;
    }

    /**
     * @param int $brandId
     * @return Brand
     */
    public function setId(?int $brandId): Brand
    {
        $this->brandId = $brandId;
        return $this;
    }

    /**
     * @return Collection
     */
    public function getNames(): ?Collection
    {
        return $this->names;
    }

    /**
     * @param Collection $names
     * @return Brand
     */
    public function setNames($names): Brand
    {
        if ($names instanceof Collection) {
            $this->names = $names;
        } else {
            $this->names = collect($names);
        }

        return $this;
    }

    public function getName(string $locale): ?string
    {
        if ($this->names) {
            return $this->names->get($locale);
        }

        return null;
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
     * @return Brand
     */
    public function setCode(?string $code): Brand
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
     * @return Brand
     */
    public function setCreated(\DateTime $created): Brand
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
     * @return Brand
     */
    public function setUpdated(\DateTime $updated): Brand
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
     * @return Brand
     */
    public function setContenthubId(?string $contenthubId): Brand
    {
        $this->contenthubId = $contenthubId;
        return $this;
    }

    /**
     * @return string
     */
    public function getPrimaryColor(): ?string
    {
        return $this->primaryColor;
    }

    /**
     * @param string $primaryColor
     * @return Brand
     */
    public function setPrimaryColor(?string $primaryColor): Brand
    {
        $this->primaryColor = $primaryColor;
        return $this;
    }

    /**
     * @return string
     */
    public function getSecondaryColor(): ?string
    {
        return $this->secondaryColor;
    }

    /**
     * @param string $secondaryColor
     * @return Brand
     */
    public function setSecondaryColor(?string $secondaryColor): Brand
    {
        $this->secondaryColor = $secondaryColor;
        return $this;
    }

    /**
     * @return string
     */
    public function getTertiaryColor(): ?string
    {
        return $this->tertiaryColor;
    }

    /**
     * @param string $tertiaryColor
     * @return Brand
     */
    public function setTertiaryColor(?string $tertiaryColor): Brand
    {
        $this->tertiaryColor = $tertiaryColor;
        return $this;
    }

    /**
     * @return bool
     */
    public function isLogoBgColorWhite(): bool
    {
        return $this->logoBgColorWhite ?? false;
    }

    /**
     * @param bool $logoBgColorWhite
     * @return Brand
     */
    public function setLogoBgColorWhite(?bool $logoBgColorWhite): Brand
    {
        $this->logoBgColorWhite = $logoBgColorWhite;
        return $this;
    }

    /**
     * @return int
     */
    public function getIssuesPerYear(): ?int
    {
        return $this->issuesPerYear;
    }

    /**
     * @param int $issuesPerYear
     * @return Brand
     */
    public function setIssuesPerYear(?int $issuesPerYear): Brand
    {
        $this->issuesPerYear = $issuesPerYear;
        return $this;
    }

    /**
     * @return string
     */
    public function getLogoPath(): ?string
    {
        return $this->logoPath;
    }

    /**
     * @param string $logoPath
     * @return Brand
     */
    public function setLogoPath(?string $logoPath): Brand
    {
        $this->logoPath = $logoPath;
        return $this;
    }

    /**
     * @return Collection
     */
    public function getMailSenders(): ?Collection
    {
        return $this->mailSenders;
    }

    /**
     * @param Collection $mailSenders
     * @return Brand
     */
    public function setMailSenders($mailSenders): Brand
    {
        if ($mailSenders instanceof Collection) {
            $this->mailSenders = $mailSenders;
        } else {
            $this->mailSenders = collect($mailSenders);
        }

        return $this;
    }

    public function getMailSender(string $locale): ?string
    {
        if ($this->mailSenders) {
            return $this->mailSenders->get($locale);
        }

        return null;
    }
}
