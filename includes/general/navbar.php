<header class="header">
    <div class="container">
        <a href="#" class="logo">Proyecto</a>
        <div class="menu-toggle" id="menu-toggle">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <nav class="nav" id="nav-menu">
            <a href="#" class="nav-link">Inicio</a>
            <div class="user-info" id="user-info">
               <img class="icon-user" src="../../public/imagenes/icons8-user-24.png" alt="hola"> <a class="nav-link" id="user-name"><?php echo htmlspecialchars($_SESSION['usuario']); ?></a>
               <div class="user-dropdown" id="user-dropdown">
                   <a href="#" class="nav-link">Cambiar Contraseña</a>
                  <a href="../../usuarios/logout.php" class="nav-link">Salir</a>
               </div>
            </div>
        </nav>
    </div>
</header>
<script>
    // JavaScript para abrir y cerrar el menú en dispositivos móviles
    const menuToggle = document.getElementById('menu-toggle');
    const navMenu = document.getElementById('nav-menu');

    menuToggle.addEventListener('click', () => {
        console.log('Menu toggle clicked');
        navMenu.classList.toggle('nav-open');
    });
    
</script>

