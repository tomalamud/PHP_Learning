<?php

/*
$greet = function ($name) {
  return "hola, $name";  
}
*/

function greet(Closure $lang, $name) {
  return $lang($name);
}

$es = function ($n) {
  return "Hola, $n";
};

$en = function($n) {
  return "Hi, $n";
};

echo greet($en, "Tomás");
