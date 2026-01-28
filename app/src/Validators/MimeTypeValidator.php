<?php

namespace App\Validators;

use App\DTO\UploadedFile;
use App\Services\MimeTypeDetector;
use Exception;

final class MimeTypeValidator
{
    private MimeTypeDetector $detector;
    public function __construct()
    {
        $this->detector = new MimeTypeDetector();
    }

    /**
     * @param UploadedFile $file
     * @return string
     * @throws Exception
     */
    public function validate(UploadedFile $file): string
    {
        $mimeType = $this->detector->detect($file->getTemporaryPath());

        if (!$this->isAllowedMimeType($mimeType)) {
            throw new Exception(
                'Disallowed MIME type: ' . $mimeType
            );
        }

        return $mimeType;
    }

    private function isAllowedMimeType(string $mimeType): bool
    {
        return in_array($mimeType, config('allowedMimeTypes'), true);
    }
}