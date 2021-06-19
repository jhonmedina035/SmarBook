<?php 
require('../controlador/funciones.php');
require('../modelo/clases.php');
require('alerta.php');
$patron_texto = "/^[a-zA-ZáéíóúÁÉÍÓÚñäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s]+$/";

// ejecuta la funcion javaScript y envia los parametros 
    
     //echo "<script> mostrarAlerta('error','Error','cabeza de bola ');</script>";

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

        if(datos_vacios($datos)==True)
        {
            ?>
            <script>
            alert('por favor ingresa todos los datos');
            </script>   
            <?php
        }elseif((strpos($datos[1], " "))||(strpos($datos[3]," "))||(strpos($datos[5]," "))||(strpos($datos[6]," ")))
        {
            echo "verifica que el usuario, la ciudad, la edad y el correo ingresados no contengan espacios en blanco";


        }elseif(!empty(usuarios :: verificar($datos[1]))){

            echo "Elige otro nombre de usuario, el nombre $datos[1] ya se encuentra en uso";


        }elseif(!empty(usuarios::verificarCorreo($datos[6]))){
            echo "Elige otro correo, el correo $datos[6] ya se encuentra en uso";


        }elseif (!preg_match($patron_texto, $datos[0])){
            echo "El nombre no debe contener numeros ni simbolos";

        }elseif(!preg_match($patron_texto, $datos[4])){
            echo "La profesion no debe contener numeros ni simbolos";

        }elseif(usuarios::validarEdad($datos[5])==FALSE){
            echo"Debe ingresar un numero";

        }elseif (!preg_match($patron_texto, $datos[3])){
            echo "la ciudad no debe tener numeros ni simbolos";

        }elseif($clave != $clave_conf) {
            echo "Las claves no coinciden intentalo de nuevo";

        }else{
            usuarios :: Registrar($datos);
            ?>
            <script>
            alert('Registro Exitoso');
            window.location=("../vistas/login.php");
    
            </script>
            <?php
    
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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
    
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