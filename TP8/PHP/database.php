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
        console_log($result);
        $nom = $result['nom'];
        $prenom = $result['prenom'];
        $statement = $db->query("SELECT numero FROM siecle WHERE id = $siecleid");
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        $numero = $result['numero'];
        echo "<p><strong> $phrase </strong></p>";
        echo "<p> $prenom $nom ($numero<sup>e</sup> siècle)</p>";
    }

    function console_log($message, $with_script_tags = true){
        $js_code = 'console.log(' . json_encode($message, JSON_HEX_TAG) .
            ');';
        if ($with_script_tags) {
            $js_code = '<script>' . $js_code . '</script>';
        }
        echo $js_code;
    }

    function getAuthorIdByName(PDO $db, $name){
        $statement = $db->prepare("SELECT id FROM auteur WHERE CONCAT(nom, ' ', prenom) = :name");
        $statement->bindParam(':name', $name);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['id'] : null;
    }

    function getCenturyIdByNumber(PDO $db, $number){
        $statement = $db->prepare("SELECT id FROM siecle WHERE numero = :number");
        $statement->bindParam(':number', $number);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['id'] : null;
    }

    function getQuoteByAuthorAndCentury($db, $author, $century){
        try{
            $authorId = getAuthorIdByName($db, $author);

            $centuryId = getCenturyIdByNumber($db, $century);

            $statement = $db->prepare("SELECT phrase FROM citation WHERE auteurid = :authorId AND siecleid = :centuryId");
            $statement->bindParam(':authorId', $authorId);
            $statement->bindParam(':centuryId', $centuryId);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);

            if($result){
                return $result;
            }
            else{
                return null;
            }
        }
        catch (PDOException $exception){
            error_log('Request error: '.$exception->getMessage());
            return false;
        }
    }

    function displayQuoteByAuthorAndCentury(PDO $db, $author, $century){
        $quotes = getQuoteByAuthorAndCentury($db, $author, $century);
        if($quotes != null){
            echo "<table>";
            echo "<thead><tr><th>Citation</th></tr></thead>";
            echo "<tbody>";
            foreach ($quotes as $quote) {
                echo "<tr><td>" . $quote['phrase'] . "</td></tr>";
            }
            echo "</tbody>";
            echo "</table>";
        }
        else{
            echo "<p>Aucune citation trouvée</p>";
        }
    }

    function dbGetQuotesID(PDO $db){
        $pgsql = "SELECT id FROM citation";
        $stmt = $db->prepare($pgsql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function addQuotesToDb(PDO $db, $authorName, $authorFirstName, $century, $quote){
        try {
            $db->beginTransaction();

            // Check if the author already exists; if not, add it to the database
            $authorId = getAuthorIdByName($db, $authorName . " " . $authorFirstName);
            if($authorId == null){
                $insertAuthorStatement = $db->prepare("INSERT INTO auteur (nom, prenom) VALUES (:nom, :prenom)");
                $insertAuthorStatement->bindParam(':nom', $authorName);
                $insertAuthorStatement->bindParam(':prenom', $authorFirstName);
                $insertAuthorStatement->execute();
                $authorId = getAuthorIdByName($db, $authorName . " " . $authorFirstName);
            }

            // Check if the century already exists; if not, add it to the database
            $centuryId = getCenturyIdByNumber($db, $century);
            if($centuryId == null){
                $insertCenturyStatement = $db->prepare("INSERT INTO siecle (numero) VALUES (:numero)");
                $insertCenturyStatement->bindParam(':numero', $century);
                $insertCenturyStatement->execute();
                $centuryId = getCenturyIdByNumber($db, $century);
            }

            // Add the quote to the database
            $insertQuoteStatement = $db->prepare("INSERT INTO citation (phrase, auteurid, siecleid) VALUES (:phrase, :auteurid, :siecleid)");
            $insertQuoteStatement->bindParam(':phrase', $quote);
            $insertQuoteStatement->bindParam(':auteurid', $authorId);
            $insertQuoteStatement->bindParam(':siecleid', $centuryId);
            $insertQuoteStatement->execute();

            // Commit the transaction
            $db->commit();
        } catch (Exception $e) {
            // Roll back the transaction if an exception occurs
            $db->rollBack();
            echo "Failed: " . $e->getMessage();
        }
    }

    function deleteQuoteFromDb(PDO $db, $id){
        try {
            $db->beginTransaction();

            // Delete the quote from the database
            $deleteQuoteStatement = $db->prepare("DELETE FROM citation WHERE id = :id");
            $deleteQuoteStatement->bindParam(':id', $id);
            $deleteQuoteStatement->execute();

            // Commit the transaction
            $db->commit();
        } catch (Exception $e) {
            // Roll back the transaction if an exception occurs
            $db->rollBack();
            echo "Failed: " . $e->getMessage();
        }
    }

    function checkIfFormIsSubmit($db){
        // Check if the form is submitted and the get is not empty
        if(isset($_GET['AuthorName']) && isset($_GET['AuthorFirstName']) && isset($_GET['Century']) && isset($_GET['Quote'])){
            // Check if the fields are not empty
            if(!empty($_GET['AuthorName']) && !empty($_GET['AuthorFirstName']) && !empty($_GET['Century']) && !empty($_GET['Quote'])){
                // Add the quote to the database
                addQuotesToDb($db, $_GET['AuthorName'], $_GET['AuthorFirstName'], $_GET['Century'], $_GET['Quote']);
            }
        }
    }
?>