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

    /**
     * @var CacheOptionInterface
     */
    private $cache;

    public function __construct(
        OptionRepository $repository,
        CacheOptionInterface $cache
    )
    {
        $this->repository = $repository;
        $this->cache = $cache;
    }

    public function handle(OptionReadAction $action): Option
    {
        if ($this->cache->has($action->id)) {
            $option = $this->cache->get($action->id);
        } else {
            $option = $this->repository->read($action->id);
            $this->cache->set($option);
        }

        return $option;
    }
}