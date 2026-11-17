<?php

use App\DAO\NoteDAO;
use Core\App;

$note = App::resolve(NoteDAO::class)->findById((int) $_GET['id']) ?? abort();

authorize($note->userId === $_SESSION['user']['id']);

view('notes/edit.view.php', [
    'heading' => 'Note',
    'note' => $note
]);