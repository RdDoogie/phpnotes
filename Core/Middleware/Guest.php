<?php

namespace Core\Middleware;

class Guest implements MiddlewareInterface
{
    public function handle(): void
    {
        if ($_SESSION['user'] ?? false) {
            header('location: /');
            exit();
        }
    }
}