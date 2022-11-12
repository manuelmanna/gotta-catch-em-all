<?php 
//header("Location: ../skels/index.html");

//Creazione variabili 

$hp=0;
$attack=0;
$defense=0;
$spatt=0;
$spdefense=0;
$speed=0;


$csv = array_map('str_getcsv', file('data/pokemon.csv'));
print_r($csv);
//(1;1) (721;13)
?>