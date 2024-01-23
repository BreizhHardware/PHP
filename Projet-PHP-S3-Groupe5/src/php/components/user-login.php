<?php
    function loginUI($pdo){
        if (checklogin()){
            $token = tokenDecode();
            if ($token[0] == "patient" ){
                $user = Patient::getPatientFromId($pdo, $token[1]);
                $mail = $user['p_mail'];
                $surname = $user['p_surname'];
                $name = $user['p_name'];
            } else {
                $user = Medecin::getMedecinFromId($pdo, $token[1]);
                $mail = $user['m_mail'];
                $surname = $user['m_surname'];
                $name = $user['m_name'];
            }
            echo '<div class="d-flex flex-row align-items-center gap-3 me-2">
            <img src="https://www.gravatar.com/avatar/' . md5($mail) . '?s=64" alt="avatar" id="avatar" style="width: 14.3%; height: auto; border-radius: 50%">
            <div>
                <a href="src/php/db/scripts/deconnexion.php" class="text-white fw-bold mt-3 link-underline-opacity-75-hover link-underline link-underline-opacity-0 link-offset-3-hover link-underline-light">'.$surname." ".$name.'</a>
            </div>';
            if($token[0] == "patient"){
                echo '<a href="rdv.php" class="text-white fw-bold link-underline-opacity-75-hover link-underline link-underline-opacity-0 link-offset-3-hover link-underline-light">Mes rendez-vous</a></div>';
            } else {
                echo '<a href="rdv-praticien.php" class="text-white fw-bold link-underline-opacity-75-hover link-underline link-underline-opacity-0 link-offset-3-hover link-underline-light">Mon calendrier</a></div>';
            }
        } else {
            echo '<a href="login-praticien.php"> <button type="button" class="btn btn-danger" style="top: 0.4375em;">Vous êtes praticien ?</button> </a><a href="login.php"> <button type="button" class="btn btn-danger" style="top: 0.4375em;">Se connecter</button></a><p>   </p>';
        }
    }
?>