<?php
include '../db/conexion_usuario.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    if(empty($usuario) || empty($password)) {
        echo 'Por favor, complete todos los campos.';
    } else {
        $sql = "SELECT * FROM usuario WHERE usuario = '$usuario' AND password = '$password'";
        $result = $conn->query($sql);

        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $tipo = $row['tipo'];
            if($tipo == 'A'){
                echo 'administrador' . $tipo;
            }elseif ($tipo =='T') {
                echo 'transacciones';
            }elseif($tipo == 'C'){
                echo 'Consulta';
            }
        } else {
            echo "Usuario o contraseña incorrectos.";
        }
    }
}
?>