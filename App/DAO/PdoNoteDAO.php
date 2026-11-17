<?php

namespace App\DAO;

use App\DTO\NoteDTO;
use Core\Database;

class PdoNoteDAO implements NoteDAO
{
    public function __construct(private Database $db) {}

    public function findById(int $id): ?NoteDTO
    {
        $row = $this->db->query('select * from note where id = :id', [
            'id' => $id
        ])->find();

        return $row ? NoteDTO::fromArray($row) : null;
    }

    public function findByUser(int $userId): array
    {
        $rows = $this->db->query('select * from note where user_id = :user_id', [
            'user_id' => $userId
        ])->get();

        return array_map(fn (array $row) => NoteDTO::fromArray($row), $rows);
    }

    public function create(NoteDTO $note): int
    {
        $this->db->query('insert into note(body, user_id) values(:body, :user_id)', [
            'body' => $note->body,
            'user_id' => $note->userId,
        ]);

        return (int) $this->db->connection->lastInsertId();
    }

    public function update(NoteDTO $note): void
    {
        $this->db->query('update note set body = :body where id = :id', [
            'body' => $note->body,
            'id' => $note->id,
        ]);
    }

    public function delete(int $id): void
    {
        $this->db->query('delete from note where id = :id', [
            'id' => $id
        ]);
    }
}