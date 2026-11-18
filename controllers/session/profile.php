<?php

use App\DAO\NoteDAO;
use Core\App;

$user = $_SESSION['user'];

$notes = App::resolve(NoteDAO::class)->countByUser($user['id']);

view('session/profile.view.php', [
    'heading' => 'Profile info',
    'user' => $user,
    'notes' => $notes
]);