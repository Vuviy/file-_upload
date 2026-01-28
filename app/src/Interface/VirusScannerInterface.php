<?php

namespace App\Interface;

interface VirusScannerInterface
{
    /**
     * @param string $filePath
     * @return void
     */
    public function scan(string $filePath): void;
}