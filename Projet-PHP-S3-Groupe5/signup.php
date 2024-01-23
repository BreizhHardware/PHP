<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title> Connexion </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"><link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Just+Me+Again+Down+Here&family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="src/css/styles.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="src/js/signup.js" defer></script>
    <link rel="icon" href="src/img/favicon.png" type="image/x-icon"/>
</head>
<?php
require('src/php/db/dbconnect.php');
require('src/php/constants.php');
require('src/php/db/Signup.php');
ini_set('display_errors', 1);
error_reporting(E_ALL);
$pdo = dbConnect();
session_start();
?>
 <body style="background-color: #EEF2F7">
 <div id="topbar">
     <a href="index.php">
         <p id="DoctISEN" class="top-0">
             Doct'ISEN
         </p>
     </a>
 </div>

 <div class="signInSecondaryCard p-3 m-0 border-0 bd-example m-0 border-0 text-center justify-content-center mt-5">
     <div class="dropdown-menu text-center align-content-center">
         <h5 class="fw-bold">J'ai déjà un compte Doct'ISEN?</h5>
         <a href="login.php" class="">
             <button class="btn btn-danger logButton">Se connecter</button>
         </a>
     </div>
 </div>

 <div class="SignInPrimaryCard p-3 m-0 border-0 bd-example m-0 border-0 text-center justify-content-center">
     <div class="loginInsideCard dropdown-menu">
         <h5 class="text-center fw-bold">Nouveau sur Doct'ISEN ?</h5>
         <form class="px-4 py-3" method="post">
             <div class="align-content-center">
             <div class="mb-3">
                 <label for="Name" class="form-label align-baseline">Nom</label>
                 <input type="text" class="form-control" id="Name" name="name" placeholder="Veuillez mettre votre nom">
             </div>
             <div class="mb-3">
                 <label for="FirstName" class="form-label">Prénom</label>
                 <input type="text" class="form-control" id="FirstName" name="surname" placeholder="Veuillez mettre votre prénom">
             </div>
             <div class="mb-3">
                 <label for="Num" class="form-label">Numéro de téléphone</label>
                 <input type="tel" pattern="[0-9]{10}" class="form-control" id="Num" name="phone" placeholder="Numéro de téléphone">
             </div>
             <div class="mb-3">
                 <label for="mail" class="form-label">Email address</label>
                 <input type="email" class="form-control" id="mail" name="mail" placeholder="email@example.com">
             </div>
             <div class="mb-3">
                 <label for="mailConfirmation" class="form-label">Email address confirmation</label>
                 <input type="email" class="form-control" id="mailConfirmation" name="mailConfirmation" placeholder="email@example.com">
                 <p class="text-danger fw-bold" id="mail-error"></p>
             </div>
             <div class="mb-3">
                 <label for="password" class="form-label">Password</label>
                 <input type="password" class="form-control" id="password" name="password" placeholder="Password">
             </div>
             <div class="mb-3">
                 <label for="passwordConfirmation" class="form-label">Password Confirmation</label>
                 <input type="password" class="form-control" id="passwordConfirmation" name="passwordConfirmation" placeholder="Password">
                 <p class="text-danger fw-bold" id="password-error"></p>
             </div>
             <div class="align-content-center text-center ">
                 <button type="submit" class="btn btn-danger logButton disabled" id="signupButton">Se connecter</button>
             </div>
         </form>
         <?php
         if(!empty($_POST['mail']) && !empty($_POST['password']) && !empty($_POST['name']) && !empty($_POST['surname']) && !empty($_POST['phone']) && !empty($_POST['password']) && !empty($_POST['passwordConfirmation']) && !empty($_POST['mailConfirmation'])){
             $mail = ($_POST["mail"]);
             $password = ($_POST["password"]);
             $name = ($_POST["name"]);
             $surname = ($_POST["surname"]);
             $phone = ($_POST["phone"]);
             if(SignupPatient::Insert($pdo,$name,$surname,$mail,$password,$phone)){
                 error_log("Signup success");
                 $_SESSION['id'] = $mail;
                 echo '<meta http-equiv="refresh" content="0;url=index.php">';
             } else {
                 error_log('Erreur de connexion');
             }
         }
         else{
             error_log('Erreur de connexion');
         }
         ?>
     </div>
 </div>


 </body>
</html>