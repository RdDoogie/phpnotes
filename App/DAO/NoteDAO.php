<?php

namespace App\DAO;

use App\DTO\NoteDTO;

interface NoteDAO
{
    public function findById(int $id): ?NoteDTO;

    /** @return NoteDTO[] */
    public function findByUser(int $userId): array;

    public function create(NoteDTO $note): int;

    public function update(NoteDTO $note): void;

    public function delete(int $id): void;
}