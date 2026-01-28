<?php

namespace App\Services;

use Exception;

final class MimeTypeDetector
{
    public function detect(string $filePath): string
    {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        if ($finfo === false) {
            throw new Exception('Unable to open finfo');
        }

        $mimeType = finfo_file($finfo, $filePath);
        finfo_close($finfo);

        if ($mimeType === false) {
            throw new Exception('Unable to detect MIME type');
        }

        return $mimeType;
    }
}