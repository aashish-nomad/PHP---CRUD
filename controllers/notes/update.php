<?php

use Core\Database;
use Core\App;
use Core\Validator;

$currentUserId = 1;

$db = App::resolve(Database::class);

// Lets find the corresponding notes.
$note = $db->query('SELECT * FROM notes where id = :id;', ['id' => $_POST['id']])->findSingleOrAbort();

// Authorize that the current user can edit the note.
authorize($note['user_id'] !== $currentUserId);

// Validate the form.
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

  return view("notes/edit.view.php", [
    'heading' => 'Edit Note.',
    'errors' => $errors,
    'note' => $note
  ]);

  die();
}


// If no validation errors, update the record in the notes database table.
if (empty($errors)) {
  $db->query('UPDATE notes SET title = :title, body = :body WHERE id = :id', [
    'id' => $_POST['id'],
    'title' => $_POST['title'],
    'body' => $_POST['body'],
  ]);
}

header('location: /notes');
die();
