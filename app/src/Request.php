<?php

namespace App;

final class Request
{
    public function __construct(private array $params = []) {}
    public function post(?string $key = null): mixed
    {
        if($key === null) {
            return $_POST;
        }
        return $_POST[$key] ?? null;
    }

    public function params(string $key = null): mixed
    {
        if($key === null) {
            return $this->params;
        }
        return  $this->params[$key] ?? null;
    }

    public function get(?string $key = null): mixed
    {
        if($key === null) {
            return $_GET;
        }
        return $_GET[$key] ?? null;
    }

    public function cookie(string $key): ?string
    {
        return $_COOKIE[$key] ?? null;
    }

    public function referer(): ?string
    {
        return $_SERVER['HTTP_REFERER'] ?? null;
    }

    public function method(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function file(): array
    {
        return $_FILES['file'] ?? [];
    }
}