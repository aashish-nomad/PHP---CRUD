<?php

use Core\Database;
use Core\Validator;
use Core\App;

require base_path('Core/Validator.php');

$heading = 'Create a New Note';

$db = App::resolve(Database::class);

$errors = [];

$note_title = $_POST['title'];
$note_body = $_POST['body'];

if (!Validator::string($note_title, 1, 1000)) {
  $errors['title'] = 'Note title cannot be empty and must not be more than 1000 characers.';
}

if (!Validator::string($note_body, 1, 1000)) {
  $errors['body'] = 'Note body cannot be empty and must not be more than 1000 characers.';
}

if (!empty($errors)) {

  return view("notes/create.view.php", [
    'heading' => 'Create a New Note.',
    'errors' => $errors
  ]);

  die();
}

if (empty($errors)) {
  $db->query(
    "INSERT INTO notes(title, body, user_id) VALUES(:title, :body, :user_id)",
    [
      'title' => $_POST['title'],
      'body' => $_POST['body'],
      'user_id' => 1,
    ]
  );

  header('location: /notes');
  exit();
}
