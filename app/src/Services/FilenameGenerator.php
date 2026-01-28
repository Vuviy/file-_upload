<?php

namespace App\Services;

use App\DTO\StoragePath;
use App\DTO\UploadedFile;
use Exception;

final class FilenameGenerator
{
    public function generate(UploadedFile $file, string $mime): StoragePath
    {
        $hash = hash('sha256', random_bytes(32) . microtime(true));

        $extension = $this->extensionFromMime($mime);

        return new StoragePath('/var/www/storage/uploads',$hash . '.' . $extension);
    }

    private function extensionFromMime(string $mime): string
    {
        return match ($mime) {
            'image/jpeg' => 'jpg',
            'image/png' => 'png',
            'application/pdf' => 'pdf',
            'application/msword' => 'doc',
            default => throw new Exception('Unsupported MIME'),
        };
    }
}