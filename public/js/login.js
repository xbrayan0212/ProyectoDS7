function verificarUsuario(event) {
    var formulario = document.getElementById("formulario-login");
    event.preventDefault(); // evitar mandar el formulario automáticamente

    var username = document.getElementById("usuario").value.trim();
    var password = document.getElementById("password").value.trim();

    if (username === "" || password === "") {
        alert("Todos los datos son obligatorios");
        return;
    }

    var formData = new FormData(formulario);
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var respuesta = JSON.parse(xhr.responseText);
            if (respuesta.success) {
                if (respuesta.redirect) {
                    window.location.href = respuesta.redirect;
                } else {
                    alert(respuesta.mensaje);
                }
            } else {
                var error = document.getElementById("mensajeError");
                error.innerHTML = respuesta.mensaje;
            }
        }
    };
    xhr.open('POST', '../usuarios/login.php', true);
    xhr.send(formData);
}

