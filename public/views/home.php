<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: index.html'); 
    exit();
}
$tipo = $_SESSION['tipo'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio</title>
    <style>
        .admin, .transacciones, .consulta { display: none; }
        .show { display: block; }
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; }
        .container { padding: 20px; }
        h1 { color: #333; }
    </style>
</head>
<body>
    <div class="container">
        <?php if ($tipo === 'A'): ?>
            <div class="admin show">
                <h1>Opciones de Administrador</h1>
                <!-- Aquí puedes añadir más contenido específico para el Administrador -->
            </div>
        <?php elseif ($tipo === 'T'): ?>
            <div class="transacciones show">
                <h1>Opciones de Transacciones</h1>
                <!-- Aquí puedes añadir más contenido específico para Transacciones -->
            </div>
        <?php elseif ($tipo === 'C'): ?>
            <div class="consulta show">
                <h1>Opciones de Consulta</h1>
                <!-- Aquí puedes añadir más contenido específico para Consulta -->
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
