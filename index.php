<?php 
//header("Location: ../skels/index.html");

//Creazione variabili 

$hp=0;
$attack=0;
$defense=0;
$spatt=0;
$spdefense=0;
$speed=0;

//presi i valori dal csv 
$csv = array_map('str_getcsv', file('data/pokemon.csv'));
//print_r($csv);

function distanzaEuclidea($num1,$num2,$length){
    $distance=0;
    for($i=0;$i<$length;$i++){
        $distance += pow(($num1 - $num2), 2);

    }
       
    return sqrt($distance);

}

echo distanzaEuclidea(10,5,1);
//(1;1) (721;13)
?>