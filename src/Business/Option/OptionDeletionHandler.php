<?php

namespace App\Business\Option;

use App\Repository\OptionRepository;

class OptionDeletionHandler
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
     * @param OptionDeletionAction $action
     * Supprimer une option
     */
    public function handle(OptionDeletionAction $action)
    {
        $option = $this->repository->read($action->id);
        $this->repository->delete($option);
    }

}