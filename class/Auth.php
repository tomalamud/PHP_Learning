<?php

// Abstracción: definir todo lo que debe contemplar esta clase de manera sencilla.
class Auth {
  protected $email;
  protected $password;

  public function login() {}
  public function validate() {}
  public function resolve() {}
  public function failed() {}
}