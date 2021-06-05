<?php 
require('../controlador/funciones.php');
require('../modelo/clases.php');
$error ="";

    if(isset($_POST['registrar']))
    {
        $clave = $_POST['clave'];
        $clave_conf = $_POST['confirmar_clave'];
        $usuario=$_POST['usuario'];
        // encripatamos los datos 
        $salt = substr ($usuario, 0, 3); //substraer del usuario
        $clave_crypt = crypt ($clave, $salt);//guardamos la clave encriptada
        // creamos un arreglo con los datos del formulario registrar
        $datos = array(
            $_POST['nombre'],
            $_POST['usuario'],
            $clave_crypt,
            $_POST['ciudad'],
            $_POST['profecion'],
            $_POST['edad'],
            $_POST['correo'],
        );
        
        if(datos_vacios($datos) == false)
        {
            $datos = limpiar($datos);

            /*Validar que los campos no nontengan espacios vacios */

            if(strpos($datos[1], " " ) == false)
            {
                /*Validar que el usario no este*/
                if(empty(usuarios :: verificar($datos[1])))
                {
                    /*enviar el arreglo a la funcion registrar que se encuenta en las clases*/
                    usuarios :: Registrar($datos);

                    ?>
                    <script>//mostrar al usuario mensaje y direccionar 
                        window.alert('Te has registrado con exito ya puedes iniciar');
                        window.location='login.php';
                    </script>
                    <?php
                

                }else
                {
                   $error .="El usuario ya existe"; 
                }
            }else{
                $error .= "El campo usuarios no deve contener espacios";
            }  
        }else
        {
            $error .= "hay campos vacios";
        }   
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="css/estilo_login.css">
</head>
<body>
    <form class="formulario" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
    <a class="link" href="index.php"><img src="logo/logo2.png" alt="" ></a>
        <h1>Registrate</h1>
        <div class="contenedor">
        
            <div class="input-contenedor">
                <i class="fas fa-user icon"></i>
                <input type="text" placeholder="Nombre completo" name="nombre">
            </div>

            <div class="input-contenedor">
                <i class="fas fa-user icon"></i>
                <input type="text" placeholder="Nombre de Usuario" name="usuario">
            </div>
            
            <div class="input-contenedor">
                <i class="fas fa-envelope icon"></i>
                <input type="text" placeholder="Edad" name="edad">
            </div>
            
            <div class="input-contenedor">
                <i class="fas fa-key icon"></i>
                <input type="text" placeholder="Profesion" name="profecion">
            </div>

            <div class="input-contenedor">
                <i class="fas fa-user icon"></i>
                <input type="text" placeholder="Email" name="correo">
            </div>

            <div class="input-contenedor">
                <i class="fas fa-key icon"></i>
                <input type="text" placeholder="Ciudad" name="ciudad">
            </div>

            <div class="input-contenedor">
                <i class="fas fa-key icon"></i>
                <input type="password" placeholder="Contraseña" name="clave">
            </div>

            <div class="input-contenedor">
                <i class="fas fa-key icon"></i>
                <input type="password" placeholder="Confirmar contraseña" name="confirmar_clave">
            </div>

            <input type="submit" value="Registrate" class="button" name="registrar">
            <p>Al registrarte, aceptas nuestras Condiciones de uso y Política de privacidad.</p>
            <p>¿Ya tienes una cuenta?<a class="link" href="login.php">Iniciar Sesion</a></p>
            <?php if(!empty($error)): ?>
                <p class="error"><?php echo $error;?></p>
            <?php endif;?>
            <p><a class="link" href="index.php"> regresar </a></p>
        </div>
    </form>    
</body>
</html>