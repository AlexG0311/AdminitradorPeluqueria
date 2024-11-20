<?php
// Inicia la sesión
session_start();

// Incluye la clase de conexión a la API
require_once("../conexion_api.php");

// Verifica si el formulario fue enviado con los datos requeridos
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtiene y sanitiza los datos del formulario
    $empleadoId = filter_input(INPUT_POST, 'Empleado_idEmpleado', FILTER_VALIDATE_INT);
    $fecha = filter_input(INPUT_POST, 'DiaMesAño', FILTER_SANITIZE_STRING);
    $horaInicio = filter_input(INPUT_POST, 'HoraInicio', FILTER_SANITIZE_STRING);
    $horaFin = filter_input(INPUT_POST, 'HoraFin', FILTER_SANITIZE_STRING);

    // Valida los campos requeridos
    if (!$empleadoId || !$fecha || !$horaInicio || !$horaFin) {
        echo "<script>alert('Todos los campos son obligatorios.'); window.history.back();</script>";
        exit;
    }

    // Crea una instancia de la clase de conexión API
    $api = new ConexionAPI();

    // Prepara los datos a enviar a la API
    $data = [
        'DiaMesAño' => $fecha . 'T00:00:00Z', // Agrega el tiempo para cumplir el formato ISO 8601
        'HoraInicio' => $horaInicio . ':00', // Incluye los segundos en el formato
        'HoraFin' => $horaFin . ':00', // Incluye los segundos en el formato
        'Empleado_idEmpleado' => $empleadoId
    ];

    // Hace la solicitud POST a la API para guardar el horario
    $response = $api->post("/Horarios", $data);

    // Verifica la respuesta de la API
    if ($response && $response['status_code'] === 201) {
        // Muestra un mensaje de éxito y redirige
        echo "<script>alert('Horario asignado correctamente.'); window.location.href = 'form_agrega_horario.php';</script>";
        exit;
    } else {
        // Maneja el caso de error con más detalle
        $errorMessage = 'Ocurrió un error al asignar el horario.';
        if (isset($response['body']['error'])) {
            $errorMessage = $response['body']['error'];
        } elseif ($response['status_code'] === 400) {
            $errorMessage = 'Solicitud inválida. Por favor, verifica los datos enviados.';
        } elseif ($response['status_code'] === 500) {
            $errorMessage = 'Error del servidor. Inténtalo más tarde.';
        }

        // Muestra un mensaje de error si algo salió mal
        echo "<script>alert('Error: $errorMessage'); window.history.back();</script>";
        exit;
    }
} else {
    // Si se intenta acceder al archivo directamente sin enviar el formulario
    echo "<script>alert('Acceso no válido.'); window.history.back();</script>";
    exit;
}
?>
