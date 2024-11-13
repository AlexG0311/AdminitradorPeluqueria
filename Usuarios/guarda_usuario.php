<?php
session_start();
require_once("../conexion_api.php"); // Incluir la clase de conexión a la API

// Obtener los datos del formulario
$nombre = $_POST['nombre'] ?? '';
$apellidos = $_POST['apellidos'] ?? '';
$email = $_POST['email'] ?? '';
$pass = $_POST['pass'] ?? '';
$telefono = $_POST['telefono'] ?? '';

// Validar que todos los campos estén llenos
if (empty($nombre) || empty($apellidos) || empty($email) || empty($pass) || empty($telefono)) {
    echo "<script>alert('Todos los campos son obligatorios'); window.location='form_guarda_usuario.php';</script>";
    exit;
}

// Crear una instancia de la clase de conexión a la API
// Crear una instancia de la clase de conexión a la API
$api = new ConexionAPI();
$response = $api->post("/Usuarios/AddEmpleado", [
    'Nombre' => $_POST['nombre'],
    'Apellidos' => $_POST['apellidos'],
    'Correo' => $_POST['email'],
    'Contrasena' => $_POST['pass'],
    'Telefono' => $_POST['telefono']
]);

// Verificar la respuesta de la API
if ($response && $response['status_code'] === 201) {
    echo "<script>alert('Empleado agregado exitosamente'); window.location='../admin.php';</script>";
} else {
    echo "<script>alert('Error al agregar el empleado'); window.location='form_guarda_usuario.php';</script>";
}

?>
