<?php

require('../dbconnect.php');
require('../../constants.php');
require('../Login.php');
require('../Rdv.php');
ini_set('display_errors', 1);
error_reporting(E_ALL);
$pdo = dbConnect();


if (isset($_POST['cancel_button'])) {
    $rdv_id = $_POST['rdv_id'];
    CancelRDV($pdo, $rdv_id);
    header("Location: ../../../../rdv.php");
    exit();
}


if (isset($_POST['move_button'])) {
    $rdv_id = $_POST['rdv_id'];
    $MedID = $_POST['medecin_id'];
    $date = $_POST['date'];
    CancelRDV($pdo, $rdv_id);
    echo '<!DOCTYPE html>
<html lang="fr">
 <head>
   <meta charset="utf-8">
   <title> Déplacer RDV </title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Just+Me+Again+Down+Here&family=Open+Sans&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="src/css/styles.css">
   <link rel="icon" href="src/img/favicon.png" type="image/x-icon"/>
   </head>';
    echo '<form method="post" action="../../../../calendrier.php">';
    echo '<input type="hidden" name="id" id="id" value="'.$MedID.'">';
    echo '<input type="hidden" name="start" id="start" value="'.date("Y-m-d").'">';
    echo '<div class="d-flex flex-row flex-wrap my-5 mx-5 gap-5 justify-content-center text-center">';
    echo '<button type="submit" class="btn btn-danger ">Sélectionner un nouveau rendez-vous</button>';
    echo '</div>';
    echo '</form>';
    exit();
}
?>
