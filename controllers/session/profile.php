<?php

use App\DAO\PdoUserDAO;
use App\DAO\UserDAO;
use Core\App;

$user = $_SESSION['user'];

$notes = UserDAO::class->countNotesByUser((int) $user['id']) ?? abort();
view('session/profile.view.php', [
    'heading' => 'Profile info',
    'user' => $user,
    'notes' => $notes
]);