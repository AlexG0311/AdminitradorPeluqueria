<?php
require_once("../conexion_api.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idProducto = trim($_POST['idProducto']);
    $nombre = trim($_POST['nombre']);
    $descripcion = trim($_POST['descripcion']);
    $precio = trim($_POST['precio']);
    $descuento = trim($_POST['descuento']);
    $idCliente = trim($_POST['idCliente']);

    if (empty($idProducto) || empty($nombre) || empty($descripcion) || empty($precio) || empty($descuento) || empty($idCliente)) {
        echo "<script>alert('Todos los campos son obligatorios'); window.history.back();</script>";
        exit;
    }

    $api = new ConexionAPI();
    $data = array(
        'idProducto' => $idProducto,
        'Nombre' => $nombre,
        'Descripcion' => $descripcion,
        'Precio' => (float)$precio,
        'descuento' => (int)$descuento,
        'Cliente_idCliente' => (int)$idCliente
    );

    $response = $api->put("/Productoes/" . urlencode($idProducto), $data);

    // Verificar el estado de la respuesta HTTP
    if ($response && $response['status_code'] === 200) {
        echo "<script>alert('Error al modificadar producto'); window.location='form_edita_producto.php';</script>";
    } else {
        $errorMessage = isset($response['body']['message']) ? $response['body']['message'] : 'Producto modificado';
        echo "<script>alert('$errorMessage'); window.location='form_edita_producto.php';</script>";
    }
}
?>
