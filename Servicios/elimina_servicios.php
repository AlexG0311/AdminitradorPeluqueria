<?php
require_once("../conexion_api.php"); // Incluir la clase de conexión a la API

$idServicio = $_POST["servicios"] ?? null; // Obtener el valor seleccionado del formulario

if ($idServicio) {
    // Crear una instancia de la clase de conexión a la API
    $api = new ConexionAPI();
    
    // Realizar la solicitud DELETE a la API
    $res = $api->delete("/Servicios/" . $idServicio);

    // Verificar la respuesta y el código de estado de la API
    if ($res && isset($res['status_code']) && $res['status_code'] === 200) {
        echo "<script language='javascript'>alert('No se elimino el servicio'); window.location='form_elimina_servicios.php'</script>";
    } else {
        echo "<script language='javascript'>alert('Servicio eliminado'); window.location='form_elimina_servicios.php'</script>";
    }
} else {
    echo "<script language='javascript'>alert('Seleccione un servicio para eliminar'); window.location='form_elimina_servicios.php'</script>";
}
?>
