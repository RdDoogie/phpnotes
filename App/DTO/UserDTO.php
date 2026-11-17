<?php

namespace App\DTO;

final readonly class UserDTO
{
    public function __construct(
        public ?int $id,
        public string $name,
        public string $email,
        public string $password
    ) {}

    public static function fromArray(array $row): static
    {
        return new static(
            (int) $row['id'],
            $row['name'],
            $row['email'],
            $row['password']
        );
    }
}