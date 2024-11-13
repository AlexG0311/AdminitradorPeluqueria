<?php
session_start();
require_once("../conexion_api.php"); // Incluir el archivo de conexión a la API

// Crear una instancia de la clase de conexión a la API
$api = new ConexionAPI();

// Obtener los servicios de la API
$response = $api->get("/Servicios");

// Verificar que la respuesta tenga la clave $values
$servicios = isset($response['$values']) ? $response['$values'] : []; // Acceder a la clave $values

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Consulta Servicios</title>
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
        .productos_listado img {
            width: 60px;      /* Establece un ancho fijo */
            height: 60px;     /* Establece una altura fija */
            object-fit: cover; /* Recorta la imagen para ajustarse al área */
        }
    </style>
</head>
<body>
    <div class="contenedor2">
        <span><?php echo "Conectado: " . (isset($_SESSION["usuario"]) ? $_SESSION["usuario"] : ''); ?></span>
        <h2 class="titulo2">Consulta Servicios</h2>
        <table border="0" class="productos_listado">
            <caption>Lista de Servicios</caption>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Duración</th>
                <th>Imagen</th>
            </tr>
            <?php
            if (!empty($servicios)) {
                foreach ($servicios as $servicio) {
                    // Extraer los campos necesarios
                    $id = htmlspecialchars($servicio['idServicio'] ?? 'N/A');
                    $nombre = htmlspecialchars($servicio['Nombre'] ?? 'N/A');
                    $descripcion = htmlspecialchars($servicio['Descripcion'] ?? 'N/A');
                    $precio = htmlspecialchars($servicio['Precio'] ?? 'N/A');
                    $duracion = htmlspecialchars($servicio['Duracion'] ?? 'N/A');
                    $imagen = htmlspecialchars($servicio['Img'] ?? ''); // Obtener la URL de la imagen
                    ?>
                    <tr>
                        <td><?php echo $id; ?></td>
                        <td><?php echo $nombre; ?></td>
                        <td><?php echo $descripcion; ?></td>
                        <td><?php echo $precio; ?></td>
                        <td><?php echo $duracion; ?></td>
                        <td>
                            <?php if ($imagen): ?>
                                <img src="<?php echo $imagen; ?>" alt="Imagen del servicio">
                            <?php else: ?>
                                <span>No disponible</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                echo "<tr><td colspan='6'>No se pudieron obtener los datos de los servicios.</td></tr>";
            }
            ?>
        </table>
        <br>
        <center><input type="button" value="Volver" onclick="atras()"></center>
    </div>
</body>
</html>
