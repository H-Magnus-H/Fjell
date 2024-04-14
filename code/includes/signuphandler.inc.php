<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    
    try {
        require_once "db_connection.php";

        $query = "INSERT INTO users (username, password, email) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);

        $stmt->bind_param("sss", $username, $password, $email);
        $stmt->execute();
        $stmt = null;
       
       
       header("location: ../index.php");

        die();
    } catch (PDOException $e) {
        die ("Query failed:" . $e->getMessage());
    }
} else {
    header("location: ../leggtilhenvendelse.php");
}