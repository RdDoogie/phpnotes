<?php

namespace Core;

class Route
{
    public ?string $middleware = null;
    function __construct(
        public readonly string $method,
        public readonly string $uri,
        public readonly string $controller
    ){}

}