<?php
require_once("../conexion_api.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idServicio = trim($_POST['idServicio']);
    $nombre = trim($_POST['nombre']);
    $descripcion = trim($_POST['descripcion']);
    $precio = trim($_POST['precio']);
    $duracionHoras = trim($_POST['duracionHoras']);
    $duracionMinutos = trim($_POST['duracionMinutos']);
    $imagen = trim($_POST['imagen']); // Recibir el texto ingresado en el textarea

    // Validación de campos obligatorios, excepto el campo de imagen
    if (empty($idServicio) || empty($nombre) || empty($descripcion) || empty($precio) || empty($duracionHoras) || empty($duracionMinutos)) {
        echo "<script>alert('Todos los campos son obligatorios'); window.history.back();</script>";
        exit;
    }

    // Validar que el precio y la duración sean valores numéricos
    if (!is_numeric($precio) || !is_numeric($duracionHoras) || !is_numeric($duracionMinutos)) {
        echo "<script>alert('El precio y la duración deben ser valores numéricos'); window.history.back();</script>";
        exit;
    }

    // Convertir la duración total en formato string (hh:mm:ss)
    $duracionFormatted = sprintf("%02d:%02d:%02d", $duracionHoras, $duracionMinutos, 0); // Formato hh:mm:ss

    $api = new ConexionAPI();
    $data = array(
        'idServicio' => $idServicio,
        'Nombre' => $nombre,
        'Descripcion' => $descripcion,
        'Precio' => (float)$precio,
        'Duracion' => $duracionFormatted,
    );

    // Solo agregar el campo de imagen si tiene contenido
    if (!empty($imagen)) {
        $data['Img'] = $imagen;
    }

    $response = $api->put("/Servicios/" . urlencode($idServicio), $data);

    // Verificar el estado de la respuesta HTTP
    if ($response && isset($response['status_code']) && $response['status_code'] === 204) {
        echo "<script>alert('Servicio modificado exitosamente'); window.location='../admin.php';</script>";
    } else {
        $errorMessage = isset($response['body']['message']) ? $response['body']['message'] : 'Error al modificar el servicio';
        echo "<script>alert('$errorMessage'); window.location='form_edita_servicios.php';</script>";
    }
}
?>
