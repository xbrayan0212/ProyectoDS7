<?php
session_start();
require_once '../db/conexion_usuario.php';

$response = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $nuevoUsuario = $_POST['nuevo_usuario'];  // Nombre de usuario nuevo (si aplica)
    $tipo = $_POST['tipo'];

    $response['usuario'] = $usuario;
    $response['nuevo_usuario'] = $nuevoUsuario;
    $response['tipo'] = $tipo;
    
    // Validaciones
    if (empty($usuario) || empty($nuevoUsuario) || empty($tipo)) {
        $response['success'] = false;
        $response['message'] = 'Por favor, complete todos los campos.';
    } elseif (strlen($nuevoUsuario) < 4) {
        $response['success'] = false;
        $response['message'] = 'El nombre de usuario debe tener al menos 4 caracteres.';
    } else {
        // Verificar si el nuevo nombre de usuario es el mismo que el actual
        if ($nuevoUsuario === $usuario) {
            // Solo actualizar el tipo
            $update_stmt = $conn->prepare("UPDATE usuario SET tipo = ? WHERE usuario = ?");
            $update_stmt->bind_param("ss", $tipo, $usuario);

            if ($update_stmt->execute()) {
                $response['success'] = true;
                $response['message'] = 'Tipo de usuario actualizado exitosamente.';
            } else {
                $response['success'] = false;
                $response['message'] = 'Error al actualizar el tipo de usuario: ' . $conn->error;
            }
            $update_stmt->close();
        } else {
            // Verificar si el nuevo nombre de usuario ya existe
            $check_stmt = $conn->prepare("SELECT COUNT(*) FROM usuario WHERE usuario = ?");
            $check_stmt->bind_param("s", $nuevoUsuario);
            $check_stmt->execute();
            $check_stmt->bind_result($count);
            $check_stmt->fetch();
            $check_stmt->close();

            if ($count > 0) {
                $response['success'] = false;
                $response['message'] = 'El nombre de usuario ya está en uso.';
            } else {
                // Intento de actualización en la base de datos
                $update_stmt = $conn->prepare("UPDATE usuario SET usuario = ?, tipo = ? WHERE usuario = ?");
                $update_stmt->bind_param("sss", $nuevoUsuario, $tipo, $usuario);

                if ($update_stmt->execute()) {
                    $response['success'] = true;
                    $response['message'] = 'Usuario actualizado exitosamente.';
                } else {
                    $response['success'] = false;
                    $response['message'] = 'Error al actualizar el usuario: ' . $conn->error;
                }
                $update_stmt->close();
            }
        }
    }
    $conn->close();
    echo json_encode($response);
    exit; 
} else {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
    exit;
}
?>
