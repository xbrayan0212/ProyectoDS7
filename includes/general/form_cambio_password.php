
<div class="containerForm">
<section class="form-container">
        <h2>Cambiar Contraseña</h2>
        <div class="img-container">
            <img src="../../public/imagenes/clave.png" alt="Cambiar Contraseña">
        </div>
        <div class="error-mensaje"></div>
        <form action="procesar_cambio_password.php" method="POST" class="form" onsubmit="changePassword(event)">
            <div class="form-group">
                <label for="actual_password">Contraseña Actual:</label>
                <input type="password" id="actual_password" name="actual_password" required>
                <div id="errorMensajeNew" class="errorMensajeNew"></div>
            </div>
            <div class="form-group">
                <label for="new_password">Nueva Contraseña:</label>
                <input type="password" id="new_password" name="new_password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirmar Nueva Contraseña:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
            <button type="submit" class="btn">Cambiar Contraseña</button>
        </form>
    </section>
</div>

<div id="modalExito" class="modal" style="display: none;">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p>¡Contraseña cambiada exitosamente!</p>
        </div>
</div>

<script src="../js/scripts.js"></script>