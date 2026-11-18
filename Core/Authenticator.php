<?php

namespace Core;

use App\DAO\PdoUserDAO;
use App\DAO\UserDAO;
use App\DTO\UserDTO;

class Authenticator
{
    public function attempt(string $email, string $password): bool
    {
        $user = App::resolve(UserDAO::class)->findByEmail($email);

        if ($user && password_verify($password, $user->password)) {
            $this->login($user);

            return true;
        }

        return false;
    }

    public function login(UserDTO $user): void
    {
        $_SESSION['user'] = [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
        ];
        session_regenerate_id(true);
    }

    public function logout(): void
    {
        Session::destroy();
    }
}