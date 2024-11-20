<?php
session_start();
require_once("../conexion_api.php");

// Crear una instancia de la clase de conexión
$api = new ConexionAPI();

// Hacer una solicitud a la API para obtener la lista de empleados
$empleados = $api->get("/Empleadoes");

// Verificar si se obtuvieron los empleados
if (!$empleados || !isset($empleados['$values']) || !is_array($empleados['$values'])) {
    echo "<script>alert('No se pudieron cargar los empleados'); window.history.back();</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Asignar Horario a Empleado</title>
    <link rel="stylesheet" href="../src/css/estilos.css">
</head>
<body>
    <div id="contenedor">
        <h2>Asignar Horario a Empleado</h2>
        <form action="guardar_horario.php" method="POST">
            <div class="campos">
                <!-- Selección de empleado -->
                <label for="empleado">Empleado:</label>
                <select name="Empleado_idEmpleado" id="empleado" required>
                    <option value="">Seleccione un empleado</option>
                    <?php foreach ($empleados['$values'] as $empleado): ?>
                        <option value="<?php echo htmlspecialchars($empleado['idEmpleado']); ?>">
                            <?php echo htmlspecialchars($empleado['NombreUsuario']); // Mostrar el nombre del usuario ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <!-- Selección de fecha -->
                <label for="fecha">Fecha (Día/Mes/Año):</label>
                <input type="date" name="DiaMesAño" id="fecha" required>

                <!-- Selección de hora de inicio -->
                <label for="hora_inicio">Hora de Inicio:</label>
                <input type="time" name="HoraInicio" id="hora_inicio" required>

                <!-- Selección de hora de fin -->
                <label for="hora_fin">Hora de Fin:</label>
                <input type="time" name="HoraFin" id="hora_fin" required>

                <!-- Botón para enviar el formulario -->
                <input type="submit" value="Guardar Horario">
            </div>
        </form>
    </div>
</body>
</html>
