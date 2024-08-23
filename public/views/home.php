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
    <link rel="stylesheet" href="../css/style.css"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div class="page-container">
        <header>
            <?php include '../../includes/general/navbar.php'; ?>
        </header>
        <main class="main" id="mainContent">
            <?php if ($tipo === 'A'): ?>
            <?php elseif ($tipo === 'T'): ?>
            <?php elseif ($tipo === 'C'): ?>
            <?php endif; ?>
        </main>
        <footer>
            <?php include '../../includes/general/footer.php'; ?>
        </footer>  
    </div>  
</body>
<script src="../js/scripts.js"></script>
</html>
