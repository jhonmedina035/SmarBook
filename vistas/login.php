<?php
session_start();
require('../controlador/funciones.php');
require('../modelo/clases.php');
include('alerta.php');

if(isset($_POST['enviar']))
{
    $clave =$_POST['clave'];
    $usuario=$_POST['usuario'];

    $salt = substr ($usuario, 0, 3); //substraer del correo
    $clave_crypt = crypt ($clave, $salt);//guardamos la clave encriptada

    $datos = array($usuario,$clave_crypt);
    if(datos_vacios($datos) == false)
    {
        if(strpos($datos[0], " " ) == false)
        
        {
            $resultado = usuarios :: verificar($datos[0]);
            if(empty($resultado)==false)
            {
                if($datos[1] == $resultado[4])
                {
                   $_SESSION['id_user'] = $resultado[0];
                   $_SESSION['nombre'] = $resultado[2];
                   header('location: home_2.php');
                }else{
                    echo "<script> alertaRegistro('error','Error','contraseña incorrecta');</script>";
                }

            }else{
                echo "<script> alertaRegistro('error','Error','No hay nadie registrado con ese nombre de usuario');</script>";
                
            }
        }
    }else{
        echo "<script> alertaRegistro('error','Error','Los campos estan vacios');</script>";
        
    }  
}         
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  
     <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/estilo_login.css">

      
</head>
<body>

<form class="formulario" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
    <a class="link" href="index.php"><img src="logo/logo2.png"></a>
    
    <h1>Login</h1>
     <div class="contenedor">
     
         <div class="input-contenedor">
         <i class="fas fa-envelope icon"></i>
         <input type="text" placeholder="Nombre de usuario" name="usuario">
         
         </div>
         
         <div class="input-contenedor">
         <i class="fas fa-key icon"></i>
         <input type="password"  id="contrasena"  placeholder="Contraseña" name="clave"/>
         </div>
         <!--checkbox de mostrar contraseña-->
         <div style="margin-top:15px;">
          <input style="margin-left:5px;" type="checkbox" id="mostrar_contrasena" title="clic para mostrar contraseña"/>
          &nbsp;&nbsp;Mostrar Contraseña</div>
        </div>
 
         
         <input type="submit" value="Ingresar" class="button" name="enviar">
         
         
         
         <p>Al registrarte, aceptas nuestras Condiciones de uso y Política de privacidad.</p>
         <p>¿No tienes una cuenta? <a class="link" href="registro.php">Registrate </a></p>
         <p><a class="link" href="index.php"> regresar </a></p>
         <!--<p class="error"><?php //echo $error ?> </p>-->
     </div>
    </form>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- JavaScript Bundle with Popper -->
<script src="js/jquery-3.6.0.min.js"></script>
<script src="js/clave.js"></script>

</body>
</html> 
    





