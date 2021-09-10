<?php

namespace App\Controller\Admin;

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

    public function handle()
    {

    }

}