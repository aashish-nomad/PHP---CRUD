<?php

use Core\Database;
use Core\App;

$currentUserId = 1;

$db = App::resolve(Database::class);

// Logic to delete the note.
$note = $db->query('SELECT * FROM notes where id = :id;', ['id' => $_POST['id']])->findSingleOrAbort();

authorize($note['user_id'] !== $currentUserId);

$db->query('DELETE FROM notes WHERE id = :id', [
  'id' => $_POST['id']
]);

header('location: /notes');
exit();
