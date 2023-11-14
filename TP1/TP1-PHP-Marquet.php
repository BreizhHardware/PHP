<?php
    echo "<title>TP1 - PHP - Marquet</title>";
    echo "<h1>TP1 - PHP - Marquet</h1>";
    echo "<hr>";
    echo "<h2>Exercice 1</h2>";
    $citation = 'Citation de Coluche';
    $citation = strtoupper($citation);
    echo "<p><i>J'ai l'esprit large et je n'admets pas qu'on dise le contraire.</i> <b>$citation</b></p>";
    echo "<hr>";
    echo "<h2>Exercice 2</h2>";
    if(isset($citatio)){
        echo "La variable citatio existe";
    }
    else{
        echo "La variable citatio n'existe pas";
    }
    echo "<br>";
    if(isset($citation)){
        echo "La variable citation existe";
    }
    else{
        echo "La variable citation n'existe pas";
    }
    echo "<hr>";
    echo "<h2>Exercice 3</h2>";
    print_r($_SERVER);
    print_r($_GLOBALS);
    echo "<hr>";
    echo "<h2>Exercice 4</h2>";
    ini_set('display_errors', 1);
    echo ini_get('display_errors');
?>