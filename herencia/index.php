<?php

class User {
  public $name;

  public function __construct($name) {
    $this->name = $name;
  }

  public function getName() {
    return $this->name;
  }
}

final class Admin extends User {
  public function getName() {
    return "Hola! $this->name";
  } 
}

$admin = new Admin("Tomás");
echo $admin->getName() . "\n";