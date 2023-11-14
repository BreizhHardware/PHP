<?php
    echo "<title>TP3 - PHP - Marquet</title>";
    echo "<link rel='stylesheet' href='style.css'>";
    echo "<h1>TP2 - PHP - Marquet</h1>";
    echo "<hr>";
    echo "<h2>Exercice 1</h2>";
    function increment(){
        static $i = 0;
        $i++;
        echo $i;
    }
    increment();
    echo "<br>";
    increment();
    echo "<br>";
    increment();
    echo "<hr>";
    echo "<h2>Exercice 2</h2>";
    function modifVar(&$var){
        $var = 10;
    }
    $var = 5;
    echo "Avant : " . $var;
    echo "<br>";
    modifVar($var);
    echo "Après : " . $var;
    echo "<hr>";
    echo "<h2>Exercice 3</h2>";
    $identite = ['alain', 'basile', 'David', 'Edgar'];
    $age = [1, 15, 35, 65];
    $mail = ['penom_nom@gtail.be', 'truc@bruce.zo', 'caro@caramel.org', 'trop@monmel.fr'];
    function domaineExtension($mail){
        $domaine = substr($mail, strpos($mail, '@') + 1, strpos($mail, '.') - strpos($mail, '@') - 1);
        $extension = substr($mail, strpos($mail, '.') + 1);
        return array($domaine, $extension);
    }
    echo "Domaine et extension du mail penom_nom@gtail.be : " . domaineExtension($mail[0])[0] . " et " . domaineExtension($mail[0])[1];
    echo "<br>";
    echo "Domaine et extension du mail truc@bruce.zo : " . domaineExtension($mail[1])[0] . " et " . domaineExtension($mail[1])[1];
    echo "<br>";
    function affiche($identite, $age, $mail){
        $i = random_int(0, 3);
        echo "Bonjour " . ucfirst($identite[$i]) . ", vous avez " . $age[$i] . " ans et votre mail est " . $mail[$i];
    }
    affiche($identite, $age, $mail);
    echo "<hr>";
    echo "<h2>Exercice 4</h2>";
    function ligne(){
        for($i = 0; $i < 5; $i++){
            echo "*";
        }
        echo "<br>";
    }
    echo "ligne :";
    echo "<br>";
    ligne();
    echo "<br>";
    function carre_plein(){
        for($i = 0; $i < 5; $i++){
            ligne();
        }
    }
    echo "carre_plein :";
    echo "<br>";
    carre_plein();
    echo "<br>";
    function triangle_iso(){
        for($i = 1; $i < 6; $i++){
            for($j = 0; $j < $i; $j++){
                echo "*";
            }
            echo "<br>";
        }
    }
    echo "triangle_iso :";
    echo "<br>";
    triangle_iso();
    echo "<br>";
    function carre_vide(){
        for($i = 0; $i < 5; $i++){
            if($i == 0 || $i == 4){
                ligne();
            }
            else{
                echo "*";
                for($j = 0; $j < 3; $j++){
                    echo "&nbsp;&nbsp;";
                }
                echo "*";
                echo "<br>";
            }
        }
    }
    echo "carre_vide :";
    echo "<br>";
    carre_vide();
    echo "<br>";
    function triangle_vide(){
        for($i = 1; $i < 6; $i++){
            if($i == 1){
                echo "*";
                echo "<br>";
            }
            else if($i == 5){
                for($j = 0; $j < 5; $j++){
                    echo "*";
                }
                echo "<br>";
            }
            else{
                echo "*";
                for($j = 0; $j < $i - 2; $j++){
                    echo "&nbsp;&nbsp;";
                }
                echo "*";
                echo "<br>";
            }
        }
    }
    echo "triangle_vide :";
    echo "<br>";
    triangle_vide();
    echo "<br>";
    function triangle_vide_inv(){
        for($i = 1; $i < 6; $i++){
            if($i == 1){
                for($j = 0; $j < 5; $j++){
                    echo "*";
                }
                echo "<br>";
            }
            else if($i == 5){
                echo "*";
                echo "<br>";
            }
            else{
                echo "*";
                for($j = 0; $j < 5 - $i; $j++){
                    echo "&nbsp;&nbsp;";
                }
                echo "*";
                echo "<br>";
            }
        }
    }
    echo "triangle_vide_inv :";
    echo "<br>";
    triangle_vide_inv();
    echo "<br>";
    echo "<hr>";
    echo "<h2>Exercice 5</h2>";
    function chiffrement($message, $decalage){
        $message = strtoupper($message);
        $message = str_split($message);
        $messageChiffre = "";
        foreach($message as $lettre){
            if($lettre == " "){
                $messageChiffre .= " ";
            }
            else{
                $messageChiffre .= chr(ord($lettre) + $decalage);
            }
        }
        return $messageChiffre;
    }
    echo "Chiffrement de 'Je t'aime Cléo' avec un décalage de 3 : " . chiffrement("Je t'aime Cléo", 3);
    echo "<br>";
    function dechiphrement($message, $decalage){
        $message = strtoupper($message);
        $message = str_split($message);
        $messageDechiffre = "";
        foreach($message as $lettre){
            if($lettre == " "){
                $messageDechiffre .= " ";
            }
            else{
                $messageDechiffre .= chr(ord($lettre) - $decalage);
            }
        }
        return $messageDechiffre;
    }
    echo "Déchiffrement de 'MH W*DLPH FOƬR' avec un décalage de 3 : " . dechiphrement("MH W*DLPH FOƬR", 3);
    echo "<br>";
    echo "<hr>";
    echo "<h2>Exercice 6</h2>";
    function chiffrementViginere($message, $cle){
        $message = strtoupper($message);
        $message = str_split($message);
        $cle = strtoupper($cle);
        $cle = str_split($cle);
        $messageChiffre = "";
        $j = 0;
        foreach($message as $lettre){
            if($lettre == " "){
                $messageChiffre .= " ";
            }
            else{
                $messageChiffre .= chr(ord($lettre) + ord($cle[$j]) - 65);
                $j++;
                if($j == count($cle)){
                    $j = 0;
                }
            }
        }
        return $messageChiffre;
    }
    function dechiffrementViginere($message, $cle){
        $message = strtoupper($message);
        $message = str_split($message);
        $cle = strtoupper($cle);
        $cle = str_split($cle);
        $messageDechiffre = "";
        $j = 0;
        foreach($message as $lettre){
            if($lettre == " "){
                $messageDechiffre .= " ";
            }
            else{
                $messageDechiffre .= chr(ord($lettre) - ord($cle[$j]) + 65);
                $j++;
                if($j == count($cle)){
                    $j = 0;
                }
            }
        }
        return $messageDechiffre;
    }
    echo "Chiffrement de 'Je t'aime Cléo' avec la clé 'Cleo' : " . chiffrementViginere("Je t'aime Cléo", "Cleo");
    echo "<br>";
    echo "Déchiffrement de 'LP X5CTQS EWǷQ' avec la clé 'Cleo' : " . dechiffrementViginere("LP X5CTQS EWǷQ", "Cleo");
    echo "<br>";
    echo "<hr>";
    echo "<h2>Exercice 7</h2>";
    $annuaire=array(
        "PUJOL Olivier"=>"03 89 72 84 48",
        "IMBERT Jo"=>"03 89 36 06 05",
        "SPIEGEL Pierre"=>"03 87 67 92 37",
        "THOUVENOT Frédéric"=>"01 42 86 02 12",
        "MEGEL Pierre"=>"09 59 71 46 96",
        "SUCHET Loïc"=>"03 89 33 10 54",
        "GIROIS Francis"=>"03 88 01 21 15",
        "HOFFMANN Emmanuel"=>"03 89 69 20 05",
        "KELLER Fabien"=>"04 18 52 34 25",
        "LEY Jean-Marie"=>"03 89 43 17 85",
        "ZOELLE Thomas"=>"04 18 65 67 69",
        "WILHELM Olivier"=>"03 89 60 48 78",
        "BLIN Nathalie"=>"01 28 59 23 25",
        "BICARD Pierre-Eric"=>"03 89 69 25 82",
        "ZIEGLER Thierry"=>"03 89 06 33 89",
        "BADER Jean"=>"03 89 25 65 72",
        "ROSSO Anne-Sophie"=>"01 56 20 02 36",
        "ROTTNER Thierry"=>"03 88 29 61 54",
        "WEBER Joao"=>"03 89 35 45 20",
        "SCHILLINGER Olivier"=>"03 84 21 38 40",
        "BICARD Muriel"=>"03 89 33 47 99 ",
        "KELLER Christian"=>"03 88 19 16 10 ",
        "GROELLY Antonio"=>"03 89 33 60 63",
        "ALLARD Aline"=>"03 89 56 49 19",
        "WINNINGER Bénédicte"=>"04 16 14 86 66");
    function afficheAnnuaire($annuaire){
        ksort($annuaire);
        echo "<table>";
        echo "<tr>";
        echo "<th>Nom</th>";
        echo "<th>Numéro</th>";
        echo "</tr>";
        foreach($annuaire as $key => $value){
            echo "<tr>";
            echo "<td>" . $key . "</td>";
            echo "<td>" . $value . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    afficheAnnuaire($annuaire);
    echo "<hr>";
    echo "<h2>Exercice 8</h2>";
    function lampe($interrupteur1, $interrupteur2, $interrupteur3){
        if($interrupteur1 == true && $interrupteur2 == true && $interrupteur3 == true){
            echo "La lampe est allumée";
        }
        else if($interrupteur1 == true && $interrupteur2 == true && $interrupteur3 == false){
            echo "La lampe est éteinte";
        }
        else if($interrupteur1 == true && $interrupteur2 == false && $interrupteur3 == true){
            echo "La lampe est éteinte";
        }
        else if($interrupteur1 == true && $interrupteur2 == false && $interrupteur3 == false){
            echo "La lampe est allumée";
        }
        else if($interrupteur1 == false && $interrupteur2 == true && $interrupteur3 == true){
            echo "La lampe est éteinte";
        }
        else if($interrupteur1 == false && $interrupteur2 == true && $interrupteur3 == false){
            echo "La lampe est allumée";
        }
        else if($interrupteur1 == false && $interrupteur2 == false && $interrupteur3 == true){
            echo "La lampe est allumée";
        }
        else if($interrupteur1 == false && $interrupteur2 == false && $interrupteur3 == false){
            echo "La lampe est éteinte";
        }
    }
    echo "Lampe avec les interrupteurs 1, 2 et 3 allumés : ";
    lampe(true, true, true);
    echo "<br>";
    echo "<hr>";
    echo "<h2>Exercice 9</h2>";
    $clients = ["1"=>"Dulong","ville 1"=>"Paris","age 1"=>"35",
    "2"=>"Leparc","ville 2"=>"Lyon","age 2"=>"47",
    "3"=>"Dubos","ville 3"=>"Tours","age 3"=>"58"];
    $clients["4"] = "Duval";
    $clients["ville 4"] = "Nantes";
    $clients["age 4"] = "24";
    function afficheClient($client){
        echo "<table>";
        echo "<tr>";
        echo "<th>Numéro</th>";
        echo "<th>Nom</th>";
        echo "<th>Ville</th>";
        echo "<th>Age</th>";
        echo "</tr>";
        for($i = 1; $i <= count($client) / 3; $i++){
            echo "<tr>";
            echo "<td>" . $i . "</td>";
            echo "<td>" . $client[$i] . "</td>";
            echo "<td>" . $client["ville " . $i] . "</td>";
            echo "<td>" . $client["age " . $i] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } 
    afficheClient($clients);
    echo "<hr>";
    echo "<h2>Exercice 10</h2>";
    function estPalindrome($mot){
        $mot = strtoupper($mot);
        $mot = str_split($mot);
        $motInverse = array_reverse($mot);
        $motInverse = implode("", $motInverse);
        if(implode("", $mot) == $motInverse){
            echo "Oui";
        }
        else{
            echo "Non";
        }
    }
    echo "Est-ce que 'radar' est un palindrome ? ";
    estPalindrome("radar");
    echo "<br>";
    echo "Est-ce que 'radars' est un palindrome ? ";
    estPalindrome("radars");
    echo "<hr>";
    echo "<h2>Exercice 11</h2>";
    //Ecrire une fonction qui vérifie si un numéro de carte bancaire est valide ou pas. Pour cela, il est demandé de se baser sur la formule de Luhn (https://fr.wikipedia.org/wiki/Formule_de_Luhn)
    function estValide($numero){
        $numero = str_split($numero);
        $somme = 0;
        for($i = 0; $i < count($numero); $i++){
            if($i % 2 == 0){
                $numero[$i] *= 2;
                if($numero[$i] > 9){
                    $numero[$i] -= 9;
                }
            }
            $somme += $numero[$i];
        }
        if($somme % 10 == 0){
            echo "Oui";
        }
        else{
            echo "Non";
        }
    }
    echo "Est-ce que '4970100000000000' est un numéro de carte bancaire valide ? ";
    estValide("4970100000000000");
    echo "<br>";
    echo "Est-ce que '5130240038105643' est un numéro de carte bancaire valide ? ";
    estValide("5130240038105643");
?>