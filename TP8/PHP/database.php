<?php
    include('./constants.php');
    function dbConnect() {
        $dsn = 'pgsql:dbname=' . DB_NAME . ';host=' . DB_SERVER . ';port=' . DB_PORT;
        try {
            $conn = new PDO($dsn, DB_USER, DB_PASSWORD);
            echo "Connected successfully\n";
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
?>