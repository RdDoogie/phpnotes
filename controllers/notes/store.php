<?php
use Core\Validator;
use Core\App;
use Core\Database;

$db = App::resolve(Database::class);
$config = require base_path('config.php');

$errors =[];


if (! Validator::string($_POST['body'], 1, 1000)) {
    $errors['body'] = 'A body of no more than 1,000 characters is required.';
}

if (! empty($errors)) {
    return view("notes/create.view.php", [
        'heading' => 'Create Note',
        'errors' => $errors
    ]);
}

if (empty($errors)) {
    App::resolve(NoteDAO::class)->create(
        new NoteDTO(null, $_POST['body'], $_SESSION['user']['id'])
    );

    redirect('/notes');
}
