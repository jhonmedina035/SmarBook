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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/estilo_login.css">
    
</head>
      
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
         <input type="password" placeholder="Contraseña" name="clave">
         
         </div>
         <input type="submit" value="Ingresar" class="button" name="enviar">
         <p>Al registrarte, aceptas nuestras Condiciones de uso y Política de privacidad.</p>
         <p>¿No tienes una cuenta? <a class="link" href="registro.php">Registrate </a></p>
         <p><a class="link" href="index.php"> regresar </a></p>
         <!--<p class="error"><?php //echo $error ?> </p>-->
     </div>
    </form>
</body>
</html>