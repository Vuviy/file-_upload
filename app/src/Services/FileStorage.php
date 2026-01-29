<?php

namespace App\Services;

use App\DTO\StoragePath;
use App\DTO\StoredFile;
use App\DTO\UploadedFile;
use Exception;

final class FileStorage
{
    /**
     * @param UploadedFile $file
     * @param StoragePath $path
     * @return StoredFile
     * @throws Exception
     */
    public function store(UploadedFile $file, StoragePath $path, string $mimeType): StoredFile
    {
        $this->ensureDirectory($path->directory());

        if (!\rename($file->getTemporaryPath(), $path->fullPath())) {
            throw new Exception('File move failed');
        }

        \chmod($path->fullPath(), 0640);

        return new StoredFile($path->fullPath(), \filesize($path->fullPath()), $mimeType);
    }

    private function ensureDirectory(string $dir): void
    {
        if (!\is_dir($dir)) {
            if (!\mkdir($dir, 0750, true)) {
                throw new Exception('Directory creation failed');
            }
        }
    }
}