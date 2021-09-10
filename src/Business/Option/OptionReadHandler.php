<?php

namespace App\Business\Option;

use App\Entity\Option;
use App\Repository\OptionRepository;

class OptionReadHandler
{
    /**
     * @var OptionRepository
     */
    private $repository;

    public function __construct(OptionRepository $repository)
    {
        $this->repository = $repository;
    }

    public function handle(OptionReadAction $action): Option
    {
        $option = $this->repository->read($action->id);
        return $option;
    }

}