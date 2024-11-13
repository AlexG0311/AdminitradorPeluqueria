<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Guardar Usuario</title>
    <link rel="stylesheet" type="text/css" href="../src/css/estilos.css">

    <script type="text/javascript">
        function atras() {
            window.location = "../admin.php";
        }

        function validaDatos() {
            const form = document.forms['formulario'];
            const nombre = form['nombre'].value.trim();
            const apellidos = form['apellidos'].value.trim();
            const email = form['email'].value.trim();
            const pass = form['pass'].value.trim();
            const telefono = form['telefono'].value.trim();

            if (nombre.length === 0) {
                alert("El campo nombre es obligatorio");
                form['nombre'].focus();
                return false;
            }

            if (apellidos.length === 0) {
                alert("El campo apellidos es obligatorio");
                form['apellidos'].focus();
                return false;
            }

            if (email.length === 0) {
                alert("El campo email es obligatorio");
                form['email'].focus();
                return false;
            }

            const expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (!expr.test(email)) {
                alert("Error: La dirección de email " + email + " es incorrecta.");
                form['email'].focus();
                return false;
            }

            if (pass.length === 0) {
                alert("El campo password es obligatorio");
                form['pass'].focus();
                return false;
            }

            if (telefono.length === 0) {
                alert("El campo teléfono es obligatorio");
                form['telefono'].focus();
                return false;
            }

            form.submit();
        }
    </script>
</head>
<body>
    <div id="contenedor">
      

        <h2 class="titulo2">Guarda usuario</h2>
        <br><br>
        <form action="guarda_usuario.php" method="POST" name="formulario">
            <div class="campos">
                <label>Nombre: *</label>
                <input type="text" id="nombre" name="nombre" /><br>
                <br>
                <label>Apellidos: *</label>
                <input type="text" id="apellidos" name="apellidos" /><br>
                <br>
                <label>Email: *</label>
                <input type="text" id="email" name="email" /><br>
                <br>
                <label>Password: *</label>
                <input type="password" id="pass" name="pass" /><br>
                <br>
                <label>Teléfono: *</label>
                <input type="text" id="telefono" name="telefono" /><br>
                <br>
                <input type="button" value="Aceptar" onclick="validaDatos()">
                <input type="button" value="Volver" onclick="atras()">
                <br>
            </div>
        </form>
    </div>
</body>
</html>
