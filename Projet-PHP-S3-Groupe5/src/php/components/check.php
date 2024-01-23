<?php
function checklogin(){
    if(isset($_SESSION['token'])){
        return true;
    } else {
        return false;
    }
}

function checkMedecin(){
    if(isset($_SESSION['token'])){
        $token = tokenDecode();
        if($token[0] == "medecin"){
            return true;
        } else {
            if($token[0] == "patient"){
                echo '<meta http-equiv="refresh" content="0;url=index.php">';
                return false;
            } else {
                echo '<meta http-equiv="refresh" content="0;url=login-praticien.php">';
                return false;
            }
        }
    } else {
        echo '<meta http-equiv="refresh" content="0;url=index.php">';
        return false;
    }
}

function checkPatient(){
    if(isset($_SESSION['token'])){
        $token = tokenDecode();
        if($token[0] == "patient"){
            return true;
        } else {
            if($token[0] == "medecin"){
                echo '<meta http-equiv="refresh" content="0;url=index.php">';
                return false;
            } else {
                echo '<meta http-equiv="refresh" content="0;url=login.php">';
                return false;
            }
        }
    } else {
        echo '<meta http-equiv="refresh" content="0;url=index.php">';
        return false;
    }
}

?>