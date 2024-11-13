<?php
require_once("../conexion_api.php"); // Incluir la clase de conexión a la API

$nom = $_POST["usuarios"] ?? null; // Obtener el valor seleccionado del formulario

if ($nom) {
    // Crear una instancia de la clase de conexión a la API
    $api = new ConexionAPI();
    
    // Realizar la solicitud DELETE a la API
    $res = $api->delete("/Usuarios/" . $nom);

    // Verificar la respuesta y el código de estado de la API
    if ($res && isset($res['status_code']) && ($res['status_code'] === 200 || $res['status_code'] === 204)) {
        echo "<script language='javascript'>alert('El Usuario se eliminó exitosamente'); window.location='form_elimina_usuario.php'</script>";
    } else {
        echo "<script language='javascript'>alert('No se pudo eliminar el usuario'); window.location='form_elimina_usuario.php'</script>";
    }
} else {
    echo "<script language='javascript'>alert('Seleccione un usuario para eliminar'); window.location='form_elimina_usuario.php'</script>";
}
