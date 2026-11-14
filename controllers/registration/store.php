<?php

use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);

$name =  $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

// 1. Buscar la nota. Ahora el id viene de $_POST, porque es un formulario
$errors = [];

if (! Validator::string($name, 5, 20)) {
    $errors['name'] = 'Please provide a valid Username.';
}

if (! Validator::email($email)) {
    $errors['email'] = 'Please provide a valid email address.';
}

if (! Validator::string($password, 7, 255)) {
    $errors['password'] = 'Please provide a password of at least seven characters.';
}



if (! empty($errors)) {
    return view('registration/create.view.php', [
        'errors' => $errors
    ]);
}

// 2. Autorizar: ¿es tuya?
$user = $db->query('select * from users where email = :email', [
    'email' => $email
])->find();

if ($user) {
    header('location: /');
    exit();
}

$db->query('INSERT INTO users(name, email, password) VALUES (:name, :email, :password)', [
    'name' => $name,
    'email' => $email,
    'password' => password_hash($password, PASSWORD_BCRYPT)
]);

$_SESSION['user'] = [
    'email' => $email
];

header('location: /');
exit();