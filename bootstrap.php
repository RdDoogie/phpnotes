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




use App\DAO\DAOFactory;

$container->bind(NoteDAO::class, function () {
    $config = require base_path('config.php');

    return DAOFactory::noteDAO($config['dao']);
});

App::setContainer($container);
