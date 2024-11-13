<?php
session_start();
require_once("../conexion_api.php"); // Incluir el archivo de conexión a la API
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Eliminar Servicio</title>
    <link rel="stylesheet" type="text/css" href="../src/css/estilos.css">
    <script type="text/javascript" language="javascript">
        function atras() {
            window.location = "../admin.php";
        }

        function validaDatos() { 
            const select = document.formulario.servicios;
            if (select.selectedIndex === 0) {
                alert("Escoja un servicio");
                select.focus();
                return false;
            }
            // Enviar el formulario
            document.formulario.submit();
        }
    </script>
</head>
<body>
    <div id="contenedor">
        <span><?php echo "Conectado: " . (isset($_SESSION["usuario"]) ? $_SESSION["usuario"] : ''); ?></span>                
        <h2 class="titulo2">Eliminar Servicio</h2>
        <br><br>  
        <form action="elimina_servicios.php" method="POST" name="formulario">
            <div class="campos">            
                <label>Escoja un servicio:</label>
                <br>            
                <select name="servicios">
                    <option value='0'>...</option>
                    <?php
                    // Crear una instancia de la clase de conexión a la API
                    $api = new ConexionAPI();
                    
                    // Obtener los servicios desde la API
                    $response = $api->get("/Servicios");

                    // Verificar si $response tiene los servicios en un contenedor como '$values'
                    $servicios = $response['$values'] ?? $response;

                    if ($servicios && is_array($servicios)) {
                        foreach ($servicios as $servicio) {
                            // Ajusta los nombres de los campos según los datos de tu API
                            echo "<option value='" . htmlspecialchars($servicio['idServicio']) . "'>" . htmlspecialchars($servicio['Nombre']) . "</option>";
                        }
                    } else {
                        echo "<option value='0'>No se pudieron cargar los servicios</option>";
                    }
                    ?>
                </select>               
                <br><br>
                <input type="button" value="Eliminar" onclick="validaDatos()">
                <input type="button" value="Volver" onclick="atras()"> 
            </div>       
        </form> 
    </div>
</body>
</html>
