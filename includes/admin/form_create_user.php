<div class="container_create_user">
    <section class="conteiner_user">
        <div class="img_create_user">
            <img src="../../public/imagenes/user_new.png" alt="Crear Usuario">
        </div>
      
</section>
<section class="section_form_user">
<div  class="error_mensaje"></div>
    <form action="../../usuarios/create_user.php" method="POST" class="form-create_user" onsubmit="createUser(event)">
    <h2 class="h2_user_form">Crear Usuario</h2>
            <div class="form-group_user">
                <label for="username">Nombre de Usuario:</label>
                <input type="text" id="username" name="username" required>
                <div id="errorMensajeUsername" class="errorMensaje"></div>
            </div>
            <div class="form-group_user">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
                <div id="errorMensajePassword" class="errorMensaje"></div>
            </div>
            <div class="form-group_user">
                <label for="confirm_password">Confirmar Contraseña:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
            <div class="form-group_user">
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
   
    <div id="modalExito" class="modal" style="display: none;">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p>¡Usuario creado exitosamente!</p>
        </div>
    </div>
</div>
<script src="../js/scripts.js"></script>