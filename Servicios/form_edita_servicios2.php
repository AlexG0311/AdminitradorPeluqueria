<?php
session_start();
require_once("../conexion_api.php");

if (!isset($_POST['idServicio']) || $_POST['idServicio'] == '0') {
    echo "<script>alert('No se ha seleccionado un servicio para editar'); window.location='form_edita_servicio.php';</script>";
    exit;
}

$idServicio = $_POST['idServicio'];
$api = new ConexionAPI();
$servicio = $api->get("/Servicios/" . urlencode($idServicio));

if (!$servicio || !is_array($servicio)) {
    echo "<script>alert('No se pudo obtener la información del servicio'); window.location='form_edita_servicio.php';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Modificar Servicio</title>
    <link rel="stylesheet" type="text/css" href="../src/css/estilos.css">
    <script type="text/javascript" language="javascript">
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

            if (precio.length === 0 || isNaN(precio)) {
                alert("El campo precio es obligatorio y debe ser un número");
                form['precio'].focus();
                return false;
            }

            if (duracionHoras === '0' && duracionMinutos === '0') {
                alert("La duración debe ser mayor que 0");
                form['duracionHoras'].focus();
                return false;
            }

            form.submit();
        }
    </script>
</head>
<body>
    <div id="contenedor">
        <h2 class="titulo2">Editar Servicio: <?php echo htmlspecialchars($servicio['Nombre']); ?></h2>
        <form action="edita_servicios.php" method="POST" name="formulario">
            <div class="campos">
                <label>Nombre: *</label>
                <input type="text" name="nombre" value="<?php echo htmlspecialchars($servicio['Nombre']); ?>"><br><br>

                <label>Descripción: *</label>
                <input type="text" name="descripcion" value="<?php echo htmlspecialchars($servicio['Descripcion']); ?>"><br><br>

                <label>Precio: *</label>
                <input type="text" name="precio" value="<?php echo htmlspecialchars($servicio['Precio']); ?>"><br><br>

                <label>Duración: *</label>
                <div>
                    <select name="duracionHoras" id="duracionHoras">
                        <option value="0" <?php echo ($servicio['Duracion'] === '0') ? 'selected' : ''; ?>>Horas</option>
                        <?php
                        // Generar opciones para las horas
                        for ($i = 0; $i <= 23; $i++) {
                            $selected = ($servicio['Duracion'] == $i) ? 'selected' : '';
                            echo "<option value='$i' $selected>$i</option>";
                        }
                        ?>
                    </select>
                    <span>:</span>
                    <select name="duracionMinutos" id="duracionMinutos">
                        <option value="0" <?php echo ($servicio['Duracion'] === '0') ? 'selected' : ''; ?>>Minutos</option>
                        <?php
                        // Generar opciones para los minutos
                        for ($i = 0; $i < 60; $i++) {
                            $selected = ($servicio['Duracion'] == $i) ? 'selected' : '';
                            echo "<option value='$i' $selected>$i</option>";
                        }
                        ?>
                    </select>
                </div>
                <br>

                <label>Imagen (URL o descripción):</label>
                <textarea name="imagen"><?php echo htmlspecialchars($servicio['Img']); ?></textarea><br><br>
                <small>Deja en blanco si no deseas cambiar la imagen</small><br><br>

                <input type="hidden" name="idServicio" value="<?php echo htmlspecialchars($idServicio); ?>">
                <input type="submit" value="Aceptar">
                <input type="button" value="Volver" onclick="atras()"> 
            </div>
        </form>
    </div>
</body>
</html>
