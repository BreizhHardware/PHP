<?php
    require_once('database.php');
    // Enable all warnings and errors.
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    // Database connection.
    $db = dbConnect();
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TP8-PHP-Marquet</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body class="m-3">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="citations.php">Infomations</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="recherche.php">Recherche</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="modification.php">Modification</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <form action="recherche.php" method="post">
        <div>
            <label for="auteur" class="form-label">Auteur</label>
            <select id="auteur" name="auteur" class="form-select">
                <option selected>Choisir un auteur</option>
                <?php
                    $authors = dbGetAuthorsNames($db);
                    foreach ($authors as $author) {
                        echo "<option>" . $author['nom'] . " " . $author['prenom'] . "</option>";
                    }
                ?>
            </select>
            <label for="siecle" class="form-label">Siècle</label>
            <select id="siecle" name="siecle" class="form-select">
                <option selected>Choisir un siècle</option>
                <?php
                    $centuries = dbGetCenturies($db);
                    foreach ($centuries as $century) {
                        echo "<option>" . $century['numero'] . "</option>";
                    }
                ?>
            </select>
            <br>
            <button type="submit" class="btn btn-primary">Rechercher</button>
        </div>
    </form>
    <?php
        if(isset($_POST['auteur']) && isset($_POST['siecle'])){
            $author = $_POST['auteur'];
            $century = $_POST['siecle'];
            displayQuoteByAuthorAndCentury($db, $author, $century);
        }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>