<!DOCTYPE html>
<html lang="fr">
 <head>
   <meta charset="utf-8">
   <title> Login </title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"><link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Just+Me+Again+Down+Here&family=Open+Sans&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="src/css/styles.css">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
   <link rel="icon" href="src/img/favicon.png" type="image/x-icon"/>
 </head>
 <?php
        require('src/php/db/dbconnect.php');
        require('src/php/constants.php');
        require('src/php/db/Login.php');
        ini_set('display_errors', 1);
        error_reporting(E_ALL);
        session_start();
        $pdo = dbConnect();
 ?>
 <body style="background-color: #EEF2F7">
 <div id="topbar">
     <a href="index.php">
         <p id="DoctISEN" class="top-0">
             Doct'ISEN
         </p>
     </a>
 </div>

 <div class="h-100 d-flex flex-column gap-0 justify-content-center text-center w-50 mx-6">
     <div class="p-3 m-0 border-0 bd-example m-0 border-0">
         <div class="loginInsideCard dropdown-menu">
             <h5 class="text-center fw-bold">J'ai déjà un compte Doct'ISEN</h5>
             <form class="px-4 py-3" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                 <div>
                 <div class="mb-3">
                     <label for="exampleDropdownFormEmail1" class="form-label">Email address</label>
                     <input type="email" class="form-control" id="exampleDropdownFormEmail1" placeholder="email@example.com" name="mail">
                 </div>
                 <div class="mb-3">
                     <label for="exampleDropdownFormPassword1" class="form-label">Password</label>
                     <input type="password" class="form-control" id="exampleDropdownFormPassword1" placeholder="Password" name="password">
                 </div>
                 </div>
                 <div class="text-center justify-content-center">
                    <button type="submit" class="btn btn-danger logButton">Se connecter</button>
                 </div>
             </form>
             <div class="text-center justify-content-center">
                 <a href="forgotPassword.php" class="text-center justify-content-center">
                     <p class="text-center justify-content-center">Mot de passe oublié ?</p>
                 </a>
             </div>
             <?php
                if(!empty($_POST['mail']) && !empty($_POST['password'])){
                    $login = LoginPatient::Login($pdo,$_POST["mail"],$_POST["password"]);
                    if($login != false){
                        error_log("Login success");
                        $_SESSION['token'] = base64_encode("patient:".strval($login));
                        echo '<meta http-equiv="refresh" content="0;url=index.php">';
                    } else {
                        error_log('Erreur de connexion');
                    }
                }
            ?>
         </div>
     </div>
     <div class="p-3 m-0 border-0 bd-example m-0 border-0 text-center justify-content-center mt-5">
        <div class="dropdown-menu text-center align-content-center">
            <h5 class="fw-bold">Nouveau sur Doct'ISEN?</h5>
            <a href="signup.php" class="">
                <button class="btn btn-danger logButton">S'inscrire</button>
            </a>
         </div>
     </div>
 </div>
 </body>
</html>