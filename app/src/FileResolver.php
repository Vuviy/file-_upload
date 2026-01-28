<?php

namespace App;

use App\DTO\StoredFile;
use App\Services\MimeTypeDetector;
use Exception;

final class FileResolver
{
    private MimeTypeDetector $detector;
    public function __construct()
    {
        $this->detector = new MimeTypeDetector();
    }
    public function resolve(string $relativePath): StoredFile
    {
        $fullPath = '/var/www/storage/uploads/' . $relativePath;

        if (!is_file($fullPath)) {
            throw new Exception('File not found');
        }

        $mime = $this->detector->detect($fullPath);

        return new StoredFile(
            $fullPath,
            filesize($fullPath),
            $mime
        );
    }
}