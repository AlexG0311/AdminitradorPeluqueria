<?php
session_start();
require_once("../conexion_api.php"); // Incluir el archivo de conexión a la API

// Crear una instancia de la clase de conexión a la API
$api = new ConexionAPI();

// Obtener los productos de la API
$response = $api->get("/Productoes");

// Asegurarte de que $response tenga el arreglo de productos que necesitas
$productos = $response['$values'] ?? []; // Extraer $values si existe, si no dejar un arreglo vacío
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Consulta productos</title>
    <link rel="stylesheet" type="text/css" href="../src/css/estilos.css">
    <script type="text/javascript">
        function atras() {
            window.location = "../admin.php";
        }
    </script>
    <style>
        .productos_listado {
            table-layout: fixed;
            width: 700px;
            margin: 0 auto;
            border: 1px solid #D3D4DF;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
        }
        .productos_listado caption {
            background-color: #008080;
            color: #FFFFFF;
            padding: 8px 0px;
            font-weight: bold;
        }
        .productos_listado th, .productos_listado td {
            padding: 8px;
            text-align: center;
        }
        .productos_listado th {
            background-color: #D3D4DF;
        }
    </style>
</head>
<body>
    <div class="contenedor2">
        <span><?php echo "Conectado: " . (isset($_SESSION["usuario"]) ? $_SESSION["usuario"] : ''); ?></span>
        <h2 class="titulo2">Consulta productos</h2>
        <table border="0" class="productos_listado">
            <caption>Lista de productos</caption>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Imagen</th>
            </tr>
            <?php
            if (!empty($productos)) {
                foreach ($productos as $producto) {
                    // Extraer los campos necesarios
                    $id = htmlspecialchars($producto['idProducto'] ?? 'N/A');
                    $nombre = htmlspecialchars($producto['Nombre'] ?? 'N/A');
                    $descripcion = htmlspecialchars($producto['Descripcion'] ?? 'N/A');
                    $precio = htmlspecialchars($producto['Precio'] ?? 'N/A');
                    $stock = htmlspecialchars($producto['Stok'] ?? 'N/A');
                    $img = htmlspecialchars($producto['Img'] ?? 'N/A');
                    ?>
                    <tr>
                        <td><?php echo $id; ?></td>
                        <td><?php echo $nombre; ?></td>
                        <td><?php echo $descripcion; ?></td>
                        <td><?php echo $precio; ?></td>
                        <td><?php echo $stock; ?></td>
                        <td><?php echo $img; ?></td>
                    </tr>
                    <?php
                }
            } else {
                echo "<tr><td colspan='6'>No se pudieron obtener los datos de los productos.</td></tr>";
            }
            ?>
        </table>
        <br>
        <center><input type="button" value="Volver" onclick="atras()"></center>
    </div>
</body>
</html>
