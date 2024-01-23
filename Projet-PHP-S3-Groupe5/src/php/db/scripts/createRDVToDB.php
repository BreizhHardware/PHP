<?php

require('../dbconnect.php');
require('../../constants.php');
require('../Login.php');
require('../Rdv-praticien.php');
ini_set('display_errors', 1);
error_reporting(E_ALL);
$pdo = dbConnect();

if (isset($_POST['createRDV'])) {
    $medID = $_POST['medID'];
    $dateUse = $_POST['date'];
    $dateInter = new DateTime($dateUse);
    $date = $dateInter->format('Y-m-d');
    $timeUse = $_POST['time'];
    $timeInter = new DateTime($timeUse);
    $time = $timeInter->format('H:i:s');
    $lieu = $_POST['lieu'];
    $place = explode(", ", $lieu);
    $lieuID = getLieuID($pdo, $place[0], $place[1], $place[2]);

    if ($medID != null && $date != null && $time != null && $lieuID != null) {
        $query = $pdo->prepare("INSERT INTO rendez_vous (rdv_date, rdv_time, l_id) VALUES (:date, :time, :lieuID )");
        $query->bindParam(':date', $date);
        $query->bindParam(':time', $time);
        $query->bindParam(':lieuID', $lieuID);
        $query->execute();
        $rdvID = $pdo->lastInsertId();
        $query = $pdo->prepare("INSERT INTO propose (m_id, rdv_id) VALUES (:medID, :rdvID)");
        $query->bindParam(':medID', $medID);
        $query->bindParam(':rdvID', $rdvID);
        $query->execute();
    }

    header("Location: ../../../../rdv-praticien.php");

    exit();
}
?>
