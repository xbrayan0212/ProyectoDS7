<div class="container_user">
    <h1 class="h1_users">Gestión de Usuarios</h1>
    <a href="#" class="btn_create_user" onclick="loadPage('../../includes/admin/form_create_user.php')">Crear Nuevo Usuario</a>

    <table class="table_users">
        <thead>
            <tr>
                <th class="th_users">Usuario</th>
                <th class="th_users">Tipo</th>
                <th class="th_users">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <!-- Aquí se listarán los usuarios desde la base de datos -->
            <?php
              include '../../usuarios/read_users.php';
            ?>
             
             <?php if (!empty($users)): ?>
                    <?php foreach ($users as $user): ?>
                        <tr class="tr_users">
                            <td class="td_users"><?php echo htmlspecialchars($user['usuario']); ?></td>
                            <td class="td_users"><?php echo htmlspecialchars($user['tipo']); ?></td>
                            <td class="td_users action-btns_user">
                            <a href="#" class="btn_edit_user" onclick="openUpdateModal('<?php echo htmlspecialchars($user['usuario']); ?>', '<?php echo htmlspecialchars($user['tipo']); ?>')">✏️</a>
                                <a href="#" class="btn_delete_user" onclick="if (confirm('¿Estás seguro de que deseas eliminar este usuario?')) { mostrarDelete('<?php echo urlencode($user['usuario']); ?>'); return false; } else { return false; }">X</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="td_users">No se encontraron usuarios.</td>
                    </tr>
            <?php endif; ?>

        </tbody>
    </table>
</div>
<div id="updateModal_update" class="modal hidden">
        <div class="modal-content">
            <button id="closeModal" class="modal_close" onclick="loadPage('../../includes/admin/form_admin_usuarios.php')">&times;</button>
            <div class="update_container">
                <h1 class="update_title">Actualizar Usuario</h1>
                <div class="error-mensaje"></div>
                <form action="process_update_user.php" method=" POST" onsubmit="updateUser(event)">

                       <!-- Campo oculto para el usuario actual -->
                       <input type="hidden" id="usuario" name="usuario" >



                    <!-- Campo para el nuevo nombre de usuario -->
                    <label for="nuevo_usuario" class="update_label">Usuario:</label>
                    <input type="text" id="nuevo_usuario" name="nuevo_usuario"  class="update_input">

                    <label for="tipo" class="update_label">Tipo:</label>
                    <select id="tipo" name="tipo" required class="update_select">
                    <option value="A" <?php echo $user['tipo'] === 'A' ? 'selected' : ''; ?>>Admin</option>
                    <option value="T" <?php echo $user['tipo'] === 'T' ? 'selected' : ''; ?>>Transacciones</option>
                    <option value="C" <?php echo $user['tipo'] === 'C' ? 'selected' : ''; ?>>Consulta</option>
                    </select>

                    <button type="submit" class="update_button">Actualizar</button>
                </form>
            </div>
        </div>
    </div>
    <?php include '../general/modals.php'; ?>

<script src="../js/scripts.js"></script> 