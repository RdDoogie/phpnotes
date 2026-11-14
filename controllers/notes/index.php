<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$notes = $db->query('select * from note where user_id = :user_id', [
    'user_id' => $_SESSION['user']['id']
])->get();
view("notes/index.view.php", [
    'heading' => 'My Notes',
    'notes' => $notes
]);