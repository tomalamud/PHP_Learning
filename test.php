<?php 

// echo "Hola \n";

// $nombre = "Tomás";
// $apellido = "Elizondo";

// echo "Hola " . $nombre . " " . $apellido . "\n";

/*
$personas = [
  "carlos" => 22,
  "Mr Michi" => 21,
  "Juan Sebastián" => 65
];

print_r($personas);
// var_dump( $personas );
echo "\n";

# CONSTANTES 

define("CONST_PI", 3.14);

echo "\n" . CONST_PI;

$numero = 0;
$numero = (boolean) $numero;
var_dump( $numero );

$michis = 3 + "5 michis";
var_dump($michis);

$bool_true = true;
$bool_false = false;
var_dump(!$bool_true);

echo (2 <=> 1) . "\n"; // 1
echo (-4 <=> 1) . "\n"; // -1
echo (1 <=> 1) . "\n"; // 0

$edad_pepito = 23;
echo $edad_juanito ?? $edad_pepito; 
// Si la edad de Juanito no esta definida, usa la edad de pepito
echo "\n";
*/

$horas = readline("Las horas son: ");
$minutos = readline("Los minutos son: ");

$tiempo_en_segundos = ($horas * 60 * 60) + ($minutos * 60);

echo "Este tiempo equivale a $tiempo_en_segundos";
