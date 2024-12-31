<?php

// Check if user email already exists in database.

use Core\App;
use Core\Database;
use Core\Validator;
use Http\Forms\LoginForm;

$errors = [];

// Get user entered email and password.
$email = $_POST['email'];
$password = $_POST['password'];

$form = new LoginForm();

// If any validation error redirect to session page with the error messages.
if (!$form->validate($email, $password)) {
  return view('/session/create.view.php', [
    'errors' => $form->errors()
  ]);

  exit();
}

$db = App::resolve(Database::class);

$doesUserEmailExist = $db->query('SELECT * FROM users WHERE email = :email', [
  'email' => $email
])->findSingle();


if ($doesUserEmailExist) {
  // if user email found check if the password matches.
  if (password_verify($password, $doesUserEmailExist['password'])) {
    // Login the user if the credentials match.
    login([
      'email' => $email,
      'name' => $doesUserEmailExist['name']
    ]);

    header('location: /');
    exit();
  }
}

// If user not found or password does not matches.
return view('/session/create.view.php', [
  'errors' => [
    'email' => 'No matching email or password',
    'password' => 'No matching email or password'
  ]
]);
