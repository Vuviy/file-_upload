<?php

namespace App\Services;

use App\Interface\VirusScannerInterface;
use Exception;

final class ClamAVVirusScanner implements VirusScannerInterface
{
    public function scan(string $filePath): void
    {
        $command = sprintf(
            'clamscan --no-summary %s',
            escapeshellarg($filePath)
        );

        exec($command, $output, $exitCode);

        if ($exitCode === 1) {
            throw new Exception('Virus detected in uploaded file');
        }

        if ($exitCode === 2) {
            throw new Exception('Antivirus scan failed');
        }
    }
}