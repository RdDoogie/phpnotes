<?php

use Core\App;
use Core\Container;
use Core\Database;

$container = new Container();

$container->bind(Database::class, function () {
    $config = require base_path('config.php');

    return new Database(
        $config['database'],
        $config['username'],
        $config['password']
    );
});

use App\DAO\NoteDAO;
use App\DAO\PdoNoteDAO;

$container->bind(NoteDAO::class, fn () => new PdoNoteDAO(
    $container->resolve(Database::class)
));

App::setContainer($container);