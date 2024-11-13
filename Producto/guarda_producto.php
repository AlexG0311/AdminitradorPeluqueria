<?php
session_start();
require_once("../conexion_api.php"); // Incluir el archivo de conexión a la API

// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $nombre = trim($_POST['nombre']);
    $descripcion = trim($_POST['descripcion']);
    $precio = trim($_POST['precio']);
    $stok = trim($_POST['stok']);
    $img = trim($_POST['img']);

    // Validar que los campos no estén vacíos y que el precio y el stok sean números válidos
    if (empty($nombre) || empty($descripcion) || empty($precio) || empty($stok) || empty($img)) {
        echo "<script>alert('Todos los campos son obligatorios'); window.location='form_guarda_producto.php';</script>";
        exit;
    }
    if (!is_numeric($precio) || !is_numeric($stok)) {
        echo "<script>alert('El precio y el stock deben ser valores numéricos'); window.location='form_guarda_producto.php';</script>";
        exit;
    }

    // Crear una instancia de la clase de conexión a la API
    $api = new ConexionAPI();

    // Datos a enviar a la API
    $data = array(
        'Nombre' => $nombre,
        'Descripcion' => $descripcion,
        'Precio' => (float)$precio,
        'Stok' => (int)$stok,
        'Img' => $img
    );

    // Enviar los datos a la API
    $response = $api->post("/Productoes", $data);

    // Verificar la respuesta de la API
    if ($response) {
        // Asumir que el producto fue agregado si la respuesta es un objeto o array con datos
        if (isset($response['idProducto']) || !empty($response)) {
            echo "<script>alert('Producto registrado exitosamente'); window.location='../admin.php';</script>";
        } else {
            $errorMessage = isset($response['message']) ? $response['message'] : 'Error al guardar el producto';
            echo "<script>alert('$errorMessage'); window.location='form_guarda_producto.php';</script>";
        }
    } else {
        echo "<script>alert('Error al conectar con la API'); window.location='form_guarda_producto.php';</script>";
    }
}
?>
