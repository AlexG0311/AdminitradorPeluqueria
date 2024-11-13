<?php
     session_start();
     require_once("../conexion_api.php");

     $usuario = $_POST["usuario"];
     $pass = $_POST["pass"];

     // Crear una instancia de la clase para realizar el login
     $conexionAPI = new ConexionAPI();
     $response = $conexionAPI->login($usuario, $pass);

     if ($response && isset($response['idUsuario'])) {
         // Guardar detalles en la sesión si el inicio de sesión es exitoso
         $_SESSION["usuario"] = $response['Nombre'];
         $_SESSION["idUsuario"] = $response['idUsuario'];
         
         header("location:../admin.php");
     } else {
         echo "<script language='javascript'>alert('Datos incorrectos'); window.location='../index.php?param=1';</script>";
     }
?>