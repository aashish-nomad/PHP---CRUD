<?php

use Core\App;
use Core\Database;

$currentUserId = 1;

$db = App::resolve(Database::class);

$notes = $db->query("SELECT * FROM notes where user_id = $currentUserId;")->findAll();

view("notes/index.view.php", [
  'heading' => 'Notes page.',
  'notes' => $notes
]);
