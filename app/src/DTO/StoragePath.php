<?php

namespace App\DTO;

final class StoragePath
{
    public function __construct(
        private string $dir,
        private string $filename
    ) {}

    public function directory(): string
    {
        return $this->dir;
    }

    public function filename(): string
    {
        return $this->filename;
    }

    public function fullPath(): string
    {
        return $this->directory() . '/' . $this->filename;
    }
}