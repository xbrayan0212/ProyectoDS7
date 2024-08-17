<?php
$servername = "localhost";
$username = "d72024";
$password = "1234567";
$dbname = "control";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>

