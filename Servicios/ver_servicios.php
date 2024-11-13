<?php
session_start();
require_once("../conexion_api.php"); // Incluir el archivo de conexión a la API

// Verificar si el parámetro 'id' está presente
$idServicio = isset($_GET['id']) ? $_GET['id'] : null;

if (!$idServicio) {
    echo "Error: no se ha especificado un ID de servicio.";
    exit;
}

// Crear una instancia de la clase de conexión a la API
$api = new ConexionAPI();

// Hacer una solicitud a la API para obtener los datos del servicio
$servicio = $api->get("/Servicios/" . urlencode($idServicio)); // Ajusta el endpoint según tu API

// Verificar si la respuesta es válida y contiene datos
if (isset($servicio['status_code']) && $servicio['status_code'] !== 200) {
    $servicio = null; // La respuesta no es válida o la solicitud falló
} elseif (is_array($servicio) && !empty($servicio)) {
    // Si la respuesta es un array, usar el primer elemento si es necesario
    $servicio = isset($servicio[0]) ? $servicio[0] : $servicio;
} else {
    $servicio = null; // La respuesta no contiene datos válidos
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Ver servicio</title>
    <link rel="stylesheet" type="text/css" href="../src/css/estilos.css">
    <script type="text/javascript">
        function atras() {
            window.location = "consultaServicios.php";
        }
    </script>
</head>
<body>
    <div id="contenedor">
        <span><?php echo "Conectado: " . (isset($_SESSION["usuario"]) ? $_SESSION["usuario"] : ''); ?></span>                
        <h2 class="titulo2">Servicio ID: <?php echo htmlspecialchars($idServicio); ?></h2>
        <br><br>      
        <form action="#" method="POST" name="formulario">
            <div class="campos">                
                <?php if ($servicio): ?>
                    <label>ID: *</label>
                    <input type="text" id="id" name="id" value="<?php echo isset($servicio['idServicio']) ? htmlspecialchars($servicio['idServicio']) : ''; ?>" readonly /><br>           
                    <br>
                    <label>Nombre: *</label>
                    <input type="text" id="nombre" name="nombre" value="<?php echo isset($servicio['Nombre']) ? htmlspecialchars($servicio['Nombre']) : ''; ?>" /><br>           
                    <br>                        
                    <label>Descripción: *</label>
                    <input type="text" id="descripcion" name="descripcion" value="<?php echo isset($servicio['Descripcion']) ? htmlspecialchars($servicio['Descripcion']) : ''; ?>" /><br>
                    <br>
                    <label>Precio: *</label>
                    <input type="text" id="precio" name="precio" value="<?php echo isset($servicio['Precio']) ? htmlspecialchars($servicio['Precio']) : ''; ?>" /><br>
                    <br>
                    <label>Duración (min): *</label>
                    <input type="text" id="duracion" name="duracion" value="<?php echo isset($servicio['Duracion']) ? htmlspecialchars($servicio['Duracion']) : ''; ?>" /><br>
                    <br>
                <?php else: ?>
                    <p>No se pudo obtener la información del servicio.</p>
                <?php endif; ?>

                <br>
                <center><input type="button" value="Volver" onclick="atras()"></center>
            </div>
        </form> 
    </div>
</body>
</html>
