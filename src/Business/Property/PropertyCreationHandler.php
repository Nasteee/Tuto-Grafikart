<?php

namespace App\Business\Property;

use App\Entity\Property;
use App\Repository\PropertyRepository;

class PropertyCreationHandler
{
    /**
     * @var PropertyRepository
     */
    private $repository;

    public function __construct(PropertyRepository $repository)
    {
        $this->repository = $repository;
    }

    public function handle(PropertyCreationAction $action)
    {
        $property = new Property(
            $action->title,
            $action->description,
            $action->surface,
            $action->rooms,
            $action->bedrooms,
            $action->floor,
            $action->price,
            $action->heat,
            $action->city,
            $action->adress,
            $action->postal_code,
            $action->sold,
            $action->options
        );

        $this->repository->create($property);



    }
}