<?php
require_once("../conexion_api.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Crear la instancia de ConexionAPI
    $api = new ConexionAPI();

    $idServicio = trim($_POST['idServicio']);
    $nombre = trim($_POST['nombre']);
    $descripcion = trim($_POST['descripcion']);
    $precio = trim($_POST['precio']);
    $duracionHoras = $_POST['duracionHoras'];
    $duracionMinutos = $_POST['duracionMinutos'];
    $imagen = trim($_POST['imagen']);

    // Validaciones
    if (
        empty($idServicio) || 
        empty($nombre) || 
        empty($descripcion) || 
        empty($precio) || 
        ($duracionHoras === '0' && $duracionMinutos === '0')
    ) {
        echo "<script>alert('Todos los campos son obligatorios'); window.history.back();</script>";
        exit;
    }

    if (!is_numeric($precio) || $precio <= 0) {
        echo "<script>alert('El precio debe ser un número positivo'); window.history.back();</script>";
        exit;
    }

    if ($descripcion === ".....") {
        echo "<script>alert('La descripción no puede contener solo puntos'); window.history.back();</script>";
        exit;
    }

    if (!empty($imagen) && !filter_var($imagen, FILTER_VALIDATE_URL)) {
        echo "<script>alert('La URL de la imagen no es válida'); window.history.back();</script>";
        exit;
    }

    // Formatear duración
    $duracionFormatted = sprintf("%02d:%02d:%02d", $duracionHoras, $duracionMinutos, 0);

    // Preparar datos
    $data = array(
        'Nombre' => $nombre,
        'Descripcion' => $descripcion,
        'Precio' => number_format((float)$precio, 2, '.', ''), // Precio en formato flotante
        'Duracion' => $duracionFormatted,
    );

    if (!empty($imagen)) {
        $data['Img'] = $imagen;
    }

    // Enviar datos a la API
    $response = $api->put("/Servicios/" . urlencode($idServicio), $data);

    if ($response && isset($response['status_code']) && $response['status_code'] === 204) {
        echo "<script>alert('Servicio modificado exitosamente'); window.location='../admin.php';</script>";
    } else {
        echo "<pre>Datos enviados:</pre>";
        print_r($data);
        echo "<pre>Respuesta de la API:</pre>";
        print_r($response);

        if (isset($response['body'])) {
            echo "<pre>Detalle del error:</pre>";
            echo $response['body']; // Imprime el cuerpo del error si existe
        } else {
            echo "<pre>No se recibieron detalles del error en la respuesta.</pre>";
        }
        exit;
    }
}
?>
