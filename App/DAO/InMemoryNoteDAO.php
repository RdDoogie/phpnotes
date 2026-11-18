<?php

namespace App\DAO;

use App\DTO\NoteDTO;

class InMemoryNoteDAO implements NoteDAO
{
    /** @var NoteDTO[] */
    private array $notes = [];
    private int $nextId = 1;

    public function findById(int $id): ?NoteDTO
    {
        return $this->notes[$id] ?? null;
    }

    public function findByUser(int $userId): array
    {
        return array_values(array_filter(
            $this->notes,
            fn (NoteDTO $note) => $note->userId === $userId
        ));
    }

    public function create(NoteDTO $note): int
    {
        $id = $this->nextId++;

        $this->notes[$id] = new NoteDTO($id, $note->body, $note->userId);

        return $id;
    }

    public function update(NoteDTO $note): void
    {
        $this->notes[$note->id] = $note;
    }

    public function delete(int $id): void
    {
        unset($this->notes[$id]);
    }

    public function countByUser(int $userId): int
    {
        return count($this->findByUser($userId));
    }
}