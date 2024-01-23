<!DOCTYPE html>
<html lang="fr">
 <head>
   <meta charset="utf-8">
   <title> Acceuil </title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Just+Me+Again+Down+Here&family=Open+Sans&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="src/css/styles.css">
   <link rel="icon" href="src/img/favicon.png" type="image/x-icon"/>
 </head>
 <body>
 <?php
        require('src/php/db/dbconnect.php');
        require('src/php/db/Patient.php');
        require('src/php/db/Medecin.php');
        require('src/php/constants.php');
        require('src/php/components/check.php');
        require('src/php/components/token.php');
        require('src/php/components/user-login.php');
        
        ini_set('display_errors', 1);
        error_reporting(E_ALL);
        session_start();
        $pdo = dbConnect();
 ?>
    <div id="acceuil">
        <a href="index.php">
            <p id="DoctISEN" class="top-0">
                Doct'ISEN
            </p>
        </a>
        <div class="d-flex position-fixed end-0 flex-row align-items-center gap-3 mt-2 top-0">
            <?php
                loginUI($pdo);
            ?>
        </div>
        <div id="rdv">
            <p class="text-white fw-bold fs-3">Trouvez un rendez vous avec un medecin</p>
            <form action="search.php" class="input-group" method="post">
                <input type="text" aria-label="First name" class="form-control" id="nom" name="nom" placeholder="Nom, spécialité">
                <input type="text" aria-label="Last name" class="form-control" id="postal" name="postal" placeholder="Où ?">
                <button class="btn btn-success" type="submit" id="button-addon2">Rechercher</button>
            </form>
        </div>
        <img src="src/img/img_index.png" alt="img_index" id="img_index">
        <div class="d-flex justify-content-center gap-5 w-100" id="cardPos">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Information</h5>
                    <h6 class="card-subtitle mb-2 text-body-secondary">Ligue contre le cancer</h6>
                    <p class="card-text">Mois sans tabac: c’est le moment d’arrêter !</p>
                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Information</h5>
                    <h6 class="card-subtitle mb-2 text-body-secondary">Pharmacie Sanchez</h6>
                    <p class="card-text">Le rôle du phramacien évolue: Venez nous voir.</p>
                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Information</h5>
                    <h6 class="card-subtitle mb-2 text-body-secondary">Doct’ISEN</h6>
                    <p class="card-text">Un empechement: Prevenez votre soignant.</p>
                </div>
            </div>
        </div>
        <footer class="fixed-bottom m-2 mx-4">
            <p>Recherche de praticiens</p>
            <p>Doct’ISEN, 33 QUATER Av. du Champ de Manœuvre, 44470 Carquefou</p>
            <p class="text-secondary">Conditions générales d'utilisation • Conditions d'utilisation du site Doct'ISEN • Politique relative à la protection des données personnelles • Politique en matière de cookies • Gestion des cookies et consentement • Règles de référencement • Mentions légales</p>
            <p class="text-secondary">Annuaire des médecins du CNOM • Annuaire des chirurgiens-dentistes de l'ONCD • Ordre National des Médecins • Ordre National des Chirurgiens-Dentistes</p>
        </footer>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
 </body>
</html>