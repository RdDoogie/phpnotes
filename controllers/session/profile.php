<?php

use App\DAO\NoteDAO;


$user = $_SESSION['user'];

//$notes = NoteDAO::class->countByUser($user['id']);

view('session/profile.view.php', [
    'heading' => 'Profile info',
    'user' => $user,
    'notes' => $notes
]);