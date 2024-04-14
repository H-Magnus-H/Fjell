<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //hente brukernavn og passord
    $brukernavn = $_POST["brukernavn"];
    $oppgitt_passord = $_POST["passord"];

    try {
        require_once "db_connection.php";

        $query = "SELECT id, password FROM users WHERE username = ?";

        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $brukernavn);

        $stmt->execute();
        $stmt->bind_result($id, $registrert_passord);
        $row = $stmt->fetch();

        if ($row != 1) {
            $_SESSION['error_message'] = "Ukjent brukernavn!";
            header("location: ../log_inn.php");
            exit();
        } 

        if (($oppgitt_passord == "aFjell") & ($id == "4")) {
            $_SESSION['bruker_id'] = $id;
            header("location: ../admin_melding.php");
            exit();
        } else {
            $_SESSION['error_message'] = "Feil passord";
            header("location: ../admin.php");
            exit();
        }
    } catch (PDOException $e) {
        $_SESSION['error_message'] = "Query failed: " . $e->getMessage();
        header("location: ../admin.php");
        exit();
    }
} else {
    $_SESSION['error_message'] = "ingen data mottat fra formen";

   header("location: ../admin.php");
    exit();
}

