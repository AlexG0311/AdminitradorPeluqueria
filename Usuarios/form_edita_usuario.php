<?php
session_start();
require_once("../conexion_api.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Modificar usuario</title>
    <link rel="stylesheet" type="text/css" href="../src/css/estilos.css">
    <script type="text/javascript">
        function validaDatos() {
            const selectUsuarios = document.formulario.idUsuario;
            if (selectUsuarios.value === '0') {
                alert("Escoja un usuario");
                selectUsuarios.focus();
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
        <h2 class="titulo2">Editar usuario</h2>
        <form action="form_edita_usuario2.php" method="POST" name="formulario">
            <div class="campos">
                <label>Escoja un usuario:</label>
                <br>
                <select name="idUsuario">
                    <option value='0'>...</option>
                    <?php
                    // Instancia de la API
                    $api = new ConexionAPI();
                    
                    // Obtener lista de usuarios
                    $response = $api->get("/Usuarios");

                    // Comprobamos si los usuarios están en '$values' o directamente en el arreglo
                    $usuarios = $response['$values'] ?? $response;

                    // Verificamos si $usuarios es un arreglo válido
                    if ($usuarios && is_array($usuarios)) {
                        foreach ($usuarios as $usuario) {
                            // Verifica si el array tiene los índices correctos
                            $idUsuario = htmlspecialchars($usuario['idUsuario'] ?? '');
                            $nombre = htmlspecialchars($usuario['Nombre'] ?? '');
                            $apellidos = htmlspecialchars($usuario['Apellidos'] ?? '');
                            
                            // Solo muestra opciones válidas
                            if ($idUsuario && $nombre) {
                                echo "<option value='$idUsuario'>$nombre $apellidos</option>";
                            }
                        }
                    } else {
                        echo "<option value='0'>No se pudieron cargar los usuarios</option>";
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
