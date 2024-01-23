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
         require('src/php/db/Patient.php');
         require('src/php/db/Medecin.php');
         require('src/php/db/Rdv.php');
         ini_set('display_errors', 1);
         error_reporting(E_ALL);
         $pdo = dbConnect();
         session_start();
         checkPatient();
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
        <div class="row">
            <div class="col-3 border-end border-dark border-3 h-100 mt-2 text-center d-flex flex-column justify-content-center">
                <div class="d-flex flex-column">
                    <div class="border-bottom pb-3 border-dark border-3 align-self-center">
                        <h5 class="text-center">Vos rendez-vous à venir</h5>

                        <?php try {
                            $token = tokenDecode();
                            $rdv = getRdvByPatient($pdo, $token[1]);

                            if ($rdv != null && count($rdv) > 0){
                                foreach ($rdv as $row) {
                                    $dateStr = $row["rdv_date"];
                                    $dateString = new DateTime($dateStr);
                                    $date = $dateString->format('d F Y');
                                    $uglyTime = $row["rdv_time"];
                                    $dateTime = new DateTime($uglyTime);
                                    $time = $dateTime->format('H:i');
                                    $medic = $row["medecin"];
                                    $occupation = $row["m_specialty"];
                                    echo '<div class="card rounded-4 mx-2">';
                                    echo '<div class="card-header bg-danger">';
                                    echo '<div class="d-flex flex-row justify-content-between text-white">';
                                    echo "<p>$date</p>";
                                    echo "<p>$time</p>";
                                    echo '</div>';
                                    echo '</div>';
                                    echo '<div class="card-body">';
                                    echo "<h5 class='card-title'>$medic</h5>";
                                    echo "<h6 class='card-subtitle mb-2 text-body-secondary'>$occupation</h6>";
                                    echo '</div>';
                                    echo '<div class="card-footer">';
                                    echo "<p>Preparer la consulation</p>";
                                    echo '</div>';
                                    echo '</div>';
                                }
                            } else {
                                echo "Vous n'avez pas de rendez-vous à venir";
                            }
                        } catch (PDOException $e) {
                            error_log('Database query error: ' . $e->getMessage());
                            echo "Error fetching data from the database";
                        }
                        ?>

                    </div>
                    <div class="mt-3 align-self-center d-flex flex-column gap-2">
                        <h5 class="text-center">Vos rendez-vous passés</h5>
                        <?php try {
                            $token = tokenDecode();
                            $rdv = getPastRdvByPatient($pdo, $token[1]);

                            if ($rdv != null && count($rdv) > 0){
                                foreach ($rdv as $row) {
                                    $dateStr = $row["rdv_date"];
                                    $dateString = new DateTime($dateStr);
                                    $date = $dateString->format('d F Y');
                                    $uglyTime = $row["rdv_time"];
                                    $dateTime = new DateTime($uglyTime);
                                    $time = $dateTime->format('H:i');
                                    $medic = $row["medecin"];
                                    $occupation = $row["m_specialty"];
                                    $MedID = $row["m_id"];
                                    echo '<div class="card rounded-4 mx-2 pointer">';
                                    echo '<div class="card-header bg-danger">';
                                    echo '<div class="d-flex flex-row justify-content-between text-white">';
                                    echo "<p>$date</p>";
                                    echo "<p>$time</p>";
                                    echo '</div>';
                                    echo '</div>';
                                    echo '<div class="card-body">';
                                    echo "<h5 class='card-title'>$medic</h5>";
                                    echo "<h6 class='card-subtitle mb-2 text-body-secondary'>$occupation</h6>";
                                    echo '</div>';
                                    echo '<div class="card-footer">';
                                    echo '<form method="post" action="calendrier.php">';
                                    echo '<input type="hidden" name="id" id="id" value="'.$MedID.'">';
                                    echo '<input type="hidden" name="start" id="start" value="'.date("Y-m-d").'">';
                                    echo '<button type="submit" class="btn btn-link">Reprendre rendez-vous</button>';
                                    echo '</form>';
                                    echo '</div>';
                                    echo '</div>';
                                }
                            } else {
                                echo "Vous n'avez pas de rendez-vous passé";
                            }
                        } catch (PDOException $e) {
                            error_log('Database query error: ' . $e->getMessage());
                            echo "Error fetching data from the database";
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col border-end border-dark border-3 h-100 mt-2 text-center d-flex flex-column justify-content-center">

                <?php
                $token = tokenDecode();
                $rdv = getNextRdvByPatient($pdo, $token[1]);
                if($rdv != null) {
                    $dateStr = $rdv["rdv_date"];
                    $dateString = new DateTime($dateStr);
                    $date = $dateString->format('d F Y');
                    $uglyTime = $rdv["rdv_time"];
                    $dateTime = new DateTime($uglyTime);
                    $time = $dateTime->format('H:i');
                    $medic = $rdv["medecin"];
                    $occupation = $rdv["m_specialty"];
                    $patient = $rdv["patient"];
                    $adresse = $rdv["adresse"];
                    $ville = $rdv["ville"];
                    $MedID = $rdv["m_id"];


                    echo '<div class="card rounded-4 mx-2">';
                    echo '<div class="card-header bg-danger">';
                    echo '<div class="d-flex flex-row justify-content-between text-white">';
                    echo "<p>$date</p>";
                    echo "<p>$time</p>";
                    echo '</div>';
                    echo '</div>';
                    echo '<div class="card-body">';
                    echo "<h5 class='card-title'>$medic</h5>";
                    echo "<h6 class='card-subtitle mb-2 text-body-secondary'>$occupation</h6>";

                    echo '<form action="/src/php/db/scripts/CancelRDV.php" method="post">';

                    echo '<input type="hidden" name="rdv_id" value="'.$rdv["rdv_id"].'">';
                    echo '<input type="hidden" name="medecin_id" id="id" value="'.$MedID.'">';
                    echo '<input type="hidden" name="date" id="start" value="'.date("Y-m-d").'">';
                    echo '<button type="submit" name="move_button" class="btn btn-outline-danger">Déplacer le RDV</button>';
                    echo '</form>';

                    echo '<form action="/src/php/db/scripts/CancelRDV.php" method="post">';
                    echo '<input type="hidden" name="rdv_id" value="'.$rdv["rdv_id"].'">';
                    echo '<br>';
                    echo '<button type="submit" name="cancel_button" class="btn btn-outline-danger">Annuler RDV</button>';
                    echo '</form>';
                    echo '</div>';
                    echo '</div>';
                    echo '<div class="card rounded-4 mx-2 mt-3">';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">Préparer la consulation</h5>';
                    echo '<h6 class="card-subtitle mb-2 text-body-secondary">Pour gagner du temps et améliorer votre prise en charge.</h6>';

                    echo '<form action="src/php/db/scripts/uploadFile.php" method="post" enctype="multipart/form-data">';
                    echo '<label for="file">Sélectionner un fichier :</label>';
                    echo '<input type="hidden" name="rdv_id" value="'.$rdv["rdv_id"].'">';
                    echo '<input type="file" class="form-control" name="file" id="file" accept=".pdf, .jpeg, .jpg, .png" disabled>';
                    echo '<br><br>';
                    echo '<input type="submit" class="btn border-black border-1 disabled" name="submit" value="Envoyer le fichier">';
                    echo '<h6 class="card-subtitle text-danger">Maintenance en cours.</h6>';
                    echo '</form>';

                    echo '</div>';
                    echo '</div>';
                    echo '<div class="card rounded-4 mx-2 mt-3">';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">Patient</h5>';
                    echo "<h6 class='card-subtitle mb-2 text-body-secondary'>$patient</h6>";
                    echo '</div>';
                    echo '</div>';
                    echo '<div class="card rounded-4 mx-2 mt-3">';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">Lieu de la consulation</h5>';
                    echo "<h6 class='card-subtitle mb-2 text-body-secondary'>$adresse<br>";
                    echo "$ville<br></h6>";
                    echo '</div>';
                    echo '</div>';
                }else{
                    echo '<div class="card rounded-4 mx-2 pointer">';
                    echo '<div class="card-header bg-danger">';
                    echo '<div class="d-flex flex-row justify-content-between text-white">';
                    echo "<p>Vous n'avez pas de rendez-vous à venir</p>";
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
                ?>

            </div>
            <div class="col h-100">
                <form class="input-group mt-5" method="post" action="search.php">
                    <input type="text" aria-label="First name" class="form-control" id="nom" name="nom" placeholder="Nom, spécialité">
                    <input type="text" aria-label="Last name" class="form-control" id="postal" name="postal" placeholder="Où ?">
                    <button class="btn btn-danger me-3" type="submit" id="button-addon2">Rechercher</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
 </body>
</html>