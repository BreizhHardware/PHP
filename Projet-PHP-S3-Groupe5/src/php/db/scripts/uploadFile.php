<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["file"])) {
    $uploadDir = "src/uploadFiles/";
    $nameOfFile = "RDV" . $_POST['rdv_id'];
    $uploadFile = $uploadDir . $nameOfFile . ".pdf";

    echo "Chemin du fichier de destination : " . $uploadFile . "<br>";

    if (move_uploaded_file($_FILES["file"]["tmp_name"], $uploadFile)) {
        echo "Le fichier a été téléchargé avec succès.";
    } else {
        echo "Erreur lors du téléchargement du fichier. Code d'erreur : " . $_FILES["file"]["error"];
        error_log("Erreur lors du téléchargement du fichier: " . $_FILES["file"]["error"]);
    }
}
?>
