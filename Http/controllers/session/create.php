<?php

use Core\Session;

view('session/create.view.php', [
  'heading' => 'Login Page.',
  'errors' => Session::get('errors')
]);
