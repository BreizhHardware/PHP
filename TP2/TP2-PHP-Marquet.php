<?php
    echo "<title>TP2 - PHP - Marquet</title>";
    echo "<link rel='stylesheet' href='style.css'>";
    echo "<h1>TP2 - PHP - Marquet</h1>";
    echo "<hr>";
    echo "<h2>Exercice 1</h2>";
    $age = random_int(0, 100);
    echo "L'age de la personne est de : " . $age . " ans";
    echo "<br>";
    echo "Version if : ";
    if(($age) >= 70){
        echo "La personne est agé";
    }
    else if(($age) >= 50){
        echo "La personne est un sénior";
    }
    else if(($age) >= 20){
        echo "La personne est un adulte";
    }
    else{
        echo "La personne est un enfant";
    }
    echo "<br>";
    echo "Version switch : ";
    switch($age){
        case ($age >= 70):
            echo "La personne est agé";
            break;
        case ($age >= 50):
            echo "La personne est un sénior";
            break;
        case ($age >= 20):
            echo "La personne est un adulte";
            break;
        default:
            echo "La personne est un enfant";
            break;
    }
    echo "<hr>";
    echo "<h2>Exercice 2</h2>";
    $Fibo0 = 0;
    $Fibo1 = 1;
    $Fibo2 = 0;
    $i = 0;
    $tabFibo = array();
    echo "Suite de Fibonacci : ";
    while($i < 20){
        $Fibo2 = $Fibo0 + $Fibo1;
        $Fibo0 = $Fibo1;
        $Fibo1 = $Fibo2;
        $tabFibo[$i] = $Fibo2;
        $i++;
    }
    echo "<table border=1>";
    echo "<tr>";
    for($i = 0; $i < 20; $i++){
        echo "<td>F" . $i . "</td>";
    }
    echo "</tr>";
    echo "<tr>";
    for($i = 0; $i < 20; $i++){
        echo "<td>" . $tabFibo[$i] . "</td>";
    }
    echo "</tr>";
    echo "</table>";
    echo "Fn+1 / Fn";
    $Fibo0 = 0;
    $Fibo1 = 1;
    $Fibo2 = 0;
    $i = 0;
    $tabFibo2 = array();
    do{
        $Fibo2 = $Fibo0 + $Fibo1;
        $Fibo0 = $Fibo1;
        $Fibo1 = $Fibo2;
        $tabFibo2[$i] = $Fibo2 / $Fibo0;
        $i++;
    }while($i < 30);
    echo "<table border=1>";
    echo "<tr>";
    for($i = 0; $i < 30; $i++){
        echo "<td>F" . $i . "</td>";
    }
    echo "</tr>";
    echo "<tr>";
    for($i = 0; $i < 30; $i++){
        echo "<td>" . $tabFibo2[$i] . "</td>";
    }
    echo "</tr>";
    echo "</table>";
    echo "<hr>";
    echo "<h2>Exercice 3</h2>";
    $pi = 0;
    echo "Pi (15 iterations) = ";
    for($i = 1; $i <= 15; $i++){
        $pi += 1/($i**2);
    }
    $pi = sqrt($pi*6);
    echo $pi;
    echo "<br>";
    echo "Pi (150 iterations) = ";
    $pi = 0;
    for($i = 1; $i <= 150; $i++){
        $pi += 1/($i**2);
    }
    $pi = sqrt($pi*6);
    echo $pi;
    echo "<br>";
    echo "Pi (1500 iterations) = ";
    $pi = 0;
    for($i = 1; $i <= 1500; $i++){
        $pi += 1/($i**2);
    }
    $pi = sqrt($pi*6);
    echo $pi;
    echo "<br>";
    echo "Pi (15000 iterations) = ";
    $pi = 0;
    for($i = 1; $i <= 15000; $i++){
        $pi += 1/($i**2);
    }
    $pi = sqrt($pi*6);
    echo $pi;
    echo "<br>";
    echo "<hr>";
    echo "<h2>Exercice 4</h2>";
    echo "<h3>a/</h3>";
    $tabCita = array("Forest Gump" => "La vie c'est comme une boîte de chocolats, on ne sait jamais sur quoi on va tomber.",
                    "Albert Einstein" => "L'informatique est la seule science où plus nous faisons de progrès, plus le problème reste le même.",
                    "R. W. Hamming" => "Le véritable enjeu de l'informatique n'est pas de savoir comment traiter l'information, mais comment utiliser l'information pour comprendre le monde.",
                    "Nicholas Negroponte" => "L'informatique est une discipline étrange. À chaque fois que vous résolvez un problème, un nouveau apparaît.",
                    "Danny Hillis" => "L'informatique est le seul domaine d'ingénierie où les ingénieurs travaillent principalement avec des matériaux qu'ils ne comprennent pas vraiment : l'électricité et les idées.");
    foreach($tabCita as $key => $value){
        echo "$value <br>";
    }
    echo "<h3>b/</h3>";
    foreach($tabCita as $key => $value){
        echo "$key => $value <br>";
    }
    echo "<hr>";
    echo "<h2>Exercice 5</h2>";
    $nb = random_int(0, 10);
    echo "<table border=1'><thead><tr><th style='border: 1px solid #333;' colspan='2'>Table de $nb</th></tr></thead><tbody>";
    for ($i=1;$i<11;$i++){
        echo "<tr><td style='border: 1px solid #333;'>$i*$nb</td><td style='border: 1px solid #333;'>".($i*$nb)."</td></tr>";
    }
    echo "</tbody></table>";
    echo "<hr>";
    echo "<h2>Exercice 6</h2>";
    $nb = 2;
    $nbPremier = true;
    while($nb <= 97){
        $nbPremier = true;
        for($i = 2; $i < $nb; $i++){
            if($nb % $i == 0){
                $nbPremier = false;
            }
        }
        if($nbPremier){
            echo $nb . " ";
        }
        $nb++;
    }
    echo "<hr>";
    echo "<h2>Exercice 7</h2>";
    $taille = 5;
    $unite = "T";
    echo "Taille : " . $taille . $unite . " = ";
    switch($unite){
        case "K":
            $taille = $taille * 1024;
            break;
        case "M":
            $taille = $taille * 1024 * 1024;
            break;
        case "G":
            $taille = $taille * 1024 * 1024 * 1024;
            break;
        case "T":
            $taille = $taille * 1024 * 1024 * 1024 * 1024;
            break;
    }
    echo $taille;
    echo "octets";
    echo "<iframe src='../info.php' width='100%' height='100%'></iframe>";
?>