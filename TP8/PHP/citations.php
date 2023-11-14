<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TP8-PHP-Marquet</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="citations.php">Infomations</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="recherche.php">Recherche</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="modification.php">Modification</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <h1> La citation du jour </h1>
    <hr>
    <?php
    require_once('database.php');
    // Enable all warnings and errors.
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    // Database connection.
    $db = dbConnect();
    ?>
    <p> Il y'a
        <?php
        // Number of Quotes
        $nbQuotes = getNumberofQuotes($db);
        echo "<b> $nbQuotes </b>";
        ?>
        citations répértoriées </p>
    <p> Et voici l'une d'entre elle générée aléatoirement: </p>
    <?php
        randomQuote($db);
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>