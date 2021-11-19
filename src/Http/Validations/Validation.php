<?php

namespace ASPTest\Http\Validations;

class Validation
{
  public $data;
  function __construct()
  {
    $this->data = ['message' => [], 'fails' => false];
  }

  public function make(array $rules, array $request)
  {
    foreach ($rules as $index => $rule) {

      if (isset($request[$index])) {
        $value = $request[$index];

        if ($rule == "name") $this->validateName($index, $value);
        if ($rule == "email") $this->validateEmail($value);
        if ($rule == "age") $this->validateAge($value);
        if ($rule == "pwd") $this->validatePwd($value, $request);
      }
    }

    $records = (array) $this->data['message'];
    if (count($records) > 0) $this->data['fails'] = true;

    return (object) $this->data;
  }


  function validateName($attribute, $value)
  {
    if (strlen($value) < 2 || strlen($value) > 35) {
      $this->data['message'][] = "The {$attribute} must have 2 to 35 maximum characters.";
    }
  }

  function validateEmail($value)
  {
    if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
      $this->data['message'][] = "Invalid email.";
    }
  }

  function validateAge($value)
  {
    if (!filter_var($value, FILTER_VALIDATE_INT)) {
      $this->data['message'][] = "The Age must have only integer values.";
    }

    if (strlen($value) > 4) {
      $this->data['message'][] = "The Age must have only 4 digit.";
    }

    if ((int) $value > 150) {
      $this->data['message'][] = "The age can't be bigger to 150.";
    }
  }

  function validatePwd($value, $request)
  {
    $uppercase = preg_match('@[A-Z]@', $request['password']);
    $lowercase = preg_match('@[a-z]@', $request['password']);
    $number    = preg_match('@[0-9]@', $request['password']);

    if ($request['password'] != $request['confirm_password']) {
      $this->data['message'][] = " - Invalid password confirm.";
    }

    if (!$uppercase || !$lowercase || !$number || strlen($request['password']) < 6) {
      $this->data['message'][] = "The password must have.";
      $this->data['message'][] = " - minimum 6 characteres.";
      $this->data['message'][] = " - 1 especial character.";
      $this->data['message'][] = " - 1 capitall letter";
      $this->data['message'][] = " - 1 number.";
    }
  }
}
