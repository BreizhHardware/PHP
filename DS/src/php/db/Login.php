<?php

function checkIfExists($pdo, $username){
    $query = $pdo->prepare("SELECT COUNT(*) as count FROM \"solde\" WHERE username = :username");
    $query->bindParam(':username', $username);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);

    if ($result['count'] == 0) {
        return false;
    } else {
        return true;
    }
}


function Login($pdo, $username, $password){
    if(checkIfExists($pdo, $username)){
        $query = $pdo->prepare("SELECT user_id, password FROM \"solde\" where username = :username");
        $query->bindParam(':username', $username);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if($password == $result['password']){
            echo "Login success";
            return $result['user_id'];
        } else {
            echo "Login failed";
            return false;
        }

    } else {
        echo '<h3 class="text-danger text-center justify-content-center">Username not found</h3>';
        return false;
    }
}