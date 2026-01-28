<?php

namespace App\Services;

use Exception;

final class ImageProcessor
{
    public function resize(
        string $tmpPath,
        string $mimeType,
        int $maxWidth = 1920,
        int $maxHeight = 1080
    ): string {
        [$src, $width, $height] = $this->createSource($tmpPath, $mimeType);

        [$newW, $newH] = $this->calculateSize($width, $height, $maxWidth, $maxHeight);

        $dst = \imagecreatetruecolor($newW, $newH);

        \imagecopyresampled(
            $dst,
            $src,
            0, 0, 0, 0,
            $newW, $newH,
            $width, $height
        );

        $newTmp = tempnam(sys_get_temp_dir(), 'img_');

        $this->save($dst, $newTmp, $mimeType);

        \imagedestroy($src);
        \imagedestroy($dst);
        unlink($tmpPath);

        return $newTmp;
    }

    private function createSource(string $path, string $mime): array
    {
        return match ($mime) {
            'image/jpeg' => [\imagecreatefromjpeg($path), ...\getimagesize($path)],
            'image/png'  => [\imagecreatefrompng($path), ...\getimagesize($path)],
            default => throw new Exception('Unsupported image type'),
        };
    }

    private function calculateSize(
        int $w,
        int $h,
        int $maxW,
        int $maxH
    ): array {
        if ($w <= $maxW && $h <= $maxH) {
            return [$w, $h];
        }

        $ratio = min($maxW / $w, $maxH / $h);

        return [
            (int)($w * $ratio),
            (int)($h * $ratio)
        ];
    }

    private function save($image, string $path, string $mime): void
    {
        match ($mime) {
            'image/jpeg' => \imagejpeg($image, $path, 90),
            'image/png'  => \imagepng($image, $path, 9),
            default => throw new Exception('Save failed'),
        };
    }
}