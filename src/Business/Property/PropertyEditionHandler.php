<?php

namespace App\Business\Property;

use App\Repository\PropertyRepository;

class PropertyEditionHandler
{
    /**
     * @var PropertyRepository
     */
    private $repository;

    public function __construct(PropertyRepository $repository)
    {
        $this->repository = $repository;
    }

    public function handle(PropertyEditionAction $action)
    {
        $property = $this->repository->read($action->id);

        $property
            ->setTitle($action->title)
            ->setDescription($action->description)
            ->setSurface($action->surface)
            ->setRooms($action->rooms)
            ->setBedrooms($action->bedrooms)
            ->setFloor($action->floor)
            ->setPrice($action->price)
            ->setHeat($action->heat)
            ->setCity($action->city)
            ->setAdress($action->adress)
            ->setPostalCode($action->postal_code)
            ->setSold($action->sold)
            ->setOptions($action->options);

        $this->repository->edit($property);
    }
}