<?php

namespace App\DTO;

final class StoredFile
{
    public function __construct(
        private string $path,
        private int $size,
        private string $mime
    ) {}

    public function path(): string
    {
        return $this->path;
    }

    public function size(): int
    {
        return $this->size;
    }

    public function mime(): string
    {
        return $this->mime;
    }
}