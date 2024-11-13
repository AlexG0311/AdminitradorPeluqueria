<?php
require_once("../conexion_api.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idUsuario = trim($_POST['idUsuario']);
    $nombre = trim($_POST['nombre']);
    $apellidos = trim($_POST['apellidos']);
    $correo = trim($_POST['email']);
    $contrasena = trim($_POST['pass']);
    $telefono = trim($_POST['telefono']);

    if (empty($idUsuario) || empty($nombre) || empty($apellidos) || empty($correo) || empty($contrasena) || empty($telefono)) {
        echo "<script>alert('Todos los campos son obligatorios'); window.history.back();</script>";
        exit;
    }

    $api = new ConexionAPI();
    $data = array(
        'idUsuario' => $idUsuario,
        'Nombre' => $nombre,
        'Apellidos' => $apellidos,
        'Correo' => $correo,
        'Contrasena' => $contrasena,
        'Telefono' => $telefono
    );

    $response = $api->put("/usuarios/" . urlencode($idUsuario), $data);

  

    // Verificar el estado de la respuesta HTTP
    if ($response && $response['status_code'] === 200) {
        echo "<script>alert('Usuario modificado'); window.location='form_edita_usuario.php';</script>";
    } else {
        $errorMessage = isset($response['body']['message']) ? $response['body']['message'] : 'Usuario modificado';
        echo "<script>alert('$errorMessage'); window.location='form_edita_usuario.php';</script>";
    }
}
?>
