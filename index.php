<?php 
//header("Location: ../skels/index.html");

//Creazione variabili 

$hp=0;
$attack=0;
$defense=0;
$spatt=0;
$spdefense=0;
$speed=0;
$k = 5;

$user_pokemon = [ $hp, $attack, $defense, $spatt, $spdefense, $speed ];
$distances= array();

// Calcolar dist. euclidea fra $user_pokemon e ciascun pokemon del dataset
// Inserire per ogni distanza trovata indice del pokemon e distanza in un array inizialmente vuoto
// Ordinare per distanza l'array così creato (matrice 721 x 2)
// Prendere i primi K elementi
// Per ciascuno di K elementi chiamare la funzione getPokemonByPokedexId per creare le card

//presi i valori dal csv 
$csv = array_map('str_getcsv', file('data/pokemon.csv'));

for ($i = 0; $i < sizeof($csv); $i++){
    $pokemon = $csv[$i];
    $pokemondistance=array();
    array_push($pokemondistance,$pokemon[0]);
    $pokemonstats=[ $pokemon[5],$pokemon[6],$pokemon[7],$pokemon[8],$pokemon[9],$pokemon[10]];
    $dist = genericEuclideanDistance($user_pokemon, $pokemonstats);
    array_push($pokemondistance, $dist);
    array_push($distances, $pokemondistance);

    //$distances[$i]= list("id", "euclid") = [$distances[$i][0] , $distances[$i][1]];

    
 
}


//rint_r($distances[2][1]);

    do
    {
            $scambiato = false;
            for($i=0;$i<721;$i++){
                if( $distances[$i][1] > $distances[$i + 1][1] ) {
                    $temp = $distances[$i + 1] [1];
                    $tempid = $distances[$i + 1] [0];
                    $distances[$i + 1][1] = $distances[$i][1];
                    $distances[$i + 1][0] = $distances[$i][0];
                    $distances[$i][1]  = $temp;
                    $distances[$i][0]  = $tempid;
                    $scambiato = true;
                }
            }
    }
    while($scambiato);




//ho trasformato l'array in un array associativo, dopo aver fatto   


print_r($distances);

//Dobbiamo ordinare l'array in oridne crescente formato da ['id', 'valore']


// print_r($csv);
// print_r($csv[0]);
/*for ($i = 0; $i < sizeof($csv); $i++){
    $pokemon = $csv[$i];
    print("Pokedex id -> " . $pokemon[0] . " ");
    print("Name -> " . $pokemon[1]);
    print("<br />");
}*/



function euclideanDistance($point_1, $point_2){
    // $point_1 e $point_2 sono delle strutture che contengono dei numeri -> es. array [2, 5], in generale [x, y]
    $dist = sqrt(pow($point_1[0] - $point_2[0], 2) +pow($point_1[1] - $point_2[1], 2) );


    return $dist;
}

function getPokemonByPokedexId($id, $csv){
    // esplora il dataset e restituisce il pokemon con indice del pokedex pari a $id
    for ($i = 0; $i < sizeof($csv); $i++){
        $pokemon = $csv[$i];
        //print("Pokedex id -> " . $pokemon[0] . " ");
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
        $somma+=pow($point_1[$i]-$point_2[$i],2);
    }
    return sqrt($somma);  
}

function distanzaEuclidea($num1,$num2,$length){
    $distance=0;
    for($i=0;$i<$length;$i++){
        $distance += pow(($num1 - $num2), 2);

    }
       
    return sqrt($distance);

}

//echo distanzaEuclidea(10,5,1);
//(1;1) (721;13)

$pokemon = getPokemonByPokedexId(721, $csv);

/*print_r($pokemon);
print("<br />");
print(genericEuclideanDistance([4,4, 4, 4], [4, 4, 4, 4]));*/
?>