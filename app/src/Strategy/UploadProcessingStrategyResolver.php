<?php

namespace App\Strategy;

use App\Interface\UploadStrategy;
use Exception;

class UploadProcessingStrategyResolver
{
    /** @var UploadStrategy[] */
    private array $strategies;

    public function __construct(array $strategies)
    {
        $this->strategies = $strategies;
    }

    public function resolve(string $mimeType): UploadStrategy
    {
        foreach ($this->strategies as $strategy) {
            if ($strategy->supports($mimeType)) {
                return $strategy;
            }
        }

        throw new Exception('No processing strategy found');
    }
}