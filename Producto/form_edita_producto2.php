<?php
session_start();
require_once("../conexion_api.php");

if (!isset($_POST['idProducto']) || $_POST['idProducto'] == '0') {
    echo "<script>alert('No se ha seleccionado un producto para editar'); window.location='form_edita_producto.php';</script>";
    exit;
}

$idProducto = $_POST['idProducto'];
$api = new ConexionAPI();
$producto = $api->get("/Productoes/" . urlencode($idProducto));

if (!$producto || !is_array($producto)) {
    echo "<script>alert('No se pudo obtener la información del producto'); window.location='form_edita_producto.php';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Modificar Producto</title>
    <link rel="stylesheet" type="text/css" href="../src/css/estilos.css">
    <script type="text/javascript">
        function atras() {
            window.location = "../admin.php";
        }
    </script>
</head>
<body>
    <div id="contenedor">
        <h2 class="titulo2">Editar Producto: <?php echo htmlspecialchars($producto['Nombre']); ?></h2>
        <form action="edita_producto.php" method="POST">
            <div class="campos">
                <label>Nombre: *</label>
                <input type="text" name="nombre" value="<?php echo htmlspecialchars($producto['Nombre']); ?>"><br><br>

                <label>Descripción: *</label>
                <input type="text" name="descripcion" value="<?php echo htmlspecialchars($producto['Descripcion']); ?>"><br><br>

                <label>Precio: *</label>
                <input type="text" name="precio" value="<?php echo htmlspecialchars($producto['Precio']); ?>"><br><br>

                <label>Stock: *</label>
                <input type="text" name="stok" value="<?php echo htmlspecialchars($producto['Stok']); ?>"><br><br>

                <label>Imagen URL: *</label>
                <input type="text" name="img" value="<?php echo htmlspecialchars($producto['Img']); ?>"><br><br>

                <input type="hidden" name="idProducto" value="<?php echo htmlspecialchars($idProducto); ?>">
                <input type="submit" value="Aceptar">
                <input type="button" value="Volver" onclick="atras()"> 
            </div>
        </form>
    </div>
</body>
</html>