<?php

use App\DAO\NoteDAO;
use App\DTO\NoteDTO;
use Core\App;
use Core\Database;
use Core\Validator;

$dao = App::resolve(NoteDAO::class);

$currentUserId = $_SESSION['user']['id'];

// 1. Buscar la nota. Ahora el id viene de $_POST, porque es un formulario
$note = App::resolve(NoteDAO::class)->findById((int) $_POST['id']) ?? abort();


// 2. Autorizar: ¿es tuya?
authorize($note->userId === $_SESSION['user']['id']);

// 3. Validar
$errors = [];

if (! Validator::string($_POST['body'], 1, 1000)) {
    $errors['body'] = 'A body of no more than 1,000 characters is required.';
}

if (count($errors)) {
    return view('notes/edit.view.php', [
        'heading' => 'Edit Note',
        'errors' => $errors,
        'note' => $note
    ]);
}

// 4. Guardar
$dao->update(new NoteDTO($note->id, $_POST['body'], $note->userId));

// 5. Redirigir (PRG)
header('location: /notes');
die();