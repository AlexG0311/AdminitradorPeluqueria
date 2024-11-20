<?php
session_start();
require_once("conexion_api.php");

// Crear una instancia de la clase de conexión
$api = new ConexionAPI();

// Hacer una solicitud a la API para obtener los usuarios
$usuarios = $api->get("/usuarios");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Panel de Administración</title>
  <link href="style.css" type="text/css" rel="stylesheet">
</head>
<body>
  <div class="admin-container">
    <!-- Menú lateral -->
    <div class="sidebar" id="sidebar">
      <div class="close-sidebar" onclick="toggleSidebar()"></div>
      <ul>
        <li><a href="Usuarios/form_guarda_usuario.php"><img src="Usuarios/imagenes/ad_usuario.png" alt="Crear usuario"> Crear Usuario</a></li>
        <li><a href="Usuarios/form_edita_usuario.php"><img src="Usuarios/imagenes/ed_usuario.png" alt="Editar usuario"> Editar Usuario</a></li>
        <li><a href="Usuarios/form_elimina_usuario.php"><img src="Usuarios/imagenes/el_usuario.png" alt="Eliminar usuario"> Eliminar Usuario</a></li>
        <li><a href="Usuarios/consultaUsuarios.php"><img src="Usuarios/imagenes/co_usuario.png" alt="Consultar usuario"> Consultar Usuarios</a></li>
        <li><a href="Producto/form_guarda_producto.php"><img src="Usuarios/imagenes/ad_usuario.png" alt="Crear producto"> Crear Producto</a></li>
        <li><a href="Producto/form_edita_producto.php"><img src="Usuarios/imagenes/ed_usuario.png" alt="Editar producto"> Editar Producto</a></li>
        <li><a href="Producto/form_elimina_producto.php"><img src="Usuarios/imagenes/el_usuario.png" alt="Eliminar producto"> Eliminar Producto</a></li>
        <li><a href="Producto/consultaProducto.php"><img src="Usuarios/imagenes/co_usuario.png" alt="Consultar producto"> Consultar Productos</a></li>
        <li><a href="Servicios/form_guarda_servicios.php"><img src="Usuarios/imagenes/ad_usuario.png" alt="Crear servicio"> Crear Servicio</a></li>
        <li><a href="Servicios/form_edita_servicios.php"><img src="Usuarios/imagenes/ed_usuario.png" alt="Editar servicio"> Editar Servicio</a></li>
        <li><a href="Servicios/form_elimina_servicios.php"><img src="Usuarios/imagenes/el_usuario.png" alt="Eliminar servicio"> Eliminar Servicio</a></li>
        <li><a href="Servicios/consultaServicios.php"><img src="Usuarios/imagenes/co_usuario.png" alt="Consultar servicio"> Consultar Servicios</a></li>
        
        <!-- Nueva opción para agregar horario a un empleado -->
        <li><a href="Horario/form_agrega_horario.php"><img src="Usuarios/imagenes/ad_usuario.png" alt="Agregar Horario"> Agregar Horario a Empleado</a></li>
      </ul>
    </div>

    <!-- Botón de menú -->
    <div class="menu-toggle" onclick="toggleSidebar()">☰ Menú</div>

    <!-- Contenido principal -->
    <div class="main-content">
      <div class="top-bar">
        <h1>Bienvenido, <?php echo isset($_SESSION["usuario"]) ? $_SESSION["usuario"] : "Administrador"; ?></h1>
      </div>

      <div class="dashboard-overview">
        <div class="overview-card">
          <h3>Usuarios Registrados</h3>
          <p><?php echo count($usuarios); ?></p>
        </div>
      </div>

      <div class="info-panels">
        <div class="info-card">
          <h3>Opciones de Usuario</h3>
          <ul>
            <li><a href='Usuarios/form_guarda_usuario.php'>Crear un usuario</a></li>
            <li><a href='Usuarios/form_edita_usuario.php'>Editar un usuario</a></li>
            <li><a href='Usuarios/form_elimina_usuario.php'>Eliminar un usuario</a></li>
            <li><a href='Usuarios/consultaUsuarios.php'>Consultar usuarios</a></li>
          </ul>
        </div>

        <!-- Nueva tarjeta para agregar horario a un empleado -->
        <div class="info-card">
          <h3>Opciones de Horario</h3>
          <ul>
            <li><a href="Horario/form_agrega_horario.php">Agregar Horario a Empleado</a></li>
          </ul>
        </div>

        <!-- Agrega más paneles si es necesario -->
      </div>
    </div>
  </div>

  <!-- JavaScript para manejar el menú -->
  <script>
    function toggleSidebar() {
      const sidebar = document.getElementById('sidebar');
      sidebar.classList.toggle('open');
    }
  </script>
</body>
</html>
