<?php

namespace App\Infrastructure\CacheOption;

use App\Business\Option\CacheOptionInterface;
use App\Entity\Option;

/**
 * Gère du cache en mémoire
 */
class CacheMemory implements CacheOptionInterface
{
    private $cache;

    public function get(string $id): Option
    {
        return $this->cache[$id];
    }

    public function set(Option $option)
    {
        $this->cache[$option->getId()] = $option;
    }

    public function has(string $id): bool
    {
        return isset($this->cache[$id]);
    }
}