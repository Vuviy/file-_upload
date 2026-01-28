<?php

namespace App\Interface;

use App\DTO\UploadedFile;

interface UploadStrategy
{
    public function supports(string $mimeType): bool;

    public function process(UploadedFile $file, string $mimeType): UploadedFile;
}