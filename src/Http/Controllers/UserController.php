<?php

namespace ASPTest\Http\Controllers;

use ASPTest\config\HashBcrypt;
use ASPTest\Models\User;
use ASPTest\Http\Validations\Validation;


class UserController
{
  public static $rules;

  public function register(array $requestuest)
  {
    try {
      $rules = [
        'first_name' => 'name',
        'last_name' => 'name',
        'email' => 'email',
        'age' => 'age'
      ];

      $validation = new Validation();
      $validate = $validation->make($rules, $requestuest);

      if ($validate->fails) return [
        'status' => false,
        'message' => $validate->message
      ];

      $user = User::find(['email', $requestuest['email']]);
      if ($user->rowCount()) {
        return [
          'status' => false,
          'message' => ["Email '{$requestuest['email']}' in use."]
        ];
      }

      $register = User::create((object) $requestuest);
      if ($register) {
        $user = User::findLast();
        unset($user->password);

        return [
          'status' => true,
          'user' => $user
        ];
      }
    } catch (\PDOException $e) {
      return [
        'status' => false,
        'message' => [$e->getMessage(), "Order not processed"]
      ];
    }
  }

  static function setPassword(array $requestuest)
  {
    try {
      $user = User::find(['id', $requestuest['id']]);
      if (!$user->rowCount()) {
        return [
          'status' => false,
          'message' => ["User not found."]
        ];
      }

      $rules = ['password' => 'pwd'];
      $validation = new Validation();
      $validate = $validation->make($rules, $requestuest);

      if ($validate->fails) return [
        'status' => false, 'message' => $validate->message
      ];

      $requestuest['password'] = HashBcrypt::bcrypt($requestuest['password']);
      $pwd = User::generatePwd((object) $requestuest);

      if ($pwd) {
        return [
          'status' => true,
          'message' => "Password was successfuly created"
        ];
      }
    } catch (\Throwable $th) {
      return [
        'status' => false,
        'message' => ["Password couldn't be created."]
      ];
    }
  }
}
