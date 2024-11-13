<?php
session_start();
require_once("../conexion_api.php"); // Incluir el archivo de conexión a la API
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Eliminar contacto</title>
    <link rel="stylesheet" type="text/css" href="../src/css/estilos.css">
    <script type="text/javascript" language="javascript">
        function atras() {
            window.location = "../admin.php";
        }

        function validaDatos() { 
            const select = document.formulario.usuarios;
            if (select.selectedIndex === 0) {
                alert("Escoja un usuario");
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
        <h2 class="titulo2">Elimina usuario</h2>
        <br><br>  
        <form action="elimina_usuario.php" method="POST" name="formulario">
            <div class="campos">            
                <label>Escoja un usuario:</label>
                <br>            
                <select name="usuarios">
                    <option value='0'>...</option>
                    <?php
                    // Crear una instancia de la clase de conexión a la API
                    $api = new ConexionAPI();
                    
                    // Obtener los usuarios desde la API
                    $response = $api->get("/Usuarios");

                    // Verificar si $response tiene los usuarios en un contenedor como '$values'
                    $usuarios = $response['$values'] ?? $response;

                    if ($usuarios && is_array($usuarios)) {
                        foreach ($usuarios as $usuario) {
                            // Ajusta los nombres de los campos según los datos de tu API
                            echo "<option value='" . htmlspecialchars($usuario['idUsuario']) . "'>" . htmlspecialchars($usuario['Nombre']) . " " . htmlspecialchars($usuario['Apellidos']) . "</option>";
                        }
                    } else {
                        echo "<option value='0'>No se pudieron cargar los usuarios</option>";
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
