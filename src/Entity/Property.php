<?php

namespace App\Entity;

use Cocur\Slugify\Slugify;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;

/**
 * @Vich\Uploadable()
 */
class Property
{
    const HEAT = [
        0 => 'Electrique',
        1 => 'Gaz',
    ];
    /**
     * @var int
     */
    private $id;
    /**
     * @var string | null
     */
    private $filename;
    /**
     * @var File | null
     * @Vich\UploadableField(mapping="property_image", fileNameProperty="filename")
     */
    private $imageFile;
    /**
     * @var string
     */
    private $title;
    /**
     * @var string
     */
    private $description;
    /**
     * @var int
     */
    private $surface;
    /**
     * @var int
     */
    private $rooms;
    /**
     * @var int
     */
    private $bedrooms;
    /**
     * @var int
     */
    private $floor;
    /**
     * @var int
     */
    private $price;
    /**
     * @var int
     */
    private $heat;
    /**
     * @var string
     */
    private $city;
    /**
     * @var string
     */
    private $adress;
    /**
     * @var int
     */
    private $postal_code;
    /**
     * @var bool
     */
    private $sold = false;
    /**
     * @var \DateTime
     */
    private $created_at;
    /**
     * @var array
     */
    private $options;
    /**
     * @var \DateTime
     */
    private $updated_at;

    public function __construct(
        string $title,
        string $description,
        int $surface,
        int $rooms,
        int $bedrooms,
        int $floor,
        int $price,
        int $heat,
        string $city,
        string $adress,
        int $postal_code,
        bool $sold,
        array $options = [],
        File  $imageFile,
        string $filename = null

    )
    {
        $this->title = $title;
        $this->description = $description;
        $this->surface = $surface;
        $this->rooms = $rooms;
        $this->bedrooms = $bedrooms;
        $this->floor = $floor;
        $this->price = $price;
        $this->heat = $heat;
        $this->city = $city;
        $this->adress = $adress;
        $this->postal_code = $postal_code;
        $this->sold = $sold;
        $this->created_at = new \DateTime();
        $this->options = [];
        $this->imageFile = $imageFile;
        $this->filename = $filename;
        $this->updated_at = new \DateTime();
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt(): \DateTime
    {
        return $this->updated_at;
    }

    /**
     * @param \DateTime $updated_at
     * @return Property
     */
    public function setUpdatedAt(\DateTime $updated_at): Property
    {
        $this->updated_at = $updated_at;
        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }
    public function getSlug(): string
    {
        $slugify = new Slugify();
        return $slugify->slugify($this->title);
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getSurface(): ?int
    {
        return $this->surface;
    }

    public function setSurface(int $surface): self
    {
        $this->surface = $surface;
        return $this;
    }

    public function getRooms(): ?int
    {
        return $this->rooms;
    }

    public function setRooms(int $rooms): self
    {
        $this->rooms = $rooms;
        return $this;
    }

    public function getBedrooms(): ?int
    {
        return $this->bedrooms;
    }

    public function setBedrooms(int $bedrooms): self
    {
        $this->bedrooms = $bedrooms;
        return $this;
    }

    public function getFloor(): ?int
    {
        return $this->floor;
    }

    public function setFloor(int $floor): self
    {
        $this->floor = $floor;
        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;
        return $this;
    }

    public function getFormattedPrice(): string
    {
        return number_format($this->price, 0, '', ' ');
    }

    public function getHeat(): ?int
    {
        return $this->heat;
    }

    public function setHeat(int $heat): self
    {
        $this->heat = $heat;
        return $this;
    }

    public function getHeatType(): string
    {
        return self::HEAT[$this->heat];
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;
        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(string $adress): self
    {
        $this->adress = $adress;
        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postal_code;
    }

    public function setPostalCode(string $postal_code): self
    {
        $this->postal_code = $postal_code;
        return $this;
    }

    public function getSold(): ?bool
    {
        return $this->sold;
    }

    public function setSold(bool $sold): self
    {
        $this->sold = $sold;
        return $this;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTime $created_at): self
    {
        $this->created_at = $created_at;
        return $this;
    }

    /**
     * @return array|Option[]
     */
    public function getOptions()
    {
        return $this->options;
    }

    public function addOption(Option $option): self
    {
        if (!$this->options->contains($option)) {
            $this->options[] = $option;
            $option->addProperty($this);
        }
        return $this;
    }

    public function removeOption(Option $option): self
    {
        if ($this->options->removeElement($option)) {
            $option->removeProperty($this);
        }
        return $this;
    }

    public function setOptions(array $options)
    {
        $this->options = $options;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFilename(): ?string
    {
        return $this->filename;
    }

    /**
     * @param string|null $filename
     * @return Property
     */
    public function setFilename(?string $filename): Property
    {
        $this->filename = $filename;
        return $this;
    }

    /**
     * @return File|null
     */
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    /**
     * @param File | null $imageFile
     * @return Property
     */
    public function setImageFile(?File $imageFile): Property
    {
        $this->imageFile = $imageFile;
        if ($this->imageFile instanceof UploadedFile) {
            $this->updated_at = new \DateTime('now');
        }
        return $this;
    }



}
