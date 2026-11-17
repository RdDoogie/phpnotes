<?php

use App\DAO\NoteDAO;
use Core\App;

$notes = App::resolve(NoteDAO::class)->findByUser($_SESSION['user']['id']);

view('notes/index.view.php', [
    'heading' => 'My Notes',
    'notes' => $notes
]);