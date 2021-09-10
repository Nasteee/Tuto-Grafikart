<?php

namespace App\Business\Option;

use App\Entity\Option;
use App\Repository\OptionRepository;

class OptionCreationHandler
{
    /**
     * @var OptionRepository
     */
    private $repository;

    public function __construct(OptionRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Créer une option.
     *
     * @param OptionCreationAction $action
     */
    public function handle(OptionCreationAction $action)
    {
        $option = new Option($action->name);

        $this->repository->create($option);
    }
}