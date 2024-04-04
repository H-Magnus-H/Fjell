<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Tilbakemeling</title>
</head>
<body>
    <div class="container">
    <?php
        session_start();
        $bruker_id = $_SESSION["bruker_id"];

        if (!isset($bruker_id)) {
            echo "du må være logget inn for å kunne vise meldinger  <a href='index.php'>tilbake til forsiden</a>";
            exit();
        }
    ?>
    <h1>Meldinger</h1>
    Send inn en melding her <a class="astyle" href="leggtilmelding.php">Send melding</a> <br>
    <br>
    eller gå tilbake til <a class="astyle" href="index.php">forsiden</a> <br>
    <br>

    <?php
        $bruker_id = $_SESSION["bruker_id"];
        try {
            require_once "includes/db_connection.php";

            $query = "SELECT username FROM users WHERE id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $bruker_id);

            $stmt->execute();
            $stmt->bind_result($brukernavn);
            $row = $stmt->fetch();
            $stmt->close();

            if ($row != 1) {
                echo "brukeren finnes ikke, prøv igjen";
            }
            echo "Du har logget in som $brukernavn. Under vil du se alle meldingene dine<br>";
            
            $query = "SELECT p.id, p.kategori, p.status, u.username 
                FROM problemer AS p 
                INNER JOIN users AS u ON p.user_id_fk = u.id 
                WHERE p.user_id_fk = ?";
            
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $bruker_id);
            $stmt->execute();
            $stmt->bind_result($saksnummer, $kategori, $status, $username);


            echo "<table class='styletable'>";
            echo "<tr>";
            echo "<th>saksnummer</th><th>bruker</th><th>kategori</th><th>status</th>";
            echo "</tr>\n";

            while ($stmt->fetch()) {
                if ($status == "") {
                $status = "registrert";
                }
                echo "<tr>\n";
                echo "<td>$saksnummer</td><td>$username</td><td>$kategori</td><td>$status</td>";
                echo "</tr>\n";
            }
            echo "</table>";

        } catch (PDOException $e) {
            $_SESSION['error_message'] = "Query failed: " . $e->getMessage();
            header("location: ../log_inn.php");
        echo"feil";
            exit();
        }
    ?>
    </div>
</body>
</html>