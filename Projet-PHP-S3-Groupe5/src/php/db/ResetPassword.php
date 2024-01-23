<?php
class ResetPraticien{
    static function checkMail($pdo, $mail) {
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

    static function getIdFromMail($pdo, $mail) {
        $query = $pdo->prepare("SELECT m_id FROM medecin WHERE m_mail = :mail");
        $query->bindParam(':mail', $mail);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result['m_id'];
    }

    public static function Reset($pdo,$mail,$password) {
        if(ResetPraticien::checkMail($pdo,$mail)){
            $password = password_hash($password, PASSWORD_ARGON2ID);
            $id = ResetPraticien::getIdFromMail($pdo,$mail);
            $query = $pdo->prepare("UPDATE medecin SET m_password = :password WHERE m_id = :id");
            $query->bindParam(':password', $password);
            $query->bindParam(':id', $id);
            $query->execute();
            return true;
        } else {
            return false;
        }
    }
}

class ResetPatient{
    static function checkMail($pdo, $mail) {
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

    static function getIdFromMail($pdo, $mail) {
        $query = $pdo->prepare("SELECT p_id FROM patient WHERE p_mail = :mail");
        $query->bindParam(':mail', $mail);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result['p_id'];
    }

    public static function Reset($pdo,$mail,$password) {
        if(ResetPatient::checkMail($pdo,$mail)){
            $password = password_hash($password, PASSWORD_ARGON2ID);
            $id = ResetPatient::getIdFromMail($pdo,$mail);
            $query = $pdo->prepare("UPDATE patient SET p_password = :password WHERE p_id = :id");
            $query->bindParam(':password', $password);
            $query->bindParam(':id', $id);
            $query->execute();
            return true;
        } else {
            return false;
        }
    }
}