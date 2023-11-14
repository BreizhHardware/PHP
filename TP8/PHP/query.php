<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    include('database.php');
    $conn = dbConnect();
?>

<h1>Auteurs de la BD</h1>
<table>
    <thead>
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $authors = dbGetAuthorsNames($conn);
            foreach ($authors as $author) {
                echo "<tr>";
                echo "<td>" . $author['nom'] . "</td>";
                echo "<td>" . $author['prenom'] . "</td>";
                echo "</tr>";
            }
        ?>
    </tbody>
</table>

<hr>

<h1>Citations de la BD</h1>
<?php
    $quotes = dbGetQuotes($conn);
    foreach ($quotes as $quote) {
        echo "<p>" . $quote['phrase'] . "</p>";
    }
?>

<hr>

<h1>Siecle de la BD</h1>
<?php
    $centuries = dbGetCenturies($conn);
    foreach ($centuries as $century) {
        echo "<p>" . $century['numero'] . "</p>";
    }
?>