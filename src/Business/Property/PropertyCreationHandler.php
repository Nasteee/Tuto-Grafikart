<?php

namespace App\Business\Property;

use App\Business\Exceptions\BusinessException;
use App\Entity\Property;
use App\Repository\PropertyRepository;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class PropertyCreationHandler
{
    /**
     * @var PropertyRepository
     */
    private $repository;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    public function __construct(PropertyRepository $repository, ValidatorInterface $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
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
            $action->options,
            $action->imageFile,
            $action->filename
        );

        $errors = $this->validator->validate($property);
        if (count($errors) > 0) {
            throw new BusinessException($errors);
        }

        $this->repository->create($property);
    }
}