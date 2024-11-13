<?php
require_once("../conexion_api.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idServicio = trim($_POST['idServicio']);
    $nombre = trim($_POST['nombre']);
    $descripcion = trim($_POST['descripcion']);
    $precio = trim($_POST['precio']);
    $duracion = trim($_POST['duracion']);

    if (empty($idServicio) || empty($nombre) || empty($descripcion) || empty($precio) || empty($duracion)) {
        echo "<script>alert('Todos los campos son obligatorios'); window.history.back();</script>";
        exit;
    }

    $api = new ConexionAPI();
    $data = array(
        'idServicio' => $idServicio,
        'Nombre' => $nombre,
        'Descripcion' => $descripcion,
        'Precio' => (float)$precio,
        'Duracion' => $duracion
    );

    $response = $api->put("/Servicios/" . urlencode($idServicio), $data);

    // Verificar el estado de la respuesta HTTP
    if ($response && $response['status_code'] === 200) {
        echo "<script>alert('Error al modificado '); window.location='form_edita_servicios.php';</script>";
    } else {
        $errorMessage = isset($response['body']['message']) ? $response['body']['message'] : 'Modificado el servicio';
        echo "<script>alert('$errorMessage'); window.location='form_edita_servicios.php';</script>";
    }
}
?>
