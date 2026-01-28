<?php

namespace App\DTO;

final class UploadResult
{
    public function __construct(
        private string $filename,
        private string $mimeType,
        private int $size
    ) {}

    public function getFilename(): string
    {
        return $this->filename;
    }

    public function getMimeType(): string
    {
        return $this->mimeType;
    }

    public function getSize(): int
    {
        return $this->size;
    }
}