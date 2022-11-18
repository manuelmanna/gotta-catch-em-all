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
// print_r($csv);
// print_r($csv[0]);
for ($i = 0; $i < sizeof($csv); $i++){
    $pokemon = $csv[$i];
    print("Pokedex id -> " . $pokemon[0] . " ");
    print("Name -> " . $pokemon[1]);
    print("<br />");
}

function euclideanDistance($point_1, $point_2){
    // $point_1 e $point_2 sono delle strutture che contengono dei numeri -> es. array [2, 5], in generale [x, y]
    $dist = sqrt(pow($point_1[0] - $point_2[0], 2) +pow($point_1[1] - $point_2[1], 2) );


    return $dist;
}

function getPokemonByPokedexId($id){
    // esplora il dataset e restituisce il pokemon con indice del pokedex pari a $id
    for ($i = 0; $i < sizeof($csv); $i++){
        $pokemon = $csv[$i];
        print("Pokedex id -> " . $pokemon[0] . " ");
        if($pokemon[0]==$id){
            return $pokemon;
        }
    }

}

function genericEuclideanDistance($point_1, $point_2){
    // non conosciamo le dimensioni dello spazio vettoriale di $point_1 e $point_2
    // Diciamo che $point_1 e $point_2 hannno N elementi 
    // Calcoliamo la somma dei quadrati della differenza fra gli elementi con stesso indice
    // Inizializziamo una variabile a zero -> conterrà le somme 
    // In un ciclo for calcoliamo la differenza fra le coordinate con indice $i dei due punti, 
    // la eleviamo al quadrato e sommiamo alla variabile creata al punto precedente
    // la variabile che contiene tutte le somme può essere messa sotto radice e quella è la mia distanza
    // ritornare la distanza
    $somma=0;
    for($i=0;$i<sizeof($point_1);$i++){
        $somma+=pow($point_1[$i]+$point_2[$i],2);
    }
    $dist=sqrt($somma);  
}

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