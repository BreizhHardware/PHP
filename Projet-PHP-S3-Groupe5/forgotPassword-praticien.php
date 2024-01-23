<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title> Forgot Password </title>
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
require('src/php/db/ResetPassword.php');
ini_set('display_errors', 1);
error_reporting(E_ALL);
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
            <h5 class="text-center fw-bold">J'ai oublié mon mot de passe praticien</h5>
            <form class="px-4 py-3" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                <div>
                    <div class="mb-3">
                        <label for="exampleDropdownFormEmail1" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="exampleDropdownFormEmail1" placeholder="email@example.com" name="mail">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Nouveau mot de passe</label>
                        <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                    </div>
                    <div class="mb-3">
                        <label for="passwordConfirmation" class="form-label">Confirmation du nouveau mot de passe</label>
                        <input type="password" class="form-control" id="passwordConfirmation" placeholder="Password" name="passwordConfirmation">
                    </div>
                </div>
                <div class="text-center justify-content-center">
                    <button type="submit" class="btn btn-danger logButton">Réinitialiser le mot de passe</button>
                </div>
            </form>
            <?php
            if(!empty($_POST['mail']) && !empty($_POST['password']) && !empty($_POST['passwordConfirmation'])){
                $mail = ($_POST["mail"]);
                $password = ($_POST["password"]);
                $passwordConfirmation = ($_POST["passwordConfirmation"]);
                if($password == $passwordConfirmation){
                    if(ResetPraticien::Reset($pdo,$mail,$password)){
                        error_log("Reset success");
                        echo '<meta http-equiv="refresh" content="0;url=login-praticien.php">';
                    } else {
                        error_log("Reset failed");
                        echo "<p class='text-center justify-content-center text-danger'>Erreur lors de la réinitialisation du mot de passe</p>";
                    }
                } else {
                    error_log("Reset failed");
                    echo "<p class='text-center justify-content-center text-danger'>Les mots de passe ne correspondent pas</p>";
                }
            }
            ?>
        </div>
    </div>
</div>
</body>
</html>
