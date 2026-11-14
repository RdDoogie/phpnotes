<?php

namespace Core\Middleware;

class Authenticated implements MiddlewareInterface
{
    public function handle(): void
    {
        if (! ($_SESSION['user'] ?? false)) {
            header('location: /');
            exit();
        }
    }
}