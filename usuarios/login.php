<?php
session_start();
require_once '../db/conexion_usuario.php';

$response = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    if(empty($usuario) || empty($password)) {
        $response['success'] = false;
        $response['mensaje'] =  'Por favor, complete todos los campos.';
    } else {
        $sql = "SELECT * FROM usuario WHERE usuario = '$usuario'";
        $result = $conn->query($sql);

        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $hashed_password = $row['password']; //hash a password
            $tipo = $row['tipo'];
            if(password_verify($password, $hashed_password)){
                $response['success'] = true;
                $_SESSION['usuario'] = $usuario;
                $_SESSION['tipo'] = $tipo;
                $_SESSION['time'] = time();
                $response['redirect'] = 'views/home.php';
            } else {
                $response['success'] = false;
                $response['mensaje'] = 'Usuario o contraseña incorrectos';
            }
    
        }else{
            $response['success'] = false;
            $response['mensaje'] =  "Usuario o contraseña incorrectos";
        }
    }
    echo json_encode($response);
}
?>