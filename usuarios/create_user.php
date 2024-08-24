<?php
session_start();
include '../db/conexion_usuario.php';

$response = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $account_type = $_POST['account_type'];

    // Validar campos vacíos
    if (empty($username) || empty($password) || empty($account_type)) {
        $response['success'] = false;
        $response['mensaje'] = 'Por favor, complete todos los campos.';
    }
    elseif (strlen($password) < 8) {
        $response['success'] = false;
        $response['mensaje'] = 'La contraseña debe tener al menos 8 caracteres.';
    } else {
        $stmt = $conn->prepare("SELECT usuario FROM usuario WHERE usuario = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $response['success'] = false;
            $response['mensaje'] = 'El nombre de usuario ya existe.';
        } else {
            // Hashear la contraseña
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);

            $insert_stmt = $conn->prepare("INSERT INTO usuario (usuario, password, tipo) VALUES (?, ?, ?)");
            $insert_stmt->bind_param("sss", $username, $hashed_password, $account_type);

            if ($insert_stmt->execute()) {
                $response['success'] = true;
                $response['mensaje'] = 'Usuario creado exitosamente.';
            } else {
                $response['success'] = false;
                $response['mensaje'] = 'Error al crear el usuario: ' . $conn->error;
            }
            $insert_stmt->close();
        }
        $stmt->close();
    }
    $conn->close();
    echo json_encode($response);
}
?>
