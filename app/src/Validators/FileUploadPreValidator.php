<?php

namespace App\Validators;

use App\DTO\UploadedFile;
use Exception;

final class FileUploadPreValidator
{
    /**
     * @param UploadedFile $file
     * @return void
     * @throws Exception
     */
    public function assertValidUpload(UploadedFile $file): void
    {
        if ($file->getErrorCode() !== UPLOAD_ERR_OK) {
            throw new Exception(
                'Upload failed with error code: ' . $file->getErrorCode()
            );
        }

        $tmpPath = $file->getTemporaryPath();

        if (!is_uploaded_file($tmpPath)) {
            throw new Exception('File is not a valid uploaded file');
        }

        if (!is_readable($tmpPath)) {
            throw new Exception('Uploaded file is not readable');
        }

        if ($file->getSize() <= 0) {
            throw new Exception('Uploaded file is empty');
        }
    }
}