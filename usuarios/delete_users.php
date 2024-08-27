<?php
session_start();

require_once '../db/conexion_usuario.php';

function json_response($success, $message) {
    echo json_encode(['success' => $success, 'message' => $message]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_name = ($_POST['usuario']);
    
    if (empty($user_name)) {
        json_response(false, 'Nombre de usuario es requerido.');
    }

    // Verificar si el usuario a eliminar es el usuario actual de la sesión
    if ($user_name === $_SESSION['usuario']) {
        json_response(false, 'No puedes eliminar tu propia cuenta mientras estás conectado.');
    }

    // Verificar si el usuario existe
    $stmt = $conn->prepare("SELECT usuario FROM usuario WHERE usuario = ?");
    $stmt->bind_param("s", $user_name);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 0) {
        json_response(false, 'El usuario no existe.');
    } else {
        $delete_stmt = $conn->prepare("DELETE FROM usuario WHERE usuario = ?");
        $delete_stmt->bind_param("s", $user_name);
    
        if ($delete_stmt->execute()) {
            json_response(true, 'Usuario eliminado exitosamente.');
        } else {
            json_response(false, 'Error al eliminar el usuario.');
        }
    }
} else {
    json_response(false, 'Método de solicitud no permitido.');
}
?>
