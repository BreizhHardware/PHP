<!DOCTYPE html>
<html lang="fr" data-bs-theme="dark">
<head>
    <meta charset="utf-8">
    <title> Solde </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<?php
require('src/php/db/dbconnect.php');
require('src/php/constants.php');
require('src/php/db/Soldes.php');
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
$pdo = dbConnect();
if(empty($_SESSION['user_id'])){
    echo '<meta http-equiv="refresh" content="0;url=index.php">';
}
?>
<div class="container">
    <div class="text-center justify-content-center mt-2">
        <a href="src/php/scripts/disconect.php" class="btn btn-danger">Se Deconnecter</a>
    </div>
    <div class="d-flex flex-column">
        <h1 class="page-title text-center justify-content-centers">Soldes</h1>
        <?php
            if(!empty($_SESSION['user_id'])){
                GetUser($pdo,$_SESSION['user_id']);
            }
        ?>
        <div>
            <h2 class="page-title">Votre Solde</h2>
            <?php
                DisplaySolde($pdo,$_SESSION['user_id']);
            ?>
        </div>
        <div>
            <h2 class="page-title">Ajouter un solde</h2>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                <label for="montant" class="form-label">Montant</label>
                <input type="number" class="form-control" name="montant" id="montant" placeholder="100">
                <button type="submit" class="btn btn-primary mt-1">Ajouter</button>
            </form>
            <?php
                if(!empty($_POST['montant'])){
                    $addSolde = AddSolde($pdo,$_SESSION['user_id'],$_POST['montant']);
                    if($addSolde != false){
                        error_log("Add solde success");
                        echo '<meta http-equiv="refresh" content="0;url=soldes.php">';
                    } else {
                        error_log("Add solde failed");
                    }
                }
            ?>
        </div>
    </div>
</div>
</body>
