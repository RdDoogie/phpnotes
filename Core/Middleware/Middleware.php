<?php

namespace Core\Middleware;

class Middleware
{
    public const MAP = [
        'guest' => Guest::class,
        'auth' => Authenticated::class,
    ];

    public static function resolve(?string $key): void
    {
        if (! $key) {
            return;                       // ruta sin middleware: no hacemos nada
        }

        $middleware = static::MAP[$key] ?? false;

        if (! $middleware) {
            throw new \Exception("No matching middleware found for key '{$key}'.");
        }

        (new $middleware)->handle();
    }
}