<?php

class SignupPatient
{
    public static function Insert($pdo,$name,$surname,$mail,$password,$phone){
        $password = password_hash($password, PASSWORD_ARGON2ID);
        $query = $pdo->prepare("INSERT INTO patient (p_name,p_surname,p_mail,p_password,p_phone) VALUES (:name,:surname,:mail,:password,:phone)");
        $query->bindParam(':name', $name);
        $query->bindParam(':surname', $surname);
        $query->bindParam(':mail', $mail);
        $query->bindParam(':password', $password);
        $query->bindParam(':phone', $phone);
        $query->execute();
        //Check if user is well created in database
        $query = $pdo->prepare("SELECT COUNT(*) as count FROM patient WHERE p_mail = :mail");
        $query->bindParam(':mail', $mail);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if ($result['count'] == 0) {
            return false;
        } else {
            return true;
        }
    }

}

class SignupMedecin
{
    public static function insertMedecin($pdo,$name,$surname,$mail,$password,$specialite,$phone,$postal) {
        $password = password_hash($password, PASSWORD_ARGON2ID);
        $query = $pdo->prepare("INSERT INTO medecin (m_name,m_surname,m_mail,m_password,m_specialty,m_phone,m_postal) VALUES (:name,:surname,:mail,:password,:specialite,:phone,:postal)");
        $query->bindParam(':name', $name);
        $query->bindParam(':surname', $surname);
        $query->bindParam(':mail', $mail);
        $query->bindParam(':password', $password);
        $query->bindParam(':specialite', $specialite);
        $query->bindParam(':phone', $phone);
        $query->bindParam(':postal', $postal);
        $query->execute();
        //Check if user is well created in database
        $query = $pdo->prepare("SELECT COUNT(*) as count FROM medecin WHERE m_mail = :mail");
        $query->bindParam(':mail', $mail);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if ($result['count'] == 0) {
            return false;
        } else {
            return true;
        }
    }
}