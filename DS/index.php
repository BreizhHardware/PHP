<!DOCTYPE html>
<html lang="fr" data-bs-theme="dark"    >
<head>
    <meta charset="utf-8">
    <title> Acceuil </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body >
<?php
require('src/php/db/dbconnect.php');
require('src/php/constants.php');
require('src/php/db/Login.php');
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
$pdo = dbConnect();
?>
<div class="container">
    <h1 class="page-title text-center justify-content-center">Se connecter</h1>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
        <label for="username" class="form-label">Nom d'utilisateur</label>
        <input type="text" class="form-control" name="username" id="username" placeholder="fmarquet">
        <label for="password" class="form-label">Mot de passe</label>
        <input type="password" class="form-control" name="password" id="password" placeholder="********">
        <br>
        <div class="text-center justify-content-center">
            <button type="submit" class="btn btn-success">Se connecter</button>
        </div>
    </form>
    <br>
    <?php
        if(!empty($_POST['username']) && !empty($_POST['password'])){
        $login = Login($pdo,$_POST["username"],$_POST["password"]);
        if($login != false){
            error_log("Login success");
            $_SESSION['user_id'] = $login;
            echo '<meta http-equiv="refresh" content="0;url=soldes.php">';
        } else {
            error_log("Login failed");
        }
    }
    ?>
    <h2 class="page-title text-center justify-content-center">Vous n'avez pas de compte</h2>
    <br>
    <div class="text-center justify-content-center">
        <a href="register.php" class="btn btn-primary">S'inscrire</a>
    </div>
</div>
</body>