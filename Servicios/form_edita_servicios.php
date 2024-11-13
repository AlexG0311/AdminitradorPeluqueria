<?php
session_start();
require_once("../conexion_api.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Modificar Servicio</title>
    <link rel="stylesheet" type="text/css" href="../src/css/estilos.css">
    <script type="text/javascript">
        function validaDatos() {
            const selectServicios = document.formulario.idServicio;
            if (selectServicios.value === '0') {
                alert("Escoja un servicio");
                selectServicios.focus();
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
        <h2 class="titulo2">Editar Servicio</h2>
        <form action="form_edita_servicios2.php" method="POST" name="formulario">
            <div class="campos">
                <label>Escoja un servicio:</label>
                <br>
                <select name="idServicio">
                    <option value='0'>...</option>
                    <?php
                    // Instancia de la API
                    $api = new ConexionAPI();
                    
                    // Obtener lista de servicios
                    $response = $api->get("/Servicios");

                    // Comprobamos si los servicios están en '$values' o directamente en el arreglo
                    $servicios = $response['$values'] ?? $response;

                    // Verificamos si $servicios es un arreglo válido
                    if ($servicios && is_array($servicios)) {
                        foreach ($servicios as $servicio) {
                            // Verifica si el array tiene los índices correctos
                            $idServicio = htmlspecialchars($servicio['idServicio'] ?? '');
                            $nombre = htmlspecialchars($servicio['Nombre'] ?? '');
                            $descripcion = htmlspecialchars($servicio['Descripcion'] ?? '');
                            
                            // Solo muestra opciones válidas
                            if ($idServicio && $nombre) {
                                echo "<option value='$idServicio'>$nombre</option>";
                            }
                        }
                    } else {
                        echo "<option value='0'>No se pudieron cargar los servicios</option>";
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
