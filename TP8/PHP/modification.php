<?php
    require_once('database.php');
    // Enable all warnings and errors.
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    // Database connection.
    $db = dbConnect();

    if(isset($_GET['submitAdd'])){
        checkIfFormIsSubmit($db);
    }

    if(isset($_GET['submitDelete'])){
        deleteQuoteFromDb($db, $_GET['quotes']);
    }

?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TP8-PHP-Marquet</title>
    <link rel="icon" href="ISEN-Nantes.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="citations.php">Infomations</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="recherche.php">Recherche</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="modification.php">Modification</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- When this form is submitted call the addQuotesToDb function -->
    <form action="modification.php" method="get" class="m-3">
        <h1>Ajout</h1>
        <div clas="mb-3">
            <label for="AuthorName" class="form-label">Nom de l'auteur</label>
            <input type="text" class="form-control" id="AuthorName" name="AuthorName">
        </div>
        <div class="mb-3">
            <label for="AuthorFirstName" class="form-label">Prénom de l'auteur</label>
            <input type="text" class="form-control" id="AuthorFirstName" name="AuthorFirstName">
        </div>
        <div class="mb-3">
            <label for="Century" class="form-label">Siècle</label>
            <input type="number" class="form-control" id="Century" name="Century">
        </div>
        <div class="mb-3">
            <label for="Quote" class="form-label">Citation</label>
            <input type="text" class="form-control" id="Quote" name="Quote">
        </div>
        <button type="submit" name="submitAdd" class="btn btn-secondary">Ajouter</button>
    </form>
    <form action="modification.php" method="get" class="m-3">
        <h1>Suppression</h1>
        <div class="mb-3">
            <select id="quotes" name="quotes" class="form-select">
                <option selected>Selectionnez l'ID d'une citation</option>
                <?php
                    $quotes = dbGetQuotesID($db);
                    foreach ($quotes as $quote) {
                        echo "<option>" . $quote['id'] . "</option>";
                    }
                ?>
            </select>
        </div>
        <button type="submit" name="submitDelete" class="btn btn-secondary">Supprimer</button>
    </form>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>