<?php
session_start();
require_once("../conexion_api.php");


if (!isset($_POST['idUsuario']) || $_POST['idUsuario'] == '0') {
    echo "<script>alert('No se ha seleccionado un usuario para editar'); window.location='form_edita_usuario.php';</script>";
    exit;
}

$idUsuario = $_POST['idUsuario'];
$api = new ConexionAPI();
$usuario = $api->get("/usuarios/" . urlencode($idUsuario));

if (!$usuario || !is_array($usuario)) {
    echo "<script>alert('No se pudo obtener la información del usuario'); window.location='form_edita_usuario.php';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Modificar usuario</title>
    <link rel="stylesheet" type="text/css" href="../src/css/estilos.css">
    <script type="text/javascript" language="javascript">
        function atras() {
            window.location = "../admin.php";
        }
       
    </script>
</head>
<body>
    <div id="contenedor">
        <h2 class="titulo2">Editar usuario: <?php echo htmlspecialchars($usuario['Nombre']); ?></h2>
        <form action="edita_usuario.php" method="POST">
            <div class="campos">
                <label>Nombre: *</label>
                <input type="text" name="nombre" value="<?php echo htmlspecialchars($usuario['Nombre']); ?>"><br><br>
                <label>Apellidos: *</label>
                <input type="text" name="apellidos" value="<?php echo htmlspecialchars($usuario['Apellidos']); ?>"><br><br>
                <label>Email: *</label>
                <input type="text" name="email" value="<?php echo htmlspecialchars($usuario['Correo']); ?>"><br><br>
                <label>Contraseña: *</label>
                <input type="password" name="pass" value="<?php echo htmlspecialchars($usuario['Contrasena']); ?>"><br><br>
                <label>Teléfono: *</label>
                <input type="text" name="telefono" value="<?php echo htmlspecialchars($usuario['Telefono']); ?>"><br><br>
                <input type="hidden" name="idUsuario" value="<?php echo htmlspecialchars($idUsuario); ?>">
                <input type="submit" value="Aceptar">
              
        <input type="button" value="Volver" onclick="atras()"> 
            </div>
        </form>
    </div>
</body>
</html>
