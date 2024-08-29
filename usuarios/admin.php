<?php
include '../db/conexion_usuario.php';

$usuario = 'admin';
$new_password = '123';
$new_hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

echo "Hash generado: " . $new_hashed_password . "<br>";

$stmt = $conn->prepare("UPDATE usuario SET password = ? WHERE usuario = ?");
$stmt->bind_param("ss", $new_hashed_password, $usuario);
$stmt->execute();
$stmt->close();
?>
