<?php
require_once("../conexion_api.php"); // Incluir la clase de conexión a la API

$idProducto = $_POST["productos"] ?? null; // Obtener el valor seleccionado del formulario

if ($idProducto) {
    // Crear una instancia de la clase de conexión a la API
    $api = new ConexionAPI();
    
    // Realizar la solicitud DELETE a la API
    $res = $api->delete("/Productoes/" . $idProducto);

    // Verificar la respuesta y el código de estado de la API
    if ($res && isset($res['status_code']) && $res['status_code'] === 200) {
        echo "<script language='javascript'>alert('El Producto no se pudo eliminar'); window.location='form_elimina_producto.php'</script>";
    } else {
        echo "<script language='javascript'>alert('Producto eliminado'); window.location='form_elimina_producto.php'</script>";
    }
} else {
    echo "<script language='javascript'>alert('Seleccione un producto para eliminar'); window.location='form_elimina_producto.php'</script>";
}
?>
