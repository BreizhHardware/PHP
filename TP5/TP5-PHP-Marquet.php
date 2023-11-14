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
    <form action="TP5-PHP-Marquet.php" method="get">
        <label for="Nom">Nom : </label>
        <input type="text" name="Nom" id="Nom">
        <label for="Prenom">Prénom : </label>
        <input type="text" name="Prenom" id="Prenom">
        <label for="Niveau">Niveau : </label>
        <label for="Niveau">Débutant</label>
        <input type="radio" name="Niveau" id="Niveau" value="Débutant">
        <label for="Niveau">Intermédiaire</label>
        <input type="radio" name="Niveau" id="Niveau" value="Intermédiaire">
        <input type="submit" value="Effacer">
        <input type="submit" value="Envoyer">
    </form>
    <?php
        //Le bouton Effacer vide le formulaire
        if(isset($_GET['Nom']) && isset($_GET['Prenom']) && isset($_GET['Niveau'])){
            /*
            $nom = $_GET['Nom'];
            $prenom = $_GET['Prenom'];
            $niveau = $_GET['Niveau'];
            echo "Bonjour " . $prenom . " " . $nom . ". Vous avez un niveau " . $niveau;
            */
            echo "Bonjour " . $_GET['Prenom'] . " " . $_GET['Nom'] . ". Vous avez un niveau " . $_GET['Niveau'];
        }
    ?>
    <hr>
    <h2>Exercice 3</h2>
    <form action="TP5-PHP-Marquet.php"  method="get">
        <label for="Nom">Nom : </label>
        <input type="text" name="Nom" id="Nom">
        <label for="Prenom">Prénom : </label>
        <input type="text" name="Prenom" id="Prenom">
        <label for="Age">Age : </label>
        <input type="text" name="Age" id="Age">
        <br>
        <label for="Langue">Langue pratiquées (choisir 2 au minimum) : </label>
        <br>
        <select name="Langue[]" id="Langue" multiple>
            <option value="Français">Français</option>
            <option value="Anglais">Anglais</option>
            <option value="Espagnol">Espagnol</option>
            <option value="Allemand">Allemand</option>
            <option value="Italien">Italien</option>
        </select>
        <br>
        <label for="Competance">Compétences informatiques (choisir minimum 2) : </label>
        <br>
        <input type="checkbox" name="Competance[]" id="Competance" value="HTML">
        <label for="Competance">HTML</label>
        <input type="checkbox" name="Competance[]" id="Competance" value="CSS">
        <label for="Competance">CSS</label>
        <input type="checkbox" name="Competance[]" id="Competance" value="PHP">
        <label for="Competance">PHP</label>
        <input type="checkbox" name="Competance[]" id="Competance" value="SQL">
        <label for="Competance">SQL</label>
        <input type="checkbox" name="Competance[]" id="Competance" value="C">
        <label for="Competance">C</label>
        <input type="checkbox" name="Competance[]" id="Competance" value="C++">
        <label for="Competance">C++</label>
        <input type="checkbox" name="Competance[]" id="Competance" value="JS">
        <label for="Competance">JS</label>
        <input type="checkbox" name="Competance[]" id="Competance" value="Python">
        <label for="Competance">Python</label>
        <br>
        <input type="submit" value="Effacer">
        <input type="submit" value="Envoyer">
    </form>
    <?php
        if(isset($_GET['Nom']) && isset($_GET['Prenom']) && isset($_GET['Age']) && isset($_GET['Langue']) && isset($_GET['Competance'])){
            echo "Bonjour " . $_GET['Prenom'] . " " . $_GET['Nom'] . ". Vous avez " . $_GET['Age'] . " ans. Vous parlez ";
            foreach($_GET['Langue'] as $langue){
                echo $langue . " ";
            }
            echo ". Vous avez des compétences en ";
            foreach($_GET['Competance'] as $competance){
                echo $competance . " ";
            }
        }
    ?>
    <hr>
    <h2>Exercice 4</h2>
    <form action="TP5-PHP-Marquet.php" method="post">
        <label for="NB1">Nombre 1 : </label>
        <input type="number" name="NB1" id="NB1">
        <br>
        <label for="NB2">Nombre 2 : </label>
        <input type="number" name="NB2" id="NB2">
        <br>
        <label for="Resultat">Résultat : </label>
        <input type="number" name="Resultat" id="Resultat" disabled>
        <br>
        <label for="Operation">Opération : </label>
        <input type="submit" name="Operation" id="Operation" value="Addition">
        <input type="submit" name="Operation" id="Operation" value="Soustraction">
        <input type="submit" name="Operation" id="Operation" value="Multiplication">
        <input type="submit" name="Operation" id="Operation" value="Division">
    </form>
    <?php
        if(isset($_POST['NB1']) && isset($_POST['NB2']) && isset($_POST['Operation'])){
            $nb1 = $_POST['NB1'];
            $nb2 = $_POST['NB2'];
            $operation = $_POST['Operation'];
            switch($operation){
                case "Addition":
                    $resultat = $nb1 + $nb2;
                    break;
                case "Soustraction":
                    $resultat = $nb1 - $nb2;
                    break;
                case "Multiplication":
                    $resultat = $nb1 * $nb2;
                    break;
                case "Division":
                    $resultat = $nb1 / $nb2;
                    break;
            }
            echo "<script>document.getElementById('Resultat').value = " . $resultat . "</script>";
        }
    ?>
    <hr>
    <h2>Exercice 5</h2>
    <form action="TP5-PHP-Marquet.php" method="post">
        <label for="File1">Fichier 1 : </label>
        <input type="file" name="File1" id="File1">
        <br>
        <label for="File2">Fichier 2 : </label>
        <input type="file" name="File2" id="File2">
        <br>
        <button type="submit" name="Envoyer" id="Envoyer">Envoyer</button>
    </form>
    <!-- Pour chaque fichier, affichez l'image ainsi que les informations associées dans un tableau-->
    <?php
        if(isset($_POST['Envoyer'])){
            $file1 = $_FILES['File1'];
            $file2 = $_FILES['File2'];
            echo "<table>";
            echo "<tr><th>Fichier 1</th><th>Fichier 2</th></tr>";
            echo "<tr><td><img src='" . $file1['tmp_name'] . "' alt='" . $file1['name'] . "'></td><td><img src='" . $file2['tmp_name'] . "' alt='" . $file2['name'] . "'></td></tr>";
            echo "<tr><td>Nom : " . $file1['name'] . "</td><td>Nom : " . $file2['name'] . "</td></tr>";
            echo "<tr><td>Type : " . $file1['type'] . "</td><td>Type : " . $file2['type'] . "</td></tr>";
            echo "<tr><td>Taille : " . $file1['size'] . "</td><td>Taille : " . $file2['size'] . "</td></tr>";
            echo "<tr><td>Chemin temporaire : " . $file1['tmp_name'] . "</td><td>Chemin temporaire : " . $file2['tmp_name'] . "</td></tr>";
            echo "<tr><td>Erreur : " . $file1['error'] . "</td><td>Erreur : " . $file2['error'] . "</td></tr>";
            echo "</table>";
        }
    ?>
    <hr>
    <h2>Exercice </h2>

</html>