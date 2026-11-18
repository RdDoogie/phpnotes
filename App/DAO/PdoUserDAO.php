<?php

namespace App\DAO;

use App\DTO\UserDTO;
use Core\Database;

class PdoUserDAO implements UserDAO
{
    public function __construct(private Database $db) {}

    public function findById(int $id): ?UserDTO
    {
        $row = $this->db->query('select * from users where id = :id', [
            'id' => $id
        ])->find();

        return $row ? UserDTO::fromArray($row) : null;
    }



    public function create(UserDTO $user): int
    {
        $this->db->query('insert into user(name, email, password) values(:name, :email, :password)', [
            'name' => $user->name,
            'email' => $user->email,
            'password' => $user->password
        ]);

        return (int) $this->db->connection->lastInsertId();
    }

    public function findByEmail(string $email): ?UserDTO
    {
        $row = $this->db->query('select * from users where email = :email', [
            'email' => $email
        ])->find();

        return $row ? UserDTO::fromArray($row) : null;
    }

    public function delete(int $id): void
    {
        $this->db->query('delete from user where id = :id', [
            'id' => $id
        ]);
    }
}