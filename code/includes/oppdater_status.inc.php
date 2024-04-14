<?php
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the user is logged in
    if (!isset($_SESSION["bruker_id"])) {
        $_SESSION['error_message'] = "Du må være logget inn for å oppdatere status";
        header("location: ../admin.php");
        exit();
    }

    // Check if saksnummer and ny_status are set in the POST data
    if (isset($_POST["saksnummer"]) && isset($_POST["ny_status"])) {
        $saksnummer = $_POST["saksnummer"];
        $ny_status = $_POST["ny_status"];

        // Update status in the database
        try {
            require_once "db_connection.php";

            // Prepare and execute the update query
            $query = "UPDATE problemer SET status = ? WHERE id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("si", $ny_status, $saksnummer);
            $stmt->execute();

            // Close statement and database connection
            $stmt->close();
            $conn->close();

            // Redirect back to the page where the form was submitted from
            header("location: {$_SERVER['HTTP_REFERER']}");
            exit();
        } catch (PDOException $e) {
            $_SESSION['error_message'] = "Feil ved oppdatering av status: " . $e->getMessage();
            header("location: ../admin.php");
            exit();
        }
    } else {
        $_SESSION['error_message'] = "Ugyldig forespørsel";
        header("location: ../admin.php");
        exit();
    }
} else {
    $_SESSION['error_message'] = "Ugyldig forespørsel";
    header("location: ../admin.php");
    exit();
}

