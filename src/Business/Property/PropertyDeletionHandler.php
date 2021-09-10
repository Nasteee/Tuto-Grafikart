<?php

namespace App\Business\Property;


use App\Repository\PropertyRepository;

class PropertyDeletionHandler
{
    /**
     * @var PropertyRepository
     */
    private $repository;

    public function __construct(PropertyRepository $repository)
    {
        $this->repository = $repository;
    }

    public function handle(PropertyDeletionAction $action)
    {
        $property = $this->repository->read($action->id);
        $this->repository->delete($property);

    }


}