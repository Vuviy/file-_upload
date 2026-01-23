<?php

namespace App;

final class Request
{
    public static function post(?string $key = null): mixed
    {
        if($key === null) {
            return $_POST;
        }
        return $_POST[$key] ?? null;
    }

    public static function cookie(string $key): ?string
    {
        return $_COOKIE[$key] ?? null;
    }

    public static function referer(): ?string
    {
        return $_SERVER['HTTP_REFERER'] ?? null;
    }

    public static function method(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }
}