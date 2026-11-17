<?php

namespace App\DTO;

final readonly class NoteDTO
{
    public function __construct(
        public ?int $id,
        public string $body,
        public int $userId,
    ) {}

    public static function fromArray(array $row): static
    {
        return new static(
            (int) $row['id'],
            $row['body'],
            (int) $row['user_id'],
        );
    }
}