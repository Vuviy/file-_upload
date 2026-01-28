<?php

namespace App\Validators;

use App\DTO\UploadedFile;
use Exception;

final class FileSizeValidator
{
    /**
     * @param UploadedFile $file
     * @return void
     * @throws Exception
     */
    public function validate(UploadedFile $file): void
    {
        if ($file->getSize() > config('maxSize')) {
            throw new Exception(
                'File size exceeds maximum allowed size'
            );
        }
    }
}