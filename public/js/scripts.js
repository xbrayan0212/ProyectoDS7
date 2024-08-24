//mostrar dinamicamente el contenido del main en home
function loadPage(page) {
    fetch(page)
        .then(response => response.text())
        .then(html => {
            document.getElementById('mainContent').innerHTML = html;
        })
        .catch(error => console.error('Error al cargar la página:', error));
}


function changePassword(event) {
    event.preventDefault();

    var actual_password = document.getElementById("actual_password").value.trim();
    var new_password = document.getElementById("new_password").value.trim();
    var confirm_password = document.getElementById("confirm_password").value.trim();

    var errorMensajeDiv = document.querySelector(".error_mensaje");
    var pass_new_error = document.querySelector(".errorMensajeNew");
    var modalExito = document.getElementById("modalExito");
    var closeModalBtn = document.querySelector(".close");

    // Limpiar los mensajes de error anteriores
    if (errorMensajeDiv) {
        errorMensajeDiv.textContent = ""; 
        errorMensajeDiv.style.backgroundColor = "transparent";
    }
    if (pass_new_error) {
        pass_new_error.textContent = ""; 
        pass_new_error.style.backgroundColor = "transparent";
    }

    // Validar que las contraseñas coinciden
    if (new_password !== confirm_password) {
        if (errorMensajeDiv) {
            errorMensajeDiv.textContent = "⚠️ Las contraseñas no coinciden.";
            errorMensajeDiv.style.backgroundColor = "rgb(180, 15, 15)";
        }
        return;
    }

    // Validar que las contraseñas tengan al menos 8 caracteres
    if (confirm_password.length < 8 || new_password.length < 8) {
        if (pass_new_error) {
            pass_new_error.textContent = "⚠️ La contraseña debe tener más de 8 caracteres.";
            pass_new_error.style.backgroundColor = "rgb(180, 15, 15)";
        }
        return;
    }

    // Preparar los datos para enviar al servidor
    var formData = new FormData();
    formData.append('actual_password', actual_password);
    formData.append('new_password', new_password);
    formData.append('confirm_password', confirm_password);

    // Enviar la solicitud al servidor
    fetch('../../usuarios/update_password.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Mostrar el modal de éxito
            modalExito.style.display = "block";
            // Limpiar los campos del formulario
            document.getElementById("actual_password").value = "";
            document.getElementById("new_password").value = "";
            document.getElementById("confirm_password").value = "";
        } else {
            // Mostrar el mensaje de error
            if (errorMensajeDiv) {
                errorMensajeDiv.textContent = data.mensaje;
                errorMensajeDiv.style.backgroundColor = "rgb(180, 15, 15)";
            }
        }
    })
    .catch(error => {
        console.error('Error:', error);
        if (errorMensajeDiv) {
            errorMensajeDiv.textContent = "⚠️ Ocurrió un error. Intente nuevamente.";
            errorMensajeDiv.style.backgroundColor = "rgb(180, 15, 15)";
        }
    });

    // Cerrar el modal cuando se hace clic en la "X"
    closeModalBtn.onclick = function() {
        modalExito.style.display = "none";
    }

    // Cerrar el modal cuando se hace clic fuera de él
    window.onclick = function(event) {
        if (event.target == modalExito) {
            modalExito.style.display = "none";
        }
    }
}

// Función para crear un nuevo usuario
function createUser(event) {
    event.preventDefault();

    var username = document.getElementById("username").value.trim();
    var password = document.getElementById("password").value.trim();
    var confirm_password = document.getElementById("confirm_password").value.trim();
    var account_type = document.getElementById("account_type").value;

    var errorMensajeDiv = document.querySelector(".error_mensaje");
    var modalExito = document.getElementById("modalExito");
    var closeModalBtn = document.querySelector(".close");

    // Limpiar los mensajes de error anteriores
    if (errorMensajeDiv) {
        errorMensajeDiv.textContent = ""; 
        errorMensajeDiv.style.backgroundColor = "transparent";
    }

    // Validar que las contraseñas coinciden
    if (password !== confirm_password) {
        if (errorMensajeDiv) {
            errorMensajeDiv.textContent = "⚠️ Las contraseñas no coinciden.";
            errorMensajeDiv.style.backgroundColor = "rgb(180, 15, 15)";
        }
        return;
    }

    // Validar que las contraseñas tengan al menos 8 caracteres
    if (confirm_password.length < 8 || password.length < 8) {
        if (errorMensajeDiv) {
            errorMensajeDiv.textContent = "⚠️ La contraseña debe tener más de 8 caracteres.";
            errorMensajeDiv.style.backgroundColor = "rgb(180, 15, 15)";
        }
        return;
    }

    // Preparar los datos 
    var formData = new FormData();
    formData.append('username', username);
    formData.append('password', password);
    formData.append('account_type', account_type);

    // Enviar 
    fetch('../../usuarios/create_user.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Mostrar el modal de éxito
            modalExito.style.display = "block";
            // Limpiar los campos del formulario
            document.getElementById("username").value = "";
            document.getElementById("password").value = "";
            document.getElementById("confirm_password").value = "";
        } else {
            // Mostrar el mensaje de error
            if (errorMensajeDiv) {
                errorMensajeDiv.textContent = data.mensaje;
                errorMensajeDiv.style.backgroundColor = "rgb(180, 15, 15)";
            }
        }
    })
    .catch(error => {
        console.error('Error:', error);
        if (errorMensajeDiv) {
            errorMensajeDiv.textContent = "⚠️ Ocurrió un error. Intente nuevamente.";
            errorMensajeDiv.style.backgroundColor = "rgb(180, 15, 15)";
        }
    });

    // Cerrar el modal cuando se hace clic en la "X"
    closeModalBtn.onclick = function() {
        modalExito.style.display = "none";
    }

    // Cerrar el modal cuando se hace clic fuera de él
    window.onclick = function(event) {
        if (event.target == modalExito) {
            modalExito.style.display = "none";
        }
    }
}
