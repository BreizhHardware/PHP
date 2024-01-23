<?php
require('../dbconnect.php');
require('../../constants.php');
ini_set('display_errors', 1);
error_reporting(E_ALL);
$pdo = dbConnect();

$rdv = $_GET['id'];
$patient = $_GET['patient'];

$query = $pdo->prepare("UPDATE rendez_vous SET p_id = :p_id WHERE rdv_id = :rdv_id");
$query->bindParam(':p_id', $patient);
$query->bindParam(':rdv_id', $rdv);
$query->execute();


//Redirect to the rdv.php page
echo '<meta http-equiv="refresh" content="0;URL=../../../../rdv.php">';

?>