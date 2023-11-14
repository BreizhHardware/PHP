<?php
    include('./constants.php');
    function dbConnect() {
        $dsn = 'pgsql:dbname=' . DB_NAME . ';host=' . DB_SERVER . ';port=' . DB_PORT;
        try {
            $conn = new PDO($dsn, DB_USER, DB_PASSWORD);
            return $conn;
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }
    function dbGetAuthorsNames(PDO $conn) {
        $pgsql = "SELECT nom, prenom FROM auteur";
        $stmt = $conn->prepare($pgsql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function dbGetQuotes(PDO $conn) {
        $pgsql = "SELECT phrase FROM citation";
        $stmt = $conn->prepare($pgsql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function dbGetCenturies(PDO $conn) {
        $pgsql = "SELECT numero FROM siecle";
        $stmt = $conn->prepare($pgsql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function getNumberofQuotes(PDO $db)
    {
        try
        {
            $statement = $db->query('SELECT count(id) FROM citation');
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $nbQuotes = $result['count'];
        }
        catch (PDOException $exception)
        {
            error_log('Request error: '.$exception->getMessage());
            return false;
        }
        return $nbQuotes;
    }

    function randomQuote($db){
        $statement = $db->query('SELECT phrase, auteurid, siecleid FROM citation ORDER BY RANDOM() LIMIT 1');
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        $phrase = $result['phrase'];
        $auteurid = $result['auteurid'];
        $siecleid = $result['siecleid'];
        $statement = $db->query("SELECT nom, prenom FROM auteur WHERE id = $auteurid");
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        $nom = $result['nom'];
        $prenom = $result['prenom'];
        $statement = $db->query("SELECT numero FROM siecle WHERE id = $siecleid");
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        $numero = $result['numero'];
        echo "<p><strong> $phrase </strong></p>";
        echo "<p> $prenom $nom ($numero<sup>e</sup> siècle)</p>";
    }

    function getAuthorAndSiecle(PDO $db, $author, $siecle){
        // Requête préparée pour récupérer l'id de l'auteur
        $statement = $db->prepare("SELECT id FROM auteur WHERE nom = :author");
        $statement->bindParam(':author', $author);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        // Vérifier si la requête a retourné des résultats
        if ($result !== false) {
            $auteurid = $result['id'];

            // Requête préparée pour récupérer l'id du siècle
            $statement = $db->prepare("SELECT id FROM siecle WHERE numero = :siecle");
            $statement->bindParam(':siecle', $siecle);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);

            // Vérifier si la requête a retourné des résultats
            if ($result !== false) {
                $siecleid = $result['id'];

                // Requête préparée pour récupérer la phrase
                $statement = $db->prepare("SELECT phrase FROM citation WHERE auteurid = :authorid AND siecleid = :siecleid");
                $statement->bindParam(':authorid', $auteurid);
                $statement->bindParam(':siecleid', $siecleid);
                $statement->execute();
                $result = $statement->fetch(PDO::FETCH_ASSOC);

                // Vérifier si la requête a retourné des résultats
                if ($result !== false) {
                    $phrase = $result['phrase'];
                    echo "<p><strong> $phrase </strong></p>";
                    echo "<p> $author ($siecle<sup>e</sup> siècle)</p>";
                } else {
                    echo "<p>Aucune phrase trouvée pour cet auteur et ce siècle.</p>";
                }
            } else {
                echo "<p>Aucun siècle trouvé pour le numéro spécifié.</p>";
            }
        } else {
            echo "<p>Aucun auteur trouvé pour le nom spécifié.</p>";
        }
    }
?>