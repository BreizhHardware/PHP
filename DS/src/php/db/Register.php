<?php
function Insert($pdo, $nom, $prenom, $password){
    $username = strtolower(substr($prenom, 0, 1) . $nom);
    $query = $pdo->prepare("INSERT INTO \"solde\" (username, password, solde, name, surname) VALUES (:username, :password, :solde, :name, :surname)");
    $query->bindParam(':username', $username);
    $query->bindParam(':password', $password);
    $query->bindParam(':name', $nom);
    $query->bindParam(':surname', $prenom);
    $solde = 0;
    $query->bindParam(':solde', $solde);
    $query->execute();
    //Check if user is well created in database
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
