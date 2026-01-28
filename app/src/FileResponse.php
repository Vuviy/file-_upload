<?php

namespace App;

use App\DTO\StoredFile;

final class FileResponse extends Response
{
    public function __construct(StoredFile $file, string $mimeType)
    {
        parent::__construct(
            file_get_contents($file->path()),
            200,
             [
                'Content-Type'   => $mimeType,
                'Content-Length' => (string)$file->size(),
                'Cache-Control'  => 'public, max-age=31536000, immutable',
            ]
        );
    }
}