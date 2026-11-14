<?php

use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);

$currentUserId = 1;

// 1. Buscar la nota. Ahora el id viene de $_POST, porque es un formulario
$note = $db->query('select * from note where id = :id', [
    'id' => $_POST['id']
])->findOrFail();

// 2. Autorizar: ¿es tuya?
authorize((int) $note['user_id'] === $currentUserId);

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
$db->query('update note set body = :body where id = :id', [
    'id' => $_POST['id'],
    'body' => $_POST['body']
]);

// 5. Redirigir (PRG)
header('location: /notes');
die();