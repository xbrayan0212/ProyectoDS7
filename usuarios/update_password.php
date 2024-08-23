<?php
session_start();
include '../db/conexion_usuario.php';

$response = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $actual_password = $_POST['actual_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if (empty($actual_password) || empty($new_password) || empty($confirm_password)) {
        $response['success'] = false;
        $response['mensaje'] = 'Por favor, complete todos los campos.';
    } elseif ($new_password !== $confirm_password) {
        $response['success'] = false;
        $response['mensaje'] = 'Las contraseñas no coinciden.';
    } elseif (strlen($new_password) < 8) {
        $response['success'] = false;
        $response['mensaje'] = 'La contraseña debe tener al menos 8 caracteres.';
    } else {
        $usuario = $_SESSION['usuario'];

        // Obtener la contraseña hasheada actual del usuario
        $sql = "SELECT password FROM usuario WHERE usuario = '$usuario'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $hashed_password = $row['password'];

            // Verificar la contraseña actual
            if (password_verify($actual_password, $hashed_password)) {
                // Hashear la nueva contraseña
                $new_hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

                // Actualizar
                $update_sql = "UPDATE usuario SET password = '$new_hashed_password' WHERE usuario = '$usuario'";
                if ($conn->query($update_sql) === TRUE) {
                    $response['success'] = true;
                    $response['mensaje'] = 'Contraseña cambiada exitosamente.';
                } else {
                    $response['success'] = false;
                    $response['mensaje'] = 'Error al cambiar la contraseña. Inténtelo nuevamente.';
                }
            } else {
                $response['success'] = false;
                $response['mensaje'] = 'La contraseña actual es incorrecta.';
            }
        } else {
            $response['success'] = false;
            $response['mensaje'] = 'Usuario no encontrado.';
        }
    }

    echo json_encode($response);
}
?>
