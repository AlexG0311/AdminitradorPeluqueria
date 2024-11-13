<?php
session_start();
require_once("../conexion_api.php"); // Incluir la clase de conexión a la API

// Obtener los datos del formulario
$nombre = $_POST['nombre'] ?? '';
$descripcion = $_POST['descripcion'] ?? '';
$precio = $_POST['precio'] ?? '';
$duracionHoras = $_POST['duracionHoras'] ?? '0';
$duracionMinutos = $_POST['duracionMinutos'] ?? '0';
$imagen = $_FILES['imagen']['name'] ?? ''; // Para manejar la imagen

// Validar que todos los campos estén llenos
if (empty($nombre) || empty($descripcion) || empty($precio) || empty($duracionHoras) || empty($duracionMinutos) || empty($imagen)) {
    echo "<script>alert('Todos los campos son obligatorios'); window.location='form_guarda_servicio.php';</script>";
    exit;
}

// Validar que el precio y la duración sean valores numéricos
if (!is_numeric($precio) || !is_numeric($duracionHoras) || !is_numeric($duracionMinutos)) {
    echo "<script>alert('El precio y la duración deben ser valores numéricos'); window.location='form_guarda_servicio.php';</script>";
    exit;
}

// Validar y procesar la imagen
$target_dir = "../uploads/"; // Directorio donde se almacenarán las imágenes
$target_file = $target_dir . basename($imagen);
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Verificar si el archivo es una imagen
if (!getimagesize($_FILES["imagen"]["tmp_name"])) {
    echo "<script>alert('El archivo no es una imagen válida'); window.location='form_guarda_servicio.php';</script>";
    exit;
}

// Verificar el tamaño del archivo (por ejemplo, limitar a 5MB)
if ($_FILES["imagen"]["size"] > 5000000) {
    echo "<script>alert('El archivo es demasiado grande. Máximo 5MB'); window.location='form_guarda_servicio.php';</script>";
    exit;
}

// Verificar la extensión del archivo (solo permitir imágenes .jpg, .png, .jpeg, .gif)
if (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
    echo "<script>alert('Solo se permiten imágenes JPG, JPEG, PNG, GIF'); window.location='form_guarda_servicio.php';</script>";
    exit;
}

// Mover la imagen al directorio
if (!move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file)) {
    echo "<script>alert('Error al subir la imagen'); window.location='form_guarda_servicio.php';</script>";
    exit;
}

// Convertir la duración total en formato string (hh:mm:ss)
$duracionFormatted = sprintf("%02d:%02d:%02d", $duracionHoras, $duracionMinutos, 0); // Formato hh:mm:ss

// Crear una instancia de la clase de conexión a la API
$api = new ConexionAPI();

// Enviar los datos a la API para guardar el servicio
$response = $api->post("/Servicios", [
    'Nombre' => $nombre,
    'Descripcion' => $descripcion,
    'Precio' => (float)$precio,
    'Duracion' => $duracionFormatted, // Duración en formato hh:mm:ss
    'Img' => $target_file // Ruta del archivo de imagen
]);

// Verificar la respuesta de la API
if ($response && isset($response['status_code']) && $response['status_code'] === 201) {
    echo "<script>alert('Servicio agregado exitosamente'); window.location='../admin.php';</script>";
} else {
    echo "<script>alert('Error al agregar el servicio'); window.location='form_guarda_servicio.php';</script>";
}
?>
