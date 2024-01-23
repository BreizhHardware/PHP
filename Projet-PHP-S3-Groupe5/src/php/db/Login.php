<?php
class LoginPatient {

    public static function checkMail($pdo, $mail) {
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

    public static function Login($pdo,$mail,$password) {
        
        if(LoginPatient::checkMail($pdo,$mail)){
            $query = $pdo->prepare("SELECT p_id,p_password FROM patient where p_mail = :mail");
            $query->bindParam(':mail', $mail);
            $query->execute();
            $result = $query->fetch(PDO::FETCH_ASSOC);

            if(password_verify($password,$result['p_password'])){
                echo "Login success";
                return $result['p_id'];
            } else {
                echo "Login failed";
                return false;
            }

        } else {
            echo "Mail not found";
            return false;
        }
    }


}

class LoginMedecin {


    public static function checkMail($pdo, $mail) {
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

    public static function Login($pdo,$mail,$password) {

        if(LoginMedecin::checkMail($pdo,$mail)){
            $query = $pdo->prepare("SELECT m_id, m_password FROM medecin where m_mail = :mail");
            $query->bindParam(':mail', $mail);
            $query->execute();
            $result = $query->fetch(PDO::FETCH_ASSOC);

            if(password_verify($password,$result['m_password'])){
                echo "Login success";
                return $result['m_id'];
            } else {
                echo "Login failed";
                return false;
            }

        } else {
            echo "Mail not found";
            return false;
        }
    }
}
?>