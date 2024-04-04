<?php
$servername = "localhost";
$bruker = "root";
$passord = "";
$dbname = "uke_12_prove";

$conn = mysqli_connect($servername, $bruker, $passord, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

