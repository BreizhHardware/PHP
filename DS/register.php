<!DOCTYPE html>
<html lang="fr" data-bs-theme="dark">
<head>
    <meta charset="utf-8">
    <title> Register </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<?php
require('src/php/db/dbconnect.php');
require('src/php/constants.php');
require('src/php/db/Register.php');
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
$pdo = dbConnect();
?>
<div class="container">
    <h1 class="page-title text-center justify-content-center">S'inscrire</h1>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
        <label for="nom" class="form-label">Nom</label>
        <input type="text" class="form-control" name="nom" id="nom" placeholder="MARQUET">
        <label for="prenom" class="form-label">Prénom</label>
        <input type="text" class="form-control" name="prenom" id="prenom" placeholder="Félix">
        <label for="password" class="form-label">Mot de passe</label>
        <input type="password" class="form-control" name="password" id="password" placeholder="********">
        <label for="passwordConfirm" class="form-label">Confirmer le mot de passe</label>
        <input type="password" class="form-control" name="passwordConfirm" id="passwordConfirm" placeholder="********">
        <p id="password-error" class="text-danger"> </p>
        <div class="text-center justify-content-center">
            <button type="submit" class="btn btn-success" id="signupButton">S'inscrire</button>
        </div>
    </form>
    <?php
        if(!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['password']) && !empty($_POST['passwordConfirm'])){
            if($_POST['password'] == $_POST['passwordConfirm']){
                $register = Insert($pdo,$_POST["nom"],$_POST["prenom"],$_POST["password"]);
                if($register != false){
                    error_log("Register success");
                    echo '<meta http-equiv="refresh" content="0;url=index.php">';
                } else {
                    error_log("Register failed");
                }
            } else {
                echo '<script>document.getElementById("password-error").innerHTML = "Les mots de passe ne correspondent pas";</script>';
            }
        }
    ?>
    <h2 class="page-title">Vous avez déjà un compte</h2>
    <div class="text-center justify-content-center">
        <a href="index.php" class="btn btn-primary">Se connecter</a>
    </div>
</div>
</body>
