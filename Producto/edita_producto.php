<?php
require_once("../conexion_api.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtén los datos enviados por el formulario
    $idProducto = trim($_POST['idProducto']);
    $nombre = trim($_POST['nombre']);
    $descripcion = trim($_POST['descripcion']);
    $precio = trim($_POST['precio']);
    $stok = trim($_POST['stok']);
    $img = trim($_POST['img']);

    // Validar que todos los campos están llenos
    if (empty($nombre) || empty($descripcion) || empty($precio) || empty($stok) || empty($img)) {
        echo "<script>alert('Todos los campos son obligatorios'); window.history.back();</script>";
        exit;
    }

    $api = new ConexionAPI();
    $data = array(
        'idProducto' => $idProducto,
        'Nombre' => $nombre,
        'Descripcion' => $descripcion,
        'Precio' => (float)$precio,
        'Stok' => (int)$stok,
        'Img' => $img
    );

    // Enviar los datos actualizados a la API
    $response = $api->put("/Productoes/" . urlencode($idProducto), $data);

    // Verificar el estado de la respuesta
    if ($response && $response['status_code'] === 204) {
        echo "<script>alert('Producto modificado correctamente'); window.location='form_edita_producto.php';</script>";
    } else {
        $errorMessage = isset($response['body']['message']) ? $response['body']['message'] : 'Error al modificar el producto';
        echo "<script>alert('$errorMessage'); window.history.back();</script>";
    }
}
?>
