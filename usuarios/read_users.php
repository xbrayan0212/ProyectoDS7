<?php
session_start();
require_once '../../db/conexion_usuario.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $stmt = $conn->prepare("SELECT * FROM usuario");
    $stmt->execute();
    $result = $stmt->get_result();

    // Crear un array para almacenar los usuarios
    $users = [];
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
} else {
    echo "Método de solicitud no permitido.";
}
?>
