<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$currentUserId = $_SESSION['user']['id'];


    $note = $db->query('select * from note where id = :id', [
        'id' => $_POST['id']
    ])->findOrFail();

    authorize((int) $note['user_id'] === $currentUserId);

    $db ->query('delete from note where id = :id', [
        'id' => $_POST['id']
    ]);
    header('location: /notes');
    exit();



