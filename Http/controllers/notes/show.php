<?php

use Core\Database;
use Core\App;

$currentUserId = 1;

$db = App::resolve(Database::class);

$note = $db->query('SELECT * FROM notes where id = :id;', ['id' => $_GET['id']])->findSingleOrAbort();

authorize($note['user_id'] !== $currentUserId);

view("notes/show.view.php", [
  'heading' => 'Note page.',
  'note' => $note
]);
