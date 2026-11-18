<?php

namespace App\DAO;

use Core\App;
use Core\Database;

class DAOFactory
{
    public static function noteDAO(string $driver): NoteDAO
    {
        return match ($driver) {
            'mysql' => new PdoNoteDAO(App::resolve(Database::class)),
            'memory' => new InMemoryNoteDAO(),
            default => throw new \InvalidArgumentException("Unknown DAO driver: {$driver}"),
        };
    }
    public static function userDAO(string $driver): UserDAO
    {
        return match ($driver) {
            'mysql' => new PdoUserDAO(App::resolve(Database::class)),
            default => throw new \InvalidArgumentException("Unknown DAO driver: {$driver}"),
        };
    }
}