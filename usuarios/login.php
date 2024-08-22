<?php
include '../db/conexion_usuario.php';

$response = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    if(empty($usuario) || empty($password)) {
        $response['success'] = false;
        $response['mensaje'] =  'Por favor, complete todos los campos.';
    } else {
        $sql = "SELECT * FROM usuario WHERE usuario = '$usuario' AND password = '$password'";
        $result = $conn->query($sql);

        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $tipo = $row['tipo'];
            $response['success'] = true;
            if($tipo == 'A'){
                $response['mensaje'] =  'administrador' . $tipo;
                $response['redirect'] = 'views/administrador.html';
            }elseif ($tipo =='T') {
                $response['mensaje'] = 'transacciones';
                $response['redirect'] = 'views/transacciones.html';
            }elseif($tipo == 'C'){
                $response['mensaje'] =  'Consulta';
                $response['redirect'] = 'views/consultas.html';
            }
        } else {
            $response['success'] = false;
            $response['mensaje'] =  "Usuario o contraseña incorrectos";
        }
    }
    echo json_encode($response);
}
?>