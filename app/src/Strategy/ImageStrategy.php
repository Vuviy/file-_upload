<?php

namespace App\Strategy;

use App\DTO\UploadedFile;
use App\Interface\UploadStrategy;
use App\Services\ImageProcessor;

class ImageStrategy implements UploadStrategy
{
    public function __construct(private readonly ImageProcessor $imageProcessor) {}
    public function supports(string $mimeType): bool
    {
        return str_starts_with($mimeType, 'image/');
    }

    public function process(UploadedFile $file, string $mimeType): UploadedFile
    {
        $tmpPath = $this->imageProcessor->resize($file->getTemporaryPath(), $mimeType);
        return new UploadedFile($file->getOriginalName(), $tmpPath, $file->getSize(), $file->getErrorCode());
    }
}