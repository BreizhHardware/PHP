<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>TP5 - PHP - Marquet</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>TP5 - PHP - Marquet</h1>
    <hr>
    <h2>Exercice 1</h2>
    <form action="TP5-PHP-Marquet.php" method="post">
        <label for="fahrenheit">Température en Fahrenheit : </label>
        <input type="number" name="fahrenheit" id="fahrenheit">
        <input type="submit" value="Convertir">
    </form>
    <?php
        if(isset($_POST['fahrenheit'])){
            $fahrenheit = $_POST['fahrenheit'];
            $celsius = ($fahrenheit - 32) * 5 / 9;
            echo $fahrenheit . "°F = " . $celsius . "°C";
        }
    ?>
    <form action="TP5-PHP-Marquet.php" method="get">
        <label for="fahrenheit">Température en Fahrenheit : </label>
        <input type="number" name="fahrenheit" id="fahrenheit">
        <input type="submit" value="Convertir">
    </form>
    <?php
        if(isset($_GET['fahrenheit'])){
            $fahrenheit = $_GET['fahrenheit'];
            $celsius = ($fahrenheit - 32) * 5 / 9;
            echo $fahrenheit . "°F = " . $celsius . "°C";
        }
    ?>
    <hr>
    <h2>Exercice 2</h2>
    <form action="TP5-PHP-Marquet.php" method="post">
        <label for="Nom">Nom : </label>
        <input type="text" name="Nom" id="Nom">
        <label for="Prenom">Prénom : </label>
        <input type="text" name="Prenom" id="Prenom">
        <label for="Niveau">Niveau : </label>
        <input type="radio" name="Débutant" id="Débutant">
        <input type="radio" name="Avancé" id="Avancé">
        <input type="button" value="Envoyer">
    </form>
    <?php
        if(isset($_POST['Nom']) && isset($_POST['Prenom']) && isset($_POST['Niveau'])){
            $nom = $_POST['Nom'];
            $prenom = $_POST['Prenom'];
            $niveau = $_POST['Niveau'];
            echo "Nom : " . $nom . "<br>Prénom : " . $prenom . "<br>Niveau : " . $niveau;
        }
    ?>
</html>