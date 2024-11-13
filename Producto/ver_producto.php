<?php
session_start();
require_once("../conexion_api.php"); // Incluir el archivo de conexión a la API

// Verificar si el parámetro 'id' está presente
$idProducto = isset($_GET['id']) ? $_GET['id'] : null;

if (!$idProducto) {
    echo "Error: no se ha especificado un ID de producto.";
    exit;
}

// Crear una instancia de la clase de conexión a la API
$api = new ConexionAPI();

// Hacer una solicitud a la API para obtener los datos del producto
$producto = $api->get("/Productoes/" . urlencode($idProducto)); // Ajusta el endpoint según tu API

// Verificar si la respuesta es válida y contiene datos
if (isset($producto['status_code']) && $producto['status_code'] !== 200) {
    $producto = null; // La respuesta no es válida o la solicitud falló
} elseif (is_array($producto) && !empty($producto)) {
    // Si la respuesta es un array, usar el primer elemento si es necesario
    $producto = isset($producto[0]) ? $producto[0] : $producto;
} else {
    $producto = null; // La respuesta no contiene datos válidos
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Ver producto</title>
    <link rel="stylesheet" type="text/css" href="../src/css/estilos.css">
    <script type="text/javascript">
        function atras() {
            window.location = "consultaProducto.php";
        }
    </script>
</head>
<body>
    <div id="contenedor">
        <span><?php echo "Conectado: " . (isset($_SESSION["usuario"]) ? $_SESSION["usuario"] : ''); ?></span>                
        <h2 class="titulo2">Producto ID: <?php echo htmlspecialchars($idProducto); ?></h2>
        <br><br>      
        <form action="#" method="POST" name="formulario">
            <div class="campos">                
                <?php if ($producto): ?>
                    <label>ID: *</label>
                    <input type="text" id="id" name="id" value="<?php echo isset($producto['idProducto']) ? htmlspecialchars($producto['idProducto']) : ''; ?>" readonly /><br>           
                    <br>
                    <label>Nombre: *</label>
                    <input type="text" id="nombre" name="nombre" value="<?php echo isset($producto['Nombre']) ? htmlspecialchars($producto['Nombre']) : ''; ?>" /><br>           
                    <br>                        
                    <label>Descripción: *</label>
                    <input type="text" id="descripcion" name="descripcion" value="<?php echo isset($producto['Descripcion']) ? htmlspecialchars($producto['Descripcion']) : ''; ?>" /><br>
                    <br>
                    <label>Precio: *</label>
                    <input type="text" id="precio" name="precio" value="<?php echo isset($producto['Precio']) ? htmlspecialchars($producto['Precio']) : ''; ?>" /><br>
                    <br>
                    <label>Descuento: *</label>
                    <input type="text" id="descuento" name="descuento" value="<?php echo isset($producto['descuento']) ? htmlspecialchars($producto['descuento']) : ''; ?>" /><br>
                    <br>
                    <label>ID Cliente: *</label>
                    <input type="text" id="idCliente" name="idCliente" value="<?php echo isset($producto['Cliente_idCliente']) ? htmlspecialchars($producto['Cliente_idCliente']) : ''; ?>" /><br>
                    <br>
                <?php else: ?>
                    <p>No se pudo obtener la información del producto.</p>
                <?php endif; ?>

                <br>
                <center><input type="button" value="Volver" onclick="atras()"></center>
            </div>
        </form> 
    </div>
</body>
</html>
