<?php 
//header("Location: ../skels/index.html");

$hp=120;
$attack=80;
$defense=20;
$spatt=50;
$spdefense=100;
$speed=100;
$k = 5;

$user_pokemon = [ $hp, $attack, $defense, $spatt, $spdefense, $speed ];
$distances= array();
$csv = array_map('str_getcsv', file('data/pokemon.csv'));

for ($i = 0; $i < sizeof($csv); $i++){
    $pokemon = $csv[$i];
    $pokemondistance=array();
    array_push($pokemondistance,$pokemon[0]);
    $pokemonstats=[ $pokemon[5],$pokemon[6],$pokemon[7],$pokemon[8],$pokemon[9],$pokemon[10]];
    $dist = genericEuclideanDistance($user_pokemon, $pokemonstats);
    array_push($pokemondistance, $dist);
    array_push($distances, $pokemondistance); 
}
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


for($i = 0; $i < $k; $i++){
    $array = array(getPokemonByPokedexId($distances[$i][0], $csv));
    print_r($array);
    print("<br>");
    print("<img src='../static/images/"  .$array[0][0]. ".jpg'/>");
    print("<br>");
    
}
function euclideanDistance($point_1, $point_2){
    $dist = sqrt(pow($point_1[0] - $point_2[0], 2) +pow($point_1[1] - $point_2[1], 2) );


    return $dist;
}

function getPokemonByPokedexId($id, $csv){
    for ($i = 0; $i < sizeof($csv); $i++){
        $pokemon = $csv[$i];
        if($pokemon[0]==$id){
            return $pokemon;
        }
    }

}

function genericEuclideanDistance($point_1, $point_2){
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
?>