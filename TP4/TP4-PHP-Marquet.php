<?php
    echo "<title>TP4 - PHP - Marquet</title>";
    echo "<link rel='stylesheet' href='style.css'>";
    echo "<h1>TP4 - PHP - Marquet</h1>";
    setlocale(LC_TIME, 'fr_FR.utf8', 'fr_FR', 'fr', 'fra', 'french');
    echo "<hr>";
    echo "<h2>Exercice 1</h2>";
    $date = new DateTime();
    echo "<strong>EN :</strong> " . $date->format('l d F Y') . "<br>";
    echo "<strong>FR :</strong> " . strftime('%A %d %B %Y') . "<br>";
    echo "<strong>Date et heure :</strong> " . $date->format('d/m/Y H:i') . "<br>";
    echo "Il est passé " . $date->getTimestamp() . " secondes depuis l'apparition d'UNIX";
    echo "<hr>";
    echo "<h2>Exercice 2</h2>";
    $dateNaissance = new DateTime('2004-03-12');
    $dateActuelle = new DateTime();
    $interval = $dateNaissance->diff($dateActuelle);
    echo "Date de naissance : " . $dateNaissance->format('d/m/Y') . "<br>";
    echo "Date actuelle : " . $dateActuelle->format('d/m/Y') . "<br>";
    echo "Age : " . $interval->format('%y ans, %m mois et %d jours');
    echo "<hr>";
    echo "<h2>Exercice 3</h2>";
    $dateLune = new DateTime('2023-09-29 11:59:00');
    $dateActuelle = new DateTime();
    $dateProchaineLune = $dateLune->add(new DateInterval('P29DT12H44M3S'));    
    $interval = $dateActuelle->diff($dateProchaineLune);
    echo "Date de la prochaine pleine lune : " . $dateProchaineLune->format('d/m/Y H:i:s') . "<br>";
    $dateCentiemeLune = $dateLune->add(new DateInterval('P2900DT1200H4400M300S'));
    echo "Date de la 100ème prochaine pleine lune : " . $dateCentiemeLune->format('d/m/Y H:i:s') . "<br>";
    echo "Il reste " . $interval->format('%d jours, %h heures, %i minutes et %s secondes') . " avant la prochaine pleine lune";
    echo "<hr>";
    echo "<h2>Exercice 4</h2>";
    if(checkdate(2, 29, 1962)){
        echo "La date du 29 février 1962 a existé";
    }
    else{
        echo "La date du 29 février 1962 n'a pas existé";
    }
    echo "<hr>";
    echo "<h2>Exercice 5</h2>";
    $date = mktime(0, 0, 0, 3, 3, 1993);
    echo "Le 3 mars 1993 était un " . strftime('%A', $date);
    echo "<hr>";
    echo "<h2>Exercice 6</h2>";
    echo "Les années bissextiles entre 2020 et 2062 sont : <br>";
    for($i = 2020; $i <= 2062; $i++){
        $date = mktime(0, 0, 0, 2, 29, $i);
        if(checkdate(2, 29, $i)){
            echo $i . "<br>";
        }
    }
    echo "<hr>";
    echo "<h2>Exercice 7</h2>";
    echo "Les 1er mai entre 2022 et 2031 sont : <br>";
    for($i = 2022; $i <= 2031; $i++){
        $date = mktime(0, 0, 0, 5, 1, $i);
        if(strftime('%A', $date) == "samedi" || strftime('%A', $date) == "dimanche"){
            echo "Le 1er mai " . $i . " est un " . strftime('%A', $date) . " donc weekend non prolongé <br>";
        }
        else{
            if(strftime('%A', $date) == "vendredi" || strftime('%A', $date) == "lundi"){
                echo "Le 1er mai " . $i . " est un " . strftime('%A', $date) . " donc weekend prolongé <br>";
            }
            else{
                echo "Le 1er mai " . $i . " est un " . strftime('%A', $date) . " donc weekend non prolongé <br>";
            }
        }
    }
?>