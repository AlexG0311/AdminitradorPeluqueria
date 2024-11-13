<?php
session_start();
require_once("../conexion_api.php"); // Incluir el archivo de conexión a la API

// Crear una instancia de la clase de conexión a la API
$api = new ConexionAPI();

// Obtener los usuarios de la API
$response = $api->get("/Usuarios");

// Asegurarte de que $response tenga el arreglo de usuarios que necesitas
$usuarios = $response['$values'] ?? []; // Extraer $values si existe, si no dejar un arreglo vacío
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Consulta usuarios</title>
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
        <h2 class="titulo2">Consulta usuario</h2>
        <table border="0" class="productos_listado">
            <caption>Lista de usuarios</caption>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Email</th>
                <th>Teléfono</th>
            </tr>
            <?php
            if (!empty($usuarios)) {
                foreach ($usuarios as $usuario) {
                    // Extraer los campos necesarios
                    $id = htmlspecialchars($usuario['idUsuario'] ?? 'N/A');
                    $nombre = htmlspecialchars($usuario['Nombre'] ?? 'N/A');
                    $apellidos = htmlspecialchars($usuario['Apellidos'] ?? 'N/A');
                    $correo = htmlspecialchars($usuario['Correo'] ?? 'N/A');
                    $telefono = htmlspecialchars($usuario['Telefono'] ?? 'N/A');
                    ?>
                    <tr>
                        <td><?php echo $id; ?></td>
                        <td><?php echo $nombre; ?></td>
                        <td><?php echo $apellidos; ?></td>
                        <td><?php echo $correo; ?></td>
                        <td><?php echo $telefono; ?></td>
                    </tr>
                    <?php
                }
            } else {
                echo "<tr><td colspan='5'>No se pudieron obtener los datos de los usuarios.</td></tr>";
            }
            ?>
        </table>
        <br>
        <center><input type="button" value="Volver" onclick="atras()"></center>
    </div>
</body>
</html>
