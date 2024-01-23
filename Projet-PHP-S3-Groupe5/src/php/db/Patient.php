<?php

class Patient {
    public static function getPatientFromId($pdo,$id) {
        $query = $pdo->prepare("SELECT * FROM patient WHERE p_id = :id");
        $query->bindParam(':id', $id);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public static function getPatient($pdo,$mail) {
        $query = $pdo->prepare("SELECT * FROM patient WHERE p_mail = :mail");
        $query->bindParam(':mail', $mail);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public static function GetRDV($pdo,$mail){
        $query = $pdo->prepare("SELECT * FROM rendez_vous WHERE p_mail = :mail");
        $query->bindParam(':mail', $mail);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;

    }


}
?>