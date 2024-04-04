<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Legg til melding</title>
</head>

<body>
    <?php
    session_start();
    if (!isset ($_SESSION['bruker_id'])) {
        echo "du er ikke logget inn, klikk her for å gå til <a href='index.php'>forsiden</a>";
        exit();
    }

    $bruker_id = $_SESSION['bruker_id'];

    require_once "includes/db_connection.php";

    $query = "SELECT username FROM users WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $bruker_id);

    $stmt->execute();
    $stmt->bind_result($username);
    $row = $stmt->fetch();
    ?>

    <div class="container">

        <h2>Legg til melding</h2>
        <?php
            echo "<p>Du er logget inn som $username og kan nå registrere en melding for $username<p>";
        ?>
        <form action="handlemelding.php" method="post">
            <div class="form-div">
                <label for="navn">Tittel:</label>
                <input type="text" id="navn" name="navn" required>
            </div>
            <div class="form-div">
                <label for="beskrivelse">Beskrivelse:</label>
                <textarea id="beskrivelse" name="beskrivelse" required></textarea>
            </div>
            <div class="form-div">
                <button type="submit" class="button">Send henvendelse</button>
            </div>
        </form>
    </div>
</body>
</html>