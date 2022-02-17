<?php

$courses = ['java', 'JS', 'PHP', 'Python'];

$courses_complex = [
  'mobile' => 'java', 
  'fullstack' => 'JS', 
  'backend' =>'PHP', 
  'fullstack' => 'Python',
  'library' => 'react'
];

// echo var_dump($courses);

/*
foreach ($courses_complex as $key => $value) {
  echo "$key: $value <br>";
}
*/

function upper($courses_complex, $key) {
  echo strtoupper($courses_complex) . ": $key <br>";
}

/** 
 * array_walk($courses_complex, 'upper');
 * array_key_exists('backend', $courses_complex); 
 * array_keys();
 * array_values();
 * */