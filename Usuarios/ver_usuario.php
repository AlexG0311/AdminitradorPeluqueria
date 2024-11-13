<?php
session_start();
require_once("../conexion_api.php"); // Incluir el archivo de conexión a la API

// Verificar si el parámetro 'id' está presente
$idUsuario = isset($_GET['id']) ? $_GET['id'] : null;

if (!$idUsuario) {
    echo "Error: no se ha especificado un ID de usuario.";
    exit;
}

// Crear una instancia de la clase de conexión a la API
$api = new ConexionAPI();

// Hacer una solicitud a la API para obtener los datos del usuario
$usuario = $api->get("/usuarios/" . urlencode($idUsuario)); // Ajusta el endpoint según tu API

// Verificar si la respuesta es válida y contiene datos
if (isset($usuario['status_code']) && $usuario['status_code'] !== 200) {
    $usuario = null; // La respuesta no es válida o la solicitud falló
} elseif (is_array($usuario) && !empty($usuario)) {
    // Si la respuesta es un array, usar el primer elemento si es necesario
    $usuario = isset($usuario[0]) ? $usuario[0] : $usuario;
} else {
    $usuario = null; // La respuesta no contiene datos válidos
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Ver usuario</title>
    <link rel="stylesheet" type="text/css" href="../src/css/estilos.css">
    <script type="text/javascript">
        function atras() {
            window.location = "consultaUsuarios.php";
        }
    </script>
</head>
<body>
    <div id="contenedor">
        <span><?php echo "Conectado: " . (isset($_SESSION["usuario"]) ? $_SESSION["usuario"] : ''); ?></span>                
        <h2 class="titulo2">Usuario ID: <?php echo htmlspecialchars($idUsuario); ?></h2>
        <br><br>      
        <form action="#" method="POST" name="formulario">
            <div class="campos">                
                <?php if ($usuario): ?>
                    <label>ID: *</label>
                    <input type="text" id="id" name="id" value="<?php echo isset($usuario['idUsuario']) ? htmlspecialchars($usuario['idUsuario']) : ''; ?>" readonly /><br>           
                    <br>
                    <label>Nombre: *</label>
                    <input type="text" id="nombre" name="nombre" value="<?php echo isset($usuario['Nombre']) ? htmlspecialchars($usuario['Nombre']) : ''; ?>" /><br>           
                    <br>                        
                    <label>Apellidos: *</label>
                    <input type="text" id="apellidos" name="apellidos" value="<?php echo isset($usuario['Apellidos']) ? htmlspecialchars($usuario['Apellidos']) : ''; ?>" /><br>
                    <br>
                    <label>Email: *</label>
                    <input type="text" id="correo" name="correo" value="<?php echo isset($usuario['Correo']) ? htmlspecialchars($usuario['Correo']) : ''; ?>" /><br>
                    <br>
                    <label>Contraseña: *</label>
                    <input type="password" id="contrasena" name="contrasena" value="<?php echo isset($usuario['Contrasena']) ? htmlspecialchars($usuario['Contrasena']) : ''; ?>" /><br>
                    <br>
                    <label>Teléfono: *</label>
                    <input type="text" id="telefono" name="telefono" value="<?php echo isset($usuario['Telefono']) ? htmlspecialchars($usuario['Telefono']) : ''; ?>" /><br>
                    <br>
                <?php else: ?>
                    <p>No se pudo obtener la información del usuario.</p>
                <?php endif; ?>

                <br>
                <center><input type="button" value="Volver" onclick="atras()"></center>
            </div>
            
        </form> 
    </div>
</body>
</html>
