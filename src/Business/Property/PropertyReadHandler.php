<?php

namespace App\Business\Property;

use App\Entity\Property;
use App\Repository\PropertyRepository;

class PropertyReadHandler
{
    /**
     * @var PropertyRepository
     */
    private $repository;

    public function __construct(PropertyRepository $repository)
    {
        $this->repository = $repository;
    }

    public function handle(PropertyReadAction $action): Property
    {
        $property = $this->repository->read($action->id);
        return $property;
    }
}