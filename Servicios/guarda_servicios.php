<?php
require_once("../conexion_api.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Capturar datos del formulario
    $nombre = trim($_POST['nombre']);
    $descripcion = trim($_POST['descripcion']);
    $precio = trim($_POST['precio']);
    $duracionHoras = trim($_POST['duracionHoras']);
    $duracionMinutos = trim($_POST['duracionMinutos']);
    $imagen = trim($_POST['imagen']); // Imagen como URL o descripción

    // Validación de campos obligatorios
    if (
        empty($nombre) ||
        empty($descripcion) ||
        empty($precio) ||
        ($duracionHoras === '0' && $duracionMinutos === '0') ||
        empty($imagen)
    ) {
        echo "<script>alert('Todos los campos son obligatorios :D'); window.history.back();</script>";
        exit;
    }

    // Validar que el precio y la duración sean valores numéricos
    if (!is_numeric($precio) || !is_numeric($duracionHoras) || !is_numeric($duracionMinutos)) {
        echo "<script>alert('El precio y la duración deben ser valores numéricos'); window.history.back();</script>";
        exit;
    }

    // Formatear duración en formato hh:mm:ss
    $duracionFormatted = sprintf("%02d:%02d:%02d", $duracionHoras, $duracionMinutos, 0);

    // Preparar datos para la API
    $api = new ConexionAPI();
    $data = array(
        'Nombre' => $nombre,
        'Descripcion' => $descripcion,
        'Precio' => (float)$precio,
        'Duracion' => $duracionFormatted,
        'Img' => $imagen // Campo de imagen opcional
    );

    // Llamada a la API para guardar el servicio
    $response = $api->post("/Servicios", $data);

    // Manejo de respuesta de la API
    if ($response && isset($response['status_code']) && $response['status_code'] === 201) {
        echo "<script>alert('Servicio agregado exitosamente'); window.location='../admin.php';</script>";
    } else {
        $errorMessage = isset($response['body']['message']) ? $response['body']['message'] : 'Error al agregar el servicio';
        echo "<script>alert('$errorMessage'); window.history.back();</script>";
    }
}
?>
