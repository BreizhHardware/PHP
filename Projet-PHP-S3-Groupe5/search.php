<!DOCTYPE html>
<html lang="fr">
 <head>
   <meta charset="utf-8">
   <title> Recherche </title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Just+Me+Again+Down+Here&family=Open+Sans&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="src/css/styles.css">
   <link rel="icon" href="src/img/favicon.png" type="image/x-icon"/>
     <?php
        require('src/php/db/dbconnect.php');
        require('src/php/constants.php');
         require('src/php/components/token.php');
         require('src/php/components/check.php');
         require('src/php/components/user-login.php');
         require('src/php/db/Patient.php');
         require('src/php/db/Medecin.php');
        require ('src/php/db/Search.php');
        ini_set('display_errors', 1);
        error_reporting(E_ALL);
        $pdo = dbConnect();
     ?>
 </head>
 <body>
     <div id="topbar" class="d-flex justify-content-between flex-row">
         <div>
             <a href="index.php">
                 <p id="DoctISEN">
                     Doct'ISEN
                 </p>
             </a>
         </div>
         <div class="d-flex flex-row align-items-center gap-3 me-2">
             <div class="d-flex flex-row align-items-center gap-3 me-2">
                 <?php
                 loginUI($pdo);
                 ?>
             </div>
         </div>
     </div>
     <div id="searchbar">
         <form class="input-group p-5" action="search.php" method="post">
             <input type="text" aria-label="First name" class="form-control" id="nom" name="nom" placeholder="Nom, spécialité">
             <input type="text" aria-label="Last name" class="form-control" id="postal" name="postal" placeholder="Où ?">
             <button class="btn btn-danger" type="submit" id="button-addon2">Rechercher</button>
         </form>
     </div>
     <?php
        search($pdo, $_POST['nom'], $_POST['postal']);
     ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
 </body>
</html>