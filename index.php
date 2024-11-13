<!-- Archivo: index.html -->
<html>
  <head>
     <title>Ejemplo usuarios</title>
     <meta charset='utf-8'/>
     <link rel="stylesheet" type="text/css" href="src/css/estilos.css">
     <script type="text/javascript" src="src/js/jquery.js"></script> 
  </head>
  <body>
     <div id="contenedor">
        <h2 class="titulo2">Inicio de sesión</h2>
        <form action="Usuarios/procesa.php" method="POST">
           <div class="campos">            
               <label>Usuario:</label>
               <input type="text" id="usuario" name="usuario" required />
               
               <label>Password:</label>
               <input type="password" id="pass" name="pass" required />
               
               <input type="submit" id="login" value="Aceptar">  
               <?php
                  if (isset($_GET['param'])) { 
                     $return = $_GET['param'];
                     if ($return == 1) {
                        echo "<div id='msg' title='Resultado'><p>Usuario / Contraseña incorrectos.</p></div>";
                     }            
                  }   
               ?>
           </div>        
        </form> 
     </div>
  </body>


  
</html>