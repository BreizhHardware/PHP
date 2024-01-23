<!DOCTYPE html>
<html lang="fr">
 <head>
   <meta charset="utf-8">
   <title> RDV </title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Just+Me+Again+Down+Here&family=Open+Sans&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="src/css/styles.css">
   <link rel="icon" href="src/img/favicon.png" type="image/x-icon"/>
     <?php
     require('src/php/db/dbconnect.php');
     require('src/php/constants.php');
     require('src/php/db/Login.php');
     require('src/php/components/check.php');
     require('src/php/components/token.php');
     require('src/php/components/user-login.php');
     require('src/php/db/Medecin.php');
     require('src/php/db/Patient.php');
     require('src/php/db/Rdv-praticien.php');
     ini_set('display_errors', 1);
     error_reporting(E_ALL);
     $pdo = dbConnect();
     session_start();
     checkMedecin();
     ?>
 </head>
 <body>
    <div id="topbar" class="d-flex justify-content-between flex-row">
        <div>
            <a href="index.php">
                <p id="DoctISEN" class="top-0">
                    Doct'ISEN
                </p>
            </a>
        </div>
        <div class="d-flex flex-row align-items-center gap-3 me-2">
            <div class="d-flex flex-row align-items-center gap-3 me-2">
                <?php
                loginUI($pdo);
                ?>
            </div>
        </div>
    </div>
    <div class="h-100">
        <div class="d-flex flex-row flex-wrap my-5 mx-5 gap-5 justify-content-center text-center">

            <?php try {
                $token = tokenDecode();
                $rdv = getAllNiche($pdo, $token[1]);
                if ($rdv != null && count($rdv) > 0){
                foreach ($rdv as $row) {
                    $dateStr = $row["rdv_date"];
                    $dateString = new DateTime($dateStr);
                    $date = $dateString->format('d F Y');
                    $uglyTime = $row["rdv_time"];
                    $dateTime = new DateTime($uglyTime);
                    $time = $dateTime->format('H:i');
                    $patient = $row["patient"];
                    $mail = $row["p_mail"];
                    $phone = $row["p_phone"];
                    if ($mail != null){
                        echo '<div class="card rounded-4 mx-2 pointer">';
                        echo '<div class="card-header bg-danger">';
                        echo '<div class="d-flex flex-row justify-content-between text-white">';
                        echo "<p>$date</p>";
                        echo "<p>$time</p>";
                        echo '</div>';
                        echo '</div>';
                        echo '<div class="card-body">';
                        echo "<h5 class='card-title'>$patient</h5>";
                        echo "<a href='mailto:" . $mail . "' class='card-subtitle mb-2 text-body-secondary'>$mail</a>";
                        echo '<br>';
                        echo "<a href='tel:" . "0" . $phone . "' class='card-subtitle mb-2 text-body-secondary'>$phone</a>";
                        echo '</div>';
                        echo '</div>';
                    } else {
                        echo '<div class="card rounded-4 mx-2 pointer">';
                        echo '<div class="card-header bg-danger">';
                        echo '<div class="d-flex flex-row justify-content-between text-white">';
                        echo "<p>$date</p>";
                        echo "<p>$time</p>";
                        echo '</div>';
                        echo '</div>';
                        echo '<div class="card-body">';
                        echo "<h5 class='card-title'>Vous n'avez pas de" . "<br>" . "patient pour ce créneau</h5>";
                        echo '</div>';
                        echo '</div>';
                    }
        }
    } else {
        echo 'error';
    }
} catch (PDOException $e) {
    error_log('Database query error: ' . $e->getMessage());
    echo "Error fetching data from the database";
} ?>



        </div>

        <div class="d-flex flex-row flex-wrap my-5 mx-5 gap-5 justify-content-center text-center">
            <?php
            $token = tokenDecode();
            $medID = $token[1];
            $lieux = getAllLieux($pdo);
            echo "<form action='src/php/db/scripts/createRDVToDB.php' method='post'>";
            echo "<input type='hidden' name='medID' value='$medID'>";
            echo "<input class='form-control' type='date' name='date'>";
            echo "<input class='form-control' type='time' name='time'>";
            echo "<select class='form-select' name='lieu' id='lieu'>";
            echo "<option value=''>Choisissez un lieu</option>";
            if ($lieux != null && count($lieux) > 0){
                foreach ($lieux as $row){
                    $adress = $row["l_adress"];
                    $postal = $row["l_postal"];
                    $city = $row["l_city"];
                    $lieu = $adress . ', ' . $postal . ', ' . $city;
                    echo "<option value='$lieu'>$adress, $postal,  $city</option>";
                }
            }
            echo "</select>";
            echo "<br><br>";
            echo "<button type='submit' name='createRDV' class='btn btn-danger'>Créer un rendez-vous</button>";
            echo "</form>";
            ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
 </body>
</html>