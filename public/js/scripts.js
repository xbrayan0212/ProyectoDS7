//mostrar dinamicamente el contenido del main en home
function loadPage(page) {
    fetch(page)
        .then(response => response.text())
        .then(html => {
            document.getElementById('mainContent').innerHTML = html;
        })
        .catch(error => console.error('Error al cargar la página:', error));
}

function showError(message) {
    const errorDiv = document.querySelector(".error-mensaje");
    if (errorDiv) {
        errorDiv.textContent = message;
        errorDiv.style.backgroundColor = "rgb(180, 15, 15)";
    }
}

function clearErrors() {
    const errorDiv = document.querySelector(".error-mensaje");
    if (errorDiv) {
        errorDiv.textContent = "";
        errorDiv.style.backgroundColor = "transparent";
    }
}

function closeModal(modal, btnClose) {
    if (btnClose) {
        btnClose.onclick = () => modal.style.display = "none";
    }
    window.onclick = event => {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    }
}

function changePassword(event) {
    event.preventDefault();
    const actualPassword = document.getElementById("actual_password").value.trim();
    const newPassword = document.getElementById("new_password").value.trim();
    const confirmPassword = document.getElementById("confirm_password").value.trim();
    const modalExito = document.getElementById("modalExito");
    const closeModalBtn = document.querySelector(".close");

    clearErrors();

    if (newPassword !== confirmPassword) {
        showError("⚠️ Las contraseñas no coinciden.");
        return;
    }
    if (newPassword.length < 8) {
        showError("⚠️ La nueva contraseña debe tener más de 8 caracteres.");
        return;
    }

    const formData = new FormData();
    formData.append('actual_password', actualPassword);
    formData.append('new_password', newPassword);
    formData.append('confirm_password', confirmPassword);

    fetch('../../usuarios/update_password.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            modalExito.style.display = "block";
            document.getElementById("actual_password").value = "";
            document.getElementById("new_password").value = "";
            document.getElementById("confirm_password").value = "";
        } else {
            showError(data.mensaje);
        }
    })
    .catch(() => showError("⚠️ Ocurrió un error. Intente nuevamente."));

    closeModal(modalExito, closeModalBtn);
}

function createUser(event) {
    event.preventDefault();
    const username = document.getElementById("username").value.trim();
    const password = document.getElementById("password").value.trim();
    const confirmPassword = document.getElementById("confirm_password").value.trim();
    const accountType = document.getElementById("account_type").value;
    const modalExito = document.getElementById("modalExito");
    const closeModalBtn = document.querySelector(".close");

    clearErrors();

    if (username.length < 4) {
        showError("⚠️ El usuario debe tener más de 4 caracteres.");
        return;
    }
    if (password !== confirmPassword) {
        showError("⚠️ Las contraseñas no coinciden.");
        return;
    }
    if (password.length < 8) {
        showError("⚠️ La contraseña debe tener más de 8 caracteres.");
        return;
    }

    const formData = new FormData();
    formData.append('username', username);
    formData.append('password', password);
    formData.append('account_type', accountType);

    fetch('../../usuarios/create_user.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            modalExito.style.display = "block";
            exitoMensaje.textContent = data.message; 
            document.getElementById("username").value = "";
            document.getElementById("password").value = "";
            document.getElementById("confirm_password").value = "";
        } else {
            showError(data.mensaje);
        }
    })
    .catch(() => showError("⚠️ Ocurrió un error. Intente nuevamente."));

    closeModal(modalExito, closeModalBtn);
}

function mostrarDelete(usuario) {
    const modalExito = document.getElementById("modalExito");
    const modalError = document.getElementById("modalError");
    const exitoMensaje = document.getElementById("exitoMensaje");
    const errorMensaje = document.getElementById("errorMensaje");
    const closeModalBtns = document.querySelectorAll(".close");

    const formData = new FormData();
    formData.append('usuario', usuario);

    fetch('../../usuarios/delete_users.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {

        if (data.success) {
            exitoMensaje.textContent = data.message; 
            modalExito.style.display = "block";
        } else {
            errorMensaje.textContent = data.message; 
            modalError.style.display = "block";
        }

        // Cerrar los modales cuando se hace clic en el botón de cierre
        closeModalBtns.forEach(btn => {
            btn.onclick = function() {
                modalExito.style.display = "none";
                modalError.style.display = "none";
                loadPage('../../includes/admin/form_admin_usuarios.php'); 
            };
        });

        // Cerrar los modales si se hace clic fuera del contenido del modal
        window.onclick = function(event) {
            if (event.target == modalExito || event.target == modalError) {
                modalExito.style.display = "none";
                modalError.style.display = "none";
                loadPage('../../includes/admin/form_admin_usuarios.php'); 
            }
        };
    })
    .catch(() => {
        errorMensaje.textContent = "⚠️ Ocurrió un error. Intente nuevamente.";
        modalError.style.display = "block";

        // Cerrar el modal de error y cargar la nueva página
        closeModalBtns.forEach(btn => {
            btn.onclick = function() {
                modalError.style.display = "none";
                loadPage('../../includes/admin/form_admin_usuarios.php'); 
            };
        });

        window.onclick = function(event) {
            if (event.target == modalError) {
                modalError.style.display = "none";
            }
        };
    });
}
function openUpdateModal(usuario, tipo) {
    const modalUpdate = document.getElementById("updateModal_update");
    const usuarioMostrar = document.getElementById("usuario_mostrar");
    const selectTipo = document.getElementById("tipo");
    const inputUsuario = document.getElementById("usuario");
    const nuevoUsuario = document.getElementById("nuevo_usuario");

    // Rellena el formulario del modal con los valores del usuario seleccionado
    inputUsuario.value = usuario;
    selectTipo.value = tipo;
    nuevoUsuario.value = usuario;

    modalUpdate.style.display = "block";
}

// Cierra el modal al hacer clic en el botón de cerrar
const closeUpdateModalBtn = document.getElementById("closeModal");
if (closeUpdateModalBtn) {
    closeUpdateModalBtn.onclick = () => {
        document.getElementById("updateModal_update").style.display = "none";
    };
}

// Cierra el modal al hacer clic fuera del contenido del modal
window.onclick = (event) => {
    const modalUpdate = document.getElementById("updateModal_update");
    if (event.target === modalUpdate) {
        modalUpdate.style.display = "none";
    }
};


function updateUser(event) {
    event.preventDefault();
    const usuario = document.getElementById("usuario").value.trim();
    const nuevoUsuario = document.getElementById("nuevo_usuario").value.trim();
    const tipo = document.getElementById("tipo").value;
    const modalExito = document.getElementById("modalExito");
    const exitoMensaje = document.getElementById("exitoMensaje");
    const closeModalBtn = document.querySelector(".close");
    

    clearErrors();

    if (nuevoUsuario.length < 4) {
        showError("⚠️ El nombre de usuario debe tener más de 4 caracteres.");
        return;
    }

    const formData = new FormData();
    formData.append('usuario', usuario);
    formData.append('nuevo_usuario', nuevoUsuario);
    formData.append('tipo', tipo);

    fetch('../../usuarios/update_user.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            console.log(data)
            exitoMensaje.textContent = data.message; 
            modalExito.style.display = "block";
            document.getElementById("nuevo_usuario").value = "";
            openUpdateModal(data.nuevo_usuario, data.tipo) 

        } else {
            showError(data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showError("⚠️ Ocurrió un error. Intente nuevamente.");
    });

    closeModal(modalExito, closeModalBtn);
}
