<?php

namespace App\Validators;

use App\DTO\UploadedFile;
use Exception;

final class ExtensionValidator
{
    public function validate(UploadedFile $file): string
    {
        $extension = strtolower(pathinfo($file->getOriginalName(), PATHINFO_EXTENSION));

        if ($extension === '') {
            throw new Exception('File has no extension');
        }

        if (!$this->isAllowedExtension($extension)) {
            throw new Exception(
                'Disallowed file extension: ' . $extension
            );
        }

        return $extension;
    }

    private function isAllowedExtension(string $extension): bool
    {
        return in_array(strtolower($extension), config('allowedExtensions'), true);
    }
}