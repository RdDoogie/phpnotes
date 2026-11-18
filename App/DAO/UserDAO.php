<?php

namespace App\DAO;

use App\DTO\UserDTO;

interface UserDAO
{
    public function findById(int $id): ?UserDTO;

    /** @return UserDTO[] */
    public function findByEmail(string $email): ?UserDTO;

    public function create(UserDTO $user): int;
    //public function countByUser(int $userId): int;
}