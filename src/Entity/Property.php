<?php

namespace App\Entity;

use App\Repository\PropertyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Cocur\Slugify\Slugify;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;



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
     * @Assert\Length(min=5, max=255)
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $description;

    /**
     * @Assert\Range(min=10, max=400)
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
     * @var ArrayCollection
     */
    private $options;

    /**
     * @param ArrayCollection $options
     */


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
        ArrayCollection $options = null
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
        $this->options = new ArrayCollection();
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
     * @return Collection|Option[]
     */
    public function getOptions(): Collection
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

    public function setOptions(ArrayCollection $options): void
    {
        $this->options = $options;
    }
}
