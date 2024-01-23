<?php
function DisplaySolde($pdo, $id){
    $querry = $pdo->prepare("SELECT username, solde FROM \"solde\" WHERE user_id = :id");
    $querry->bindParam(':id', $id);
    $querry->execute();
    $solde = $querry->fetch();
    echo '<table class="table">';
    echo '<thead>';
    echo '<tr>';
    echo '<th scope="col">Nom d\'utilisateur</th>';
    echo '<th scope="col">Solde</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    echo '<tr>';
    echo '<td>'.$solde['username'].'</td>';
    echo '<td>'.$solde['solde'].'</td>';
    echo '</tr>';
    echo '</tbody>';
    echo '</table>';
}

function AddSolde($pdo, $id, $montant){
    $querry = $pdo->prepare("UPDATE \"solde\" SET solde = solde + :montant WHERE user_id = :id");
    $querry->bindParam(':id', $id);
    $querry->bindParam(':montant', $montant);
    $querry->execute();
    return $querry->fetch();
}

function GetUser($pdo, $id){
    $querry = $pdo->prepare("SELECT * FROM \"solde\" WHERE user_id = :id");
    $querry->bindParam(':id', $id);
    $querry->execute();
    $user = $querry->fetch();
    echo '<h3 class="page-title">Bonjour '.$user['name'].' '.$user['surname'].'</h3>';
}