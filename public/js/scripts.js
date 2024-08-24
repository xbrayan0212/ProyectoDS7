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
