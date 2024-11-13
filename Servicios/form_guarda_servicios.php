<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Guardar Servicio</title>
    <link rel="stylesheet" type="text/css" href="../src/css/estilos.css">

    <script type="text/javascript">
        function atras() {
            window.location = "../admin.php";
        }

        function validaDatos() {
            const form = document.forms['formulario'];
            const nombre = form['nombre'].value.trim();
            const descripcion = form['descripcion'].value.trim();
            const precio = form['precio'].value.trim();
            const duracion = form['duracion'].value.trim();
            const img = form['img'].value;

            if (nombre.length === 0) {
                alert("El campo nombre es obligatorio");
                form['nombre'].focus();
                return false;
            }

            if (descripcion.length === 0) {
                alert("El campo descripción es obligatorio");
                form['descripcion'].focus();
                return false;
            }

            if (precio.length === 0 || isNaN(precio)) {
                alert("El campo precio es obligatorio y debe ser un número");
                form['precio'].focus();
                return false;
            }

            if (duracion.length === 0 || isNaN(duracion)) {
                alert("El campo duración es obligatorio y debe ser un número");
                form['duracion'].focus();
                return false;
            }

            if (img.length === 0) {
                alert("Por favor selecciona una imagen");
                form['img'].focus();
                return false;
            }

            form.submit();
        }
    </script>
</head>
<body>
    <div id="contenedor">
        <span><?php echo "Conectado: " . (isset($_SESSION["usuario"]) ? $_SESSION["usuario"] : ''); ?></span>

        <h2 class="titulo2">Guardar Servicio</h2>
        <br><br>
        <form action="guarda_servicios.php" method="POST" name="formulario" enctype="multipart/form-data">
            <div class="campos">
                <label>Nombre: *</label>
                <input type="text" id="nombre" name="nombre" /><br>
                <br>
                <label>Descripción: *</label>
                <input type="text" id="descripcion" name="descripcion" /><br>
                <br>
                <label>Precio: *</label>
                <input type="text" id="precio" name="precio" /><br>
                <br>
                <label>Duración (min): *</label>
                <input type="text" id="duracion" name="duracion" /><br>
                <br>
                <label>Imagen: *</label>
                <input type="text" id="img" name="img" accept="image/*" /><br>
                <br>
                <input type="button" value="Aceptar" onclick="validaDatos()">
                <input type="button" value="Volver" onclick="atras()">
                <br>
            </div>
        </form>
    </div>
</body>
</html>
