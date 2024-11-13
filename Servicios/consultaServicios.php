<?php
session_start();
require_once("../conexion_api.php"); // Incluir el archivo de conexión a la API

// Crear una instancia de la clase de conexión a la API
$api = new ConexionAPI();

$servicios = $api->get("/Servicios");

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Consulta Servicios</title>
    <link rel="stylesheet" type="text/css" href="../src/css/estilos.css" >

    <script type="text/javascript">
        function atras() {
            window.location = "../admin.php";
        }
    </script>

    <style>                        
        fieldset { padding:0; border:0; margin-top:25px; }
    </style>

    <style type="text/css">
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
            font-family: Arial, Helvetica, sans-serif;
            font-size: 14px;
            font-weight: bold;
            color: #FFFFFF;
            padding: 8px 0px 8px 0px;
        }

        .productos_listado th {
            background-color: #D3D4DF;
            color: #333333;
        }

        .productos_listado td {
            height: 24px;                    
        }
        .productos_listado td.td_linea {
            height: 2px;
            background-color: #333333;
            padding: 2px 0px 4px 3px;
        }           
    </style>

</head>
<body>
    <div class="contenedor2">
        <span><?php echo "Conectado: " . (isset($_SESSION["usuario"]) ? $_SESSION["usuario"] : ''); ?></span>              
      
        <h2 class="titulo2">Consulta Servicios</h2>
        <br><br>

        <table border="0" class="productos_listado">
            <caption>Lista de Servicios</caption>
            <tr>
                <th width="100">ID</th>
                <th width="150">Nombre</th>                    
                <th width="300">Descripción</th>
                <th width="100">Precio</th>
                <th width="100">Duración (min)</th>
                <th width="50">&nbsp;</th> 
            </tr>
            <?php
            if ($servicios && !empty($servicios)) {
                foreach ($servicios as $servicio) {
                    // Verificar la clave que tiene el ID
                    $id = isset($servicio['idServicio']) ? $servicio['idServicio'] : 'N/A';
                    ?>
                    <tr>
                        <td align="center" width="100">
                            <?php echo htmlspecialchars($id); ?>
                        </td>
                        <td align="center" width="150">
                            <?php echo htmlspecialchars($servicio['Nombre']); ?>
                        </td>
                        <td align="center" width="300">
                            <?php echo htmlspecialchars($servicio['Descripcion']); ?>
                        </td>
                        <td align="center" width="100">
                            <?php echo htmlspecialchars($servicio['Precio']); ?>
                        </td>
                        <td align="center" width="100">
                            <?php echo htmlspecialchars($servicio['Duracion']); ?>
                        </td>
                        <td align="center" width="50">
                            <a href='ver_servicios.php?id=<?php echo urlencode($id); ?>'>
                                <span class="com">Ver</span>
                            </a>
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
