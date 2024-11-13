<?php
session_start();
require_once("../conexion_api.php"); // Incluir el archivo de conexión a la API

// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $nombre = trim($_POST['nombre']);
    $descripcion = trim($_POST['descripcion']);
    $precio = trim($_POST['precio']);
    $duracion = trim($_POST['duracion']);

    // Validar que los campos no estén vacíos y que el precio y la duración sean números válidos
    if (empty($nombre) || empty($descripcion) || empty($precio) || empty($duracion)) {
        echo "<script>alert('Todos los campos son obligatorios'); window.location='form_guarda_servicios.php';</script>";
        exit;
    }
    if (!is_numeric($precio) || !is_numeric($duracion)) {
        echo "<script>alert('El precio y la duración deben ser valores numéricos'); window.location='form_guarda_servicios.php';</script>";
        exit;
    }

    // Crear una instancia de la clase de conexión a la API
    $api = new ConexionAPI();

    // Datos a enviar a la API
    $data = array(
        'Nombre' => $nombre,
        'Descripcion' => $descripcion,
        'Precio' => (float)$precio,
        'Duracion' => (int)$duracion
    );

    // Enviar los datos a la API
    $response = $api->post("/Servicios", $data);

    // Verificar la respuesta de la API
    if ($response) {
        // Asumir que el servicio fue agregado si la respuesta es un objeto o array con datos
        if (isset($response['idServicio']) || !empty($response)) {
            echo "<script>alert('Servicio registrado exitosamente'); window.location='../admin.php';</script>";
        } else {
            $errorMessage = isset($response['message']) ? $response['message'] : 'Error al guardar el servicio';
            echo "<script>alert('$errorMessage'); window.location='form_guarda_servicios.php';</script>";
        }
    } else {
        echo "<script>alert('Error al conectar con la API'); window.location='form_guarda_servicios.php';</script>";
    }
}
?>
