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
            const duracionHoras = form['duracionHoras'].value.trim();
            const duracionMinutos = form['duracionMinutos'].value.trim();

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

            if (precio.length === 0) {
                alert("El campo precio es obligatorio");
                form['precio'].focus();
                return false;
            }

            if (isNaN(precio)) {
                alert("El campo precio debe ser un número");
                form['precio'].focus();
                return false;
            }

            if (duracionHoras === '0' && duracionMinutos === '0') {
                alert("La duración debe ser mayor que 0");
                form['duracionHoras'].focus();
                return false;
            }

            // Verificar si se ha seleccionado una imagen
            const imagen = form['imagen'].value;
            if (imagen === '') {
                alert("El campo imagen es obligatorio");
                form['imagen'].focus();
                return false;
            }

            form.submit();
        }
    </script>
</head>
<body>
    <div id="contenedor">
        <h2 class="titulo2">Guardar Servicio</h2>
        <br><br>
        <form action="guarda_servicio.php" method="POST" name="formulario" enctype="multipart/form-data">
            <div class="campos">
                <label>Nombre: *</label>
                <input type="text" id="nombre" name="nombre" /><br>
                <br>
                <label>Descripción: *</label>
                <textarea id="descripcion" name="descripcion"></textarea><br>
                <br>
                <label>Precio: *</label>
                <input type="text" id="precio" name="precio" /><br>
                <br>

                <label>Duración: *</label>
                <div>
                    <select name="duracionHoras" id="duracionHoras">
                        <option value="0">Horas</option>
                        <?php
                        // Generar opciones para las horas
                        for ($i = 0; $i <= 23; $i++) {
                            echo "<option value='$i'>$i</option>";
                        }
                        ?>
                    </select>
                    <span>:</span>
                    <select name="duracionMinutos" id="duracionMinutos">
                        <option value="0">Minutos</option>
                        <?php
                        // Generar opciones para los minutos
                        for ($i = 0; $i < 60; $i++) {
                            echo "<option value='$i'>$i</option>";
                        }
                        ?>
                    </select>
                </div>
                <br>

                <!-- Campo de imagen -->
                <label>Imagen: *</label>
                <input type="file" name="imagen" accept="image/*" /><br><br>

                <input type="button" value="Aceptar" onclick="validaDatos()">
                <input type="button" value="Volver" onclick="atras()">
                <br>
            </div>
        </form>
    </div>
</body>
</html>
