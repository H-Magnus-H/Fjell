<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Handler melding</title>
</head>
<body>
    <?php
        include_once 'includes/db_connection.php';

        session_start();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $bruker_id = $_SESSION['bruker_id'];
            $tittel = $_POST['navn'];
            $beskrivelse = $_POST['beskrivelse'];
            $status = "not fixed";

            $sql = "INSERT INTO problemer (user_id_fk, kategori, Problem, status) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);

            $stmt->bind_param("isss", $bruker_id, $tittel, $beskrivelse, $status);

            if ($stmt->execute()) {
                $saksnummer = $conn->insert_id;
                echo' <div class="container">';
                echo "Meldingen er blit sendt dit saksnummer er: $saksnummer <br>";
                echo "gå til bake til forside <a href='index.php'>forside</a> <br>
                eller gå tilbake til <a href='vis_melding.php'>din side</a> <br>";
                echo '</div>';
            } else {
                echo "Feil: " . $sql . "<br>" . $conn->error;
            }
            $stmt->close();
        }
        $conn->close();
    ?>
</body>
</html>

