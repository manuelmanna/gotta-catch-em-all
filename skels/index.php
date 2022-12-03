<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokemon Search</title>
    <link rel="stylesheet" href="../static/css/style.css">
</head>

<body>
    <section id="mainpage">
        <div id="content">
            <h1 id="title" class="font-inter font-weight-bold font-size-44">Gotta Check’em All</h1>
            <div id="subtitlecontainer">
                <p id="subtitle" class="font-inter font-size-18 font-wight-normal"><span
                        class="font-weight-bold">Benvenuto</span> nel tuo motore di ricerca per Pokémon. Potrai inserire
                    le caratteristiche di un <span class="font-weight-bold">Pokémon fittizio</span> e il back-end
                    cercherà grazie all’algoritmo di Machine Learning <span class="font-weight-bold">KNN (K-Nearest
                        Neighbors)</span> i 5 Pokémon più simili a quello che hai inserito.</p>
            </div>
            <form action="index.php" method="post">
                <div class="gruppo-totale-form">
                    <div class="elementi-del-form">
                        <label class="font-weight-bold font-inter">Punti Vita (HP):</label>
                        <input id="input" type="text" placeholder="Inserisci un numero da 0 a 300" name="hp"></input>
                    </div>
                    <div class="elementi-del-form">
                        <label class="font-weight-bold font-inter">Punti Attacco (Attack):</label>
                        <input id="input" type="text" placeholder="Inserisci un numero da 0 a 300" name="Att"></input>
                    </div>
                    <div class="elementi-del-form">
                        <label class="font-weight-bold font-inter">Punti difesa (Defense)</label>
                        <input id="input" type="text" placeholder="Inserisci un numero da 0 a 300" name="Def"></input>
                    </div>
                </div>
                <div class="gruppo-totale-form">
                    <div class="elementi-del-form">
                        <label class="font-weight-bold font-inter">Punti Attacco Speciale (Sp. Atk):</label>
                        <input id="input" type="text" placeholder="Inserisci un numero da 0 a 300" name="SpAtt"></input>
                    </div>
                    <div class="elementi-del-form">
                        <label class="font-weight-bold font-inter">Punti Difesa Speciale (Sp. Defense):</label>
                        <input id="input" type="text" placeholder="Inserisci un numero da 0 a 300" name="SpDef"></input>
                    </div>
                    <div class="elementi-del-form">
                        <label class="font-weight-bold font-inter">Punti velocità (Speed)</label>
                        <input id="input" type="text" placeholder="Inserisci un numero da 0 a 300" name="speed"></input>
                    </div>
                </div>
                <div id="bottone">
                    <button id="cerca" type="submit">CERCA</button>
                </div>
            </form>
            <div id="cardwrap">
                    <?php 
                    
                    if(isset($_POST['hp']) && isset($_POST['Att'])&& isset($_POST['Def'])&& isset($_POST['SpAtt']) && isset($_POST['SpDef'])&& isset($_POST['speed'])){
                        $hp=$_POST['hp'];
                        $attack=$_POST['Att'];
                        $defense=$_POST['Def'];
                        $spatt=$_POST['SpAtt'];
                        $spdefense=$_POST['SpDef'];
                        $speed=$_POST['speed'];
                        $k = 5;
                        
                    
                    function printCard($id, $nome,$gen,$type1,$type2,$hp,$atk,$def,$spatk,$spdef,$speed){
                        echo " <div class='cardcontainer'>
                        <div class='container2'>
                            <div class='imgcontainer'>
                                <img class='cardimg' src='../static/images/$id.png' alt='Immagine del pokemon: $nome'>
                            </div>
                            <div class='statscotainer'>
                                <h3 class='cardname'>$nome</h3>
                                <p class='cardgen'>Gen. $gen</p>
                                <p class='cardtypes'>Tipi: <span class='font-weight-bold'>$type1, $type2</span></p>
                                <div class='cardstats'>
                                    <div>
                                        <p>HP <span class='font-weight-bold'>$hp</span></p>
                                        <p>Atk <span class='font-weight-bold'>$atk</span></p>
                                        <p>Def <span class='font-weight-bold'>$def</span></p>
                                    </div>
                                    <div>
                                        <p>Sp. Atk <span class='font-weight-bold'>$spatk</span></p>
                                        <p>Sp. Def <span class='font-weight-bold'>$spdef</span></p>
                                        <p>Speed <span class='font-weight-bold'>$speed</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>";
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
                    
                    
                        if($hp > 0 && $hp <= 300 &&  is_numeric($hp) && $attack > 0 && $attack <= 300 &&  is_numeric($attack)  && $defense > 0 && $defense <= 300 &&  is_numeric($defense)  && $spatt > 0 && $spatt <= 300 &&  is_numeric($spatt)  && $spdefense > 0 && $spdefense <= 300 &&  is_numeric($spdefense)  && $speed > 0 && $speed <= 300 &&  is_numeric($speed)){
                            $user_pokemon = [ $hp, $attack, $defense, $spatt, $spdefense, $speed ];
                            $distances= array();
                            $csv = array_map('str_getcsv', file('../data/pokemon.csv'));
                            
                            
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
                                        for($i=0;$i<(sizeof($csv)-1);$i++){
                                            
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
                                printCard($array[0][0],$array[0][1],$array[0][11],$array[0][2],$array[0][3],$array[0][5],$array[0][6],$array[0][7],$array[0][8],$array[0][9],$array[0][10]);
                                
                            }
                        }else{
                        echo "Errore i valori inseriti non sono validi";
                        }
                    }
                    
                    ?>
            </div>
        
    </section>
    <script src="../static/js/script.js"></script>
</body>

</html>