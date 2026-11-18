<?php

use App\DAO\UserDAO;
use Core\App;
use Core\Container;
use Core\Database;
use App\DAO\NoteDAO;
use App\DAO\DAOFactory;

$container = new Container();

$container->bind(Database::class, function () {
    $config = require base_path('config.php');

    return new Database(
        $config['database'],
        $config['username'],
        $config['password']
    );
});


$container->bind(NoteDAO::class, function () {
    $config = require base_path('config.php');

    return DAOFactory::noteDAO($config['dao']);
});

$container->bind(UserDAO::class, function() {
    $config = require base_path('config.php');

    return DAOFactory::userDAO($config['dao']);
});

App::setContainer($container);
