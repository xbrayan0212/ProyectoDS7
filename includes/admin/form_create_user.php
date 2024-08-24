<div class="container">
    <section class="form-container form_creat_user">
        <div class="img-container img_container_create_user">
            <img src="../../public/imagenes/user_new.png" alt="Crear Usuario">
        </div>
        <form action="../../usuarios/create_user.php" method="POST" class="form" onsubmit="createUser(event)">
        <div class="error-mensaje"></div>
            <h2 class="h2-user-form">Crear Usuario</h2>
            <div class="form-group">
                <label for="username">Nombre de Usuario:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirmar Contraseña:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
            <div class="form-group">
                <label for="account_type">Tipo de Cuenta:</label>
                <select id="account_type" name="account_type" required>
                    <option value="A">Administrador</option>
                    <option value="T">Transacciones</option>
                    <option value="C">Consulta</option>
                </select>
            </div>
            <button type="submit" class="btn">Crear Usuario</button>
        </form>
    </section>
</div>
   
<div id="modalExito" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close">&times;</span>
        <p>¡Acción realizada exitosamente!</p>
    </div>
</div>
<script src="../js/scripts.js"></script>