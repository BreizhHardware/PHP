<?php

function getAllNiche($pdo, $id){
    $statement = $pdo->prepare("SELECT rdv_date, rdv_time, concat(p_name,' ', p_surname) as patient, p_mail, p_phone
    FROM rendez_vous
    LEFT JOIN patient ON rendez_vous.p_id = patient.p_id
    INNER JOIN propose ON rendez_vous.rdv_id = propose.rdv_id
    INNER JOIN medecin ON propose.m_id = medecin.m_id
    INNER JOIN lieu ON lieu.l_id = rendez_vous.l_id
    
    WHERE CURRENT_DATE = rdv_date AND medecin.m_id = :id
    ORDER BY rdv_date, rdv_time ASC");

    $statement->bindParam(':id', $id);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($result)) {
        return $result;
    } else {
        return null;
    }

}

function getLieuID($pdo, $adress, $postal, $city){
    $statement = $pdo->prepare("SELECT l_id FROM lieu WHERE l_adress = :adress AND l_city = :city AND l_postal = :postal");
    $statement->bindParam(':adress', $adress);
    $statement->bindParam(':city', $city);
    $statement->bindParam(':postal', $postal);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    if (!empty($result)) {
        return $result['l_id'];
    } else {
        return null;
    }
}

function getAllLieux($pdo){
    $statement = $pdo->prepare("SELECT l_adress, l_city, l_postal FROM lieu");
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($result)) {
        return $result;
    } else {
        return null;
    }
}

?>