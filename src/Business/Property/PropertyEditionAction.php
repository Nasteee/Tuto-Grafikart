<?php

namespace App\Business\Property;

use App\Entity\Property;
use Symfony\Component\HttpFoundation\File\File;

class PropertyEditionAction
{
    /**
     * @var int
     */
    public $id;
    /**
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    public $description;

    /**
     * @var int
     */
    public $surface;

    /**
     * @var int
     */
    public $rooms;

    /**
     * @var int
     */
    public $bedrooms;

    /**
     * @var int
     */
    public $floor;

    /**
     * @var int
     */
    public $price;

    /**
     * @var int
     */
    public $heat;

    /**
     * @var string
     */
    public $city;

    /**
     * @var string
     */
    public $adress;

    /**
     * @var int
     */
    public $postal_code;

    /**
     * @var bool
     */
    public $sold = false;

    /**
     * @var \DateTime
     */
    public $created_at;

    /**
     * @var array
     */
    public $options;

    /**
     * @var File
     */
    public $imageFile;

    /**
     * @var string
     */
    public $filename;
    /**
     * @var \DateTime
     */
    public $updated_at;

    public static function hydrate(Property $property): PropertyEditionAction
    {
        $action = new self();

        $action->id = $property->getId();
        $action->title = $property->getTitle();
        $action->sold = $property->getSold();
        $action->postal_code = $property->getPostalCode();
        $action->adress = $property->getAdress();
        $action->city = $property->getCity();
        $action->heat = $property->getHeat();
        $action->price = $property->getPrice();
        $action->floor = $property->getFloor();
        $action->rooms = $property->getRooms();
        $action->bedrooms = $property->getBedrooms();
        $action->surface = $property->getSurface();
        $action->description = $property->getDescription();
        $action->options = $property->getOptions()->toArray();
        $action->imageFile = $property->getImageFile();
        $action->filename = $property->getFilename();
        $action->updated_at = $property->getUpdatedAt();

        return $action;
    }
}