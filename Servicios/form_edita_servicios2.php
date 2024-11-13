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
    </script>
</head>
<body>
    <div id="contenedor">
        <h2 class="titulo2">Editar Servicio: <?php echo htmlspecialchars($servicio['Nombre']); ?></h2>
        <form action="edita_servicios.php" method="POST">
            <div class="campos">
                <label>Nombre: *</label>
                <input type="text" name="nombre" value="<?php echo htmlspecialchars($servicio['Nombre']); ?>"><br><br>
                <label>Descripción: *</label>
                <input type="text" name="descripcion" value="<?php echo htmlspecialchars($servicio['Descripcion']); ?>"><br><br>
                <label>Precio: *</label>
                <input type="text" name="precio" value="<?php echo htmlspecialchars($servicio['Precio']); ?>"><br><br>
                <label>Duración (min): *</label>
                <input type="text" name="duracion" value="<?php echo htmlspecialchars($servicio['Duracion']); ?>" step="1"><br><br>
                <input type="hidden" name="idServicio" value="<?php echo htmlspecialchars($idServicio); ?>">
                <input type="submit" value="Aceptar">
                <input type="button" value="Volver" onclick="atras()"> 
            </div>
        </form>
    </div>
</body>
</html>
