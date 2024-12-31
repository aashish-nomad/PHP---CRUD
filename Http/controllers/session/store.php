<?php

// Check if user email already exists in database.

use Core\App;
use Core\Database;
use Core\Validator;

$errors = [];

// Get user entered email and password.
$email = $_POST['email'];
$password = $_POST['password'];

// Validate email
if (!Validator::email($email)) {
  $errors['email'] = 'Please provide a valid email address.';
}

// Validate password.
if (!Validator::string($password, 7, 255)) {
  $errors['password'] = 'Password length should be atleast 7 characters and not more than 255 characters.';
}

// If any validation error redirect to session page with the error messages.
if (!empty($errors)) {
  return view('/session/create.view.php', [
    'errors' => $errors
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
