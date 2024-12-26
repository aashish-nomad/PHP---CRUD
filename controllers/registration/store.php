<?php

use Core\App;
use Core\Database;
use Core\Validator;

$errors = [];

// Get user entered email and password.
$email = $_POST['email'];
$password = $_POST['password'];
$username = $_POST['username'];

// Validate email
if (!Validator::email($email)) {
  $errors['email'] = 'Please provide a valid email address.';
}

// Validate username.
if (!Validator::string($username, 5, 255)) {
  $errors['username'] = 'Username length should be atleast 5 characters and not more than 255 characters.';
}

// Validate password.
if (!Validator::string($password, 7, 255)) {
  $errors['password'] = 'Password length should be atleast 7 characters and not more than 255 characters.';
}

// If any validation error redirect to registration page with the error messages.
if (!empty($errors)) {
  return view('/registration/create.view.php', [
    'errors' => $errors
  ]);

  exit();
}

// Check if user email already exists in database.
$db = App::resolve(Database::class);

$doesUserEmailExist = $db->query('SELECT * FROM users WHERE email = :email', [
  'email' => $email
])->findSingle();

$doesUserNameExist = $db->query('SELECT * FROM users WHERE name = :name', [
  'name' => $username
])->findSingle();


// If user already exists redirect the user to the login page.
if ($doesUserEmailExist || $doesUserNameExist) {
  // Redirct user to the login page.
  header('location: /');
  exit();
} else {
  // If user does not exists save user data to the database.
  $db->query('INSERT INTO users(email, name, password) VALUES(:email, :name, :password)', [
    'email' => $email,
    'name' => $username,
    'password' => $password
  ]);

  // Mark user as logged in.
  $_SESSION['user'] = [
    'email' => $email,
    'name' => $username
  ];

  header('location: /');
  exit();
}
