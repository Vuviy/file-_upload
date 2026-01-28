<?php

namespace App;

use Exception;

final class Container
{
    private array $definitions = [];
    private array $instances = [];

    public function set(string $id, callable $factory): void
    {
        $this->definitions[$id] = $factory;
    }

    public function get(string $id): object
    {
        if (array_key_exists($id, $this->instances)) {
            return $this->instances[$id];
        }

        if (!array_key_exists($id, $this->definitions)) {
            throw new Exception("Service {$id} not found");
        }

        return $this->instances[$id] = ($this->definitions[$id])($this);
    }
}