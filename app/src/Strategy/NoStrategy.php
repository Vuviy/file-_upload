<?php

namespace App\Strategy;

use App\DTO\UploadedFile;
use App\Interface\UploadStrategy;

class NoStrategy implements UploadStrategy
{
    public function supports(string $mimeType): bool
    {
        return true;
    }

    public function process(UploadedFile $file, string $mimeType): UploadedFile
    {
        return $file;
    }
}