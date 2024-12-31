<?php

namespace Http\Forms;

use Core\Validator;

class LoginForm
{
  protected $errors = [];

  public function validate($email, $password)
  {

    if (!Validator::email($email)) {
      $this->errors['email'] = 'Please provide a valid email address.';
    }

    if (!Validator::string($password, 7, 255)) {
      $this->errors['password'] = 'Password length should be atleast 7 characters and not more than 255 characters.';
    }

    return empty($errors);
  }

  public function errors()
  {
    return $this->errors;
  }
}
