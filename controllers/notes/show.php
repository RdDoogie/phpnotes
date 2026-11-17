<?php

use Core\App;
use Core\Database;
use App\DTO\NoteDTO;


$db = App::resolve(Database::class);

$currentUserId = $_SESSION['user']['id'];

$note = NoteDTO::fromArray(
    $db->query('select * from note where id = :id', ['id' => $_GET['id']])->findOrFail()
);

authorize($note->userId === $currentUserId);

view('notes/show.view.php', [
    'heading' => 'Note',
    'note' => $note
]);


