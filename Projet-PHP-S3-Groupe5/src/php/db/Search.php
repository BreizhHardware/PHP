<?php
function search($pdo, $nom, $postal){
    if($_POST["nom"] == null && $_POST["postal"] == null){
        echo '<p class="ms-5 mt-2 fw-bold">Veuillez entrer un nom ou un lieu</p>';
    }
    else if($_POST['postal'] == null){
        $query = $pdo->prepare("SELECT * FROM medecin WHERE m_name = :nom");
        $query->bindParam(':nom', $_POST['nom']);
        $query->execute();
        $result = $query->fetchAll();

        if($result == null){
            $query = $pdo->prepare("SELECT * FROM medecin WHERE m_specialty = :specialite");
            $query->bindParam(':specialite', $_POST['nom']);
            $query->execute();
            $result = $query->fetchAll();
        }

        $count = 0;
        foreach($result as $row){
            $count++;
        }

        echo '<p class="ms-5 mt-2 fw-bold">'.$count.' Résultats</p>';

        if($count == 0){
            echo '<p class="ms-5 mt-2 fw-bold">Aucun résultat</p>';
        }
        else{
            echo '<div class="d-flex flex-row flex-wrap mx-5 gap-5">';
            foreach($result as $row){
                echo '<div class="card mb-3">';
                echo '<div class="row g-0">';
                echo '<div class="col-md-4">';
                $imageUrl = 'https://thispersondoesnotexist.com';
                echo '<img src="' . $imageUrl . '" alt="doctor" class="img-fluid rounded-start" width="300" height="300">';
                echo '</div>';
                echo '<div class="col-md-8">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">'.$row['m_name'].' '.$row['m_surname'].'</h5>';
                echo '<h6 class="card-subtitle mb-2 text-body-secondary">'.$row['m_specialty'].'</h6>';
                $query = $pdo->prepare("SELECT * FROM propose WHERE m_id = :id");
                $query->bindParam(':id', $row['m_id']);
                $query->execute();
                $result = $query->fetchAll();
                $count = 0;
                foreach($result as $row2){
                    $count++;
                }
                echo '<p class="card-text">Disponiblilité :'. $count .'</p>';
                echo '<form method="post" action="../../../calendrier.php">';
                echo '<input type="hidden" name="id" id="id" value="'.$row['m_id'].'">';
                echo '<input type="hidden" name="start" id="start" value="'.date("Y-m-d").'">';
                echo '<button type="submit" class="btn btn-danger">Prendre rendez-vous</button>';
                echo '</form>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
            echo '</div>';
        }
    }
    else if($_POST['nom'] == null){
        if(strlen($_POST['postal']) != 5){
            $postal = substr($_POST['postal'], 0, 2);
            $postal = $postal.'%';
            $query = $pdo->prepare("SELECT * FROM medecin WHERE CAST(m_postal AS TEXT) LIKE :postal");
            $query->bindParam(':postal', $postal);
            $query->execute();
            $result = $query->fetchAll();

            $count = 0;
            foreach($result as $row){
                $count++;
            }

            echo '<p class="ms-5 mt-2 fw-bold">'.$count.' Résultats</p>';

            if($count == 0){
                echo '<p class="ms-5 mt-2 fw-bold">Aucun résultat</p>';
            }
            else{
                echo '<div class="d-flex flex-row flex-wrap mx-5 gap-5">';
                foreach($result as $row){
                    echo '<div class="card mb-3">';
                    echo '<div class="row g-0">';
                    echo '<div class="col-md-4">';
                    $imageUrl = 'https://thispersondoesnotexist.com';
                    echo '<img src="' . $imageUrl . '" alt="doctor" class="img-fluid rounded-start" width="300" height="300">';
                    echo '</div>';
                    echo '<div class="col-md-8">';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">'.$row['m_name'].' '.$row['m_surname'].'</h5>';
                    echo '<h6 class="card-subtitle mb-2 text-body-secondary">'.$row['m_specialty'].'</h6>';
                    echo '<p class="card-text">Disponiblilité :'. $count .'</p>';
                    echo '<form method="post" action="../../../calendrier.php">';
                    echo '<input type="hidden" name="id" id="id" value="'.$row['m_id'].'">';
                    echo '<input type="hidden" name="start" id="start" value="'.date("Y-m-d").'">';
                    echo '<button type="submit" class="btn btn-danger">Prendre rendez-vous</button>';
                    echo '</form>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
                echo '</div>';
            }
        }
        else{
            $query = $pdo->prepare("SELECT * FROM medecin WHERE m_postal = :postal");
            $query->bindParam(':postal', $_POST['postal']);
            $query->execute();
            $result = $query->fetchAll();

            $count = 0;
            foreach($result as $row){
                $count++;
            }

            echo '<p class="ms-5 mt-2 fw-bold">'.$count.' Résultats</p>';

            if($count == 0){
                echo '<p class="ms-5 mt-2 fw-bold">Aucun résultat</p>';
            }
            else{
                echo '<div class="d-flex flex-row flex-wrap mx-5 gap-5">';
                foreach($result as $row){
                    echo '<div class="card mb-3">';
                    echo '<div class="row g-0">';
                    echo '<div class="col-md-4">';
                    $imageUrl = 'https://thispersondoesnotexist.com';
                    echo '<img src="' . $imageUrl . '" alt="doctor" class="img-fluid rounded-start" width="300" height="300">';
                    echo '</div>';
                    echo '<div class="col-md-8">';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">'.$row['m_name'].' '.$row['m_surname'].'</h5>';
                    echo '<h6 class="card-subtitle mb-2 text-body-secondary">'.$row['m_specialty'].'</h6>';
                    echo '<p class="card-text">Disponiblilité :'. $count .'</p>';
                    echo '<form method="post" action="../../../calendrier.php">';
                    echo '<input type="hidden" name="id" id="id" value="'.$row['m_id'].'">';
                    echo '<input type="hidden" name="start" id="start" value="'.date("Y-m-d").'">';
                    echo '<button type="submit" class="btn btn-danger">Prendre rendez-vous</button>';
                    echo '</form>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
                echo '</div>';
            }
        }
    }
    else {
        if(strlen($_POST['postal']) != 5){
            $postal = substr($_POST['postal'], 0, 2);
            $postal = $postal.'%';
            $query = $pdo->prepare("SELECT * FROM medecin WHERE CAST(m_postal AS TEXT) LIKE :postal AND m_name = :nom");
            $query->bindParam(':postal', $postal);
            $query->bindParam(':nom', $_POST['nom']);
            $query->execute();
            $result = $query->fetchAll();
        }
        else{
            $query = $pdo->prepare("SELECT * FROM medecin WHERE m_name = :nom AND m_postal = :postal");
            $query->bindParam(':nom', $_POST['nom']);
            $query->bindParam(':postal', $_POST['postal']);
            $query->execute();
            $result = $query->fetchAll();
        }
        if ($result == null) {
            if(strlen($_POST['postal']) != 5){
                $postal = substr($_POST['postal'], 0, 2);
                $postal = $postal.'%';
                $query = $pdo->prepare("SELECT * FROM medecin WHERE CAST(m_postal AS TEXT) LIKE :postal AND m_specialty = :specialite");
                $query->bindParam(':postal', $postal);
                $query->bindParam(':specialite', $_POST['nom']);
                $query->execute();
                $result = $query->fetchAll();
            }
            else{
                $query = $pdo->prepare("SELECT * FROM medecin WHERE m_specialty = :specialite AND m_postal = :postal");
                $query->bindParam(':specialite', $_POST['nom']);
                $query->bindParam(':postal', $_POST['postal']);
                $query->execute();
                $result = $query->fetchAll();
            }
        }

        $count = 0;
        foreach ($result as $row) {
            $count++;
        }

        echo '<p class="ms-5 mt-2 fw-bold">' . $count . ' Résultats</p>';

        if ($count == 0) {
            echo '<p class="ms-5 mt-2 fw-bold">Aucun résultat</p>';
        } else {
            echo '<div class="d-flex flex-row flex-wrap mx-5 gap-5">';
            foreach ($result as $row) {
                echo '<div class="card mb-3">';
                echo '<div class="row g-0">';
                echo '<div class="col-md-4">';
                $imageUrl = 'https://thispersondoesnotexist.com';
                echo '<img src="' . $imageUrl . '" alt="doctor" class="img-fluid rounded-start" width="300" height="300">';
                echo '</div>';
                echo '<div class="col-md-8">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . $row['m_name'] . ' ' . $row['m_surname'] . '</h5>';
                echo '<h6 class="card-subtitle mb-2 text-body-secondary">' . $row['m_specialty'] . '</h6>';
                echo '<p class="card-text">Disponiblilité :'. $count .'</p>';
                echo '<form method="post" action="../../../calendrier.php">';
                echo '<input type="hidden" name="id" id="id" value="'.$row['m_id'].'">';
                echo '<input type="hidden" name="start" id="start" value="'.date("Y-m-d").'">';
                echo '<button type="submit" class="btn btn-danger">Prendre rendez-vous</button>';
                echo '</form>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
            echo '</div>';
        }
    }
}

?>