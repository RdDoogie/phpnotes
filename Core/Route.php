<?php

namespace Core;

class Route
{
    function __construct(
        public readonly string $method,
        public readonly string $uri,
        public readonly string $controller
    ){}
}