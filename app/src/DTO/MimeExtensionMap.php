<?php

namespace App\DTO;

final class MimeExtensionMap
{
    private array $map = [
        'image/jpeg' => ['jpg', 'jpeg'],
        'image/png'  => ['png'],
        'application/pdf' => ['pdf'],
        'application/msword' => ['doc'],
    ];

    public function isMatching(string $mime, string $extension): bool
    {
        return array_key_exists($mime, $this->map) && in_array($extension, $this->map[$mime], true);
    }
}