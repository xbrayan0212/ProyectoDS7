<?php
include '../db/conexion_usuario.php';

$usuario = 'admin';
$new_password = '123';
$new_hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
$tipo = 'A';

echo "Hash generado: " . $new_hashed_password . "<br>";

$stmt = $conn->prepare("INSERT INTO usuario (usuario, password, tipo) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $usuario, $new_hashed_password, $tipo);
$stmt->execute();
$stmt->close();
?>
