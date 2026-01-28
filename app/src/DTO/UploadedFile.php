<?php

namespace App\DTO;

final class UploadedFile
{
    public function __construct(
        private string $originalName,
        private string $temporaryPath,
        private int $size,
        private int $errorCode
    ) {}

    public static function fromArray(array $file): self
    {
        return new self(
            $file['name'],
            $file['tmp_name'],
            $file['size'],
            $file['error']
        );
    }

    public function getOriginalName(): string
    {
        return $this->originalName;
    }

    public function getTemporaryPath(): string
    {
        return $this->temporaryPath;
    }

    public function getSize(): int
    {
        return $this->size;
    }

    public function getErrorCode(): int
    {
        return $this->errorCode;
    }
}