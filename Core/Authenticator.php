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
    Session::destroy();
  }
}
