<?php

namespace App\Business\Property;

use Doctrine\Common\Collections\ArrayCollection;

class PropertyCreationAction
{
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
     * @var ArrayCollection
     */
    public $options;
}