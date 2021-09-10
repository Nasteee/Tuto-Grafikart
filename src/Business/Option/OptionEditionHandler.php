<?php

namespace App\Business\Option;

use App\Repository\OptionRepository;

class OptionEditionHandler
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
     * Editer une option
     * @param OptionEditionAction $action
     */
    public function handle(OptionEditionAction $action)
    {
        $option = $this->repository->read($action->id);
        $option->setName($action->name);
        $this->repository->edit($option);
    }
}