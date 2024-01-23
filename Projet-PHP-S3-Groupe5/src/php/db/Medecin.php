<?php

class Medecin
{
    public static function getMedecinFromId($pdo,$id) {
        $query = $pdo->prepare("SELECT * FROM medecin WHERE m_id = :id");
        $query->bindParam(':id', $id);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public static function getMedecin($pdo,$mail) {
        $query = $pdo->prepare("SELECT * FROM medecin WHERE m_mail = :mail");
        $query->bindParam(':mail', $mail);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public static function getMedecinByNom($pdo,$nom) {
        $query = $pdo->prepare("SELECT * FROM medecin WHERE m_name = :nom");
        $query->bindParam(':nom', $nom);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public static function getMedecinBySpecialite($pdo,$specialite) {
        $query = $pdo->prepare("SELECT * FROM medecin WHERE m_specialty = :specialite");
        $query->bindParam(':specialite', $specialite);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public static function getMedecinByNameAndSpecialite($pdo,$nom,$specialite) {
        $query = $pdo->prepare("SELECT * FROM medecin WHERE m_name = :nom AND m_specialty = :specialite");
        $query->bindParam(':nom', $nom);
        $query->bindParam(':specialite', $specialite);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

}