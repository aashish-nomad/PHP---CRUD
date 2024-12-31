<?php

namespace Core;

class Authenticator
{
  public function attempt($email, $password)
  {
    $user = App::resolve(Database::class)->query('SELECT * FROM users WHERE email = :email', [
      'email' => $email
    ])->findSingle();

    if ($user) {
      // if user email found check if the password matches.
      if (password_verify($password, $user['password'])) {
        // Login the user if the credentials match.
        $this->login([
          'email' => $email,
          'name' => $user['name']
        ]);

        return true;
      }
    }

    return false;
  }

  public function login($user)
  {
    $_SESSION['user'] = $user;

    session_regenerate_id(true);
  }

  public function logout()
  {
    // Empty global session object.
    $_SESSION = [];

    // Delete the content of file in which session was stored.
    session_destroy();

    // Delete the cookie stored in the client browser.
    $params = session_get_cookie_params();
    setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
  }
}
