<?php

namespace App\Business\Option;

use App\Entity\Option;

interface CacheOptionInterface
{
    /**
     * Retourne une option.
     */
    public function get(string $id): Option;

    /**
     * Enregistre une option.
     */
    public function set(Option $option);

    /**
     * Retourne vrai si il existe une option.
     */
    public function has(string $id): bool;
}