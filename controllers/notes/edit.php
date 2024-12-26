<?php

use Core\Database;
use Core\App;

$currentUserId = 1;

$db = App::resolve(Database::class);

$note = $db->query('SELECT * FROM notes where id = :id;', ['id' => $_GET['id']])->findSingleOrAbort();

authorize($note['user_id'] !== $currentUserId);

view("notes/edit.view.php", [
  'heading' => 'Edit Note.',
  'errors' => [],
  'note' => $note
]);
