<?php
session_start();
require_once("../conexion_api.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Modificar Producto</title>
    <link rel="stylesheet" type="text/css" href="../src/css/estilos.css">
    <script type="text/javascript">
        function validaDatos() {
            const selectProductos = document.formulario.idProducto;
            if (selectProductos.value === '0') {
                alert("Escoja un producto");
                selectProductos.focus();
                return false;
            }
            document.formulario.submit(); // Envía el formulario
        }

        function atras() {
            window.location = "../admin.php";
        } 
    </script>
</head>
<body>
    <div id="contenedor">
        <h2 class="titulo2">Editar Producto</h2>
        <form action="form_edita_producto2.php" method="POST" name="formulario">
            <div class="campos">
                <label>Escoja un producto:</label>
                <br>
                <select name="idProducto">
                    <option value='0'>...</option>
                    <?php
                    // Instancia de la API
                    $api = new ConexionAPI();
                    
                    // Obtener lista de productos
                    $response = $api->get("/Productoes");

                    // Comprobamos si los productos están en '$values' o directamente en el arreglo
                    $productos = $response['$values'] ?? $response;

                    // Verificamos si $productos es un arreglo válido
                    if ($productos && is_array($productos)) {
                        foreach ($productos as $producto) {
                            // Verifica si el array tiene los índices correctos
                            $idProducto = htmlspecialchars($producto['idProducto'] ?? '');
                            $nombre = htmlspecialchars($producto['Nombre'] ?? '');
                            
                            // Solo muestra opciones válidas
                            if ($idProducto && $nombre) {
                                echo "<option value='$idProducto'>$nombre</option>";
                            }
                        }
                    } else {
                        echo "<option value='0'>No se pudieron cargar los productos</option>";
                    }
                    ?>
                </select>
                <br><br>
                <input type="button" value="Modificar" onclick="validaDatos()">
                <input type="button" value="Volver" onclick="atras()"> 
            </div>
        </form>
    </div>
</body>
</html>