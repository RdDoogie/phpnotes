<?php

use Core\App;
use Core\Database;
use Core\Validator;
use Core\Authenticator;

$db = App::resolve(Database::class);

$name =  $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

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

// ¿Ya existe? (aquí $user es false si es nuevo, y eso es lo normal)
$user = $db->query('select * from users where email = :email', [
    'email' => $email
])->find();

if ($user) {
    header('location: /');
    exit();
}

// Crearlo
$db->query('INSERT INTO users(name, email, password) VALUES (:name, :email, :password)', [
    'name' => $name,
    'email' => $email,
    'password' => password_hash($password, PASSWORD_BCRYPT)
]);

// Volver a buscarlo: ahora sí existe y tiene id
$user = $db->query('select * from users where email = :email', [
    'email' => $email
])->find();

(new Authenticator)->login($user);

redirect('/');

exit();