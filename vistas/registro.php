<?php 
require('../controlador/funciones.php');
require('../modelo/clases.php');
require('alerta.php');
$patron_texto = "/^[a-zA-ZáéíóúÁÉÍÓÚñäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s]+$/";


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
        // valida que ningun campo este vacio
        if(datos_vacios($datos)==True)
        {
            echo "<script>mostrarAlerta('error','Error','Debe ingresar todos los datos ');</script>";
          
            // validar que los campos de usuario, ciudad, edad y correo no contengan espacios
        }elseif((strpos($datos[1], " "))||(strpos($datos[3]," "))||(strpos($datos[5]," "))||(strpos($datos[6]," ")))
        {
            echo "<script>mostrarAlerta('error','Error','verifica que el usuario, la ciudad, la edad y el correo ingresados no contengan espacios en blanco');</script>";
           
            
         // validar que el usuario que se este registrando no se encuentre repetido
        }elseif(!empty(usuarios :: verificar($datos[1]))){

           
            echo "<script>mostrarAlerta('error','Error','Elige otro nombre de usuario, el nombre $datos[1] ya se encuentra en uso ');</script>";

         // validar que el correo que se este registrando no se encuentre repetido
        }elseif(!empty(usuarios::verificarCorreo($datos[6]))){
            echo "<script>mostrarAlerta('error','Error','Elige otro correo, el correo $datos[6] ya se encuentra en uso ');</script>";
            

         // validar mediante una expresion regular que en el campo de nombre no ingresen numeros 
        }elseif (!preg_match($patron_texto, $datos[0])){
            echo "<script>mostrarAlerta('error','Error','El nombre no debe contener numeros ni simbolos');</script>";

         // validar mediante una expresion regular que en el campo de profesion no ingresen numeros 
        }elseif(!preg_match($patron_texto, $datos[4])){
            echo "<script>mostrarAlerta('error','Error','La profesion no debe contener numeros ni simbolos');</script>";
     
         //validar que en el campo de la edad no ingresen texto
        }elseif(usuarios::validarEdad($datos[5])==FALSE){
            echo "<script>mostrarAlerta('error','Error','El dato ingresado en la edad no es valido');</script>";
         //validar que en la ciudad no ingresen numeros ni simbolos
        }elseif (!preg_match($patron_texto, $datos[3])){
            echo "<script>mostrarAlerta('error','Error','la ciudad no debe tener numeros ni simbolos');</script>";

         //validar que las claves coincidan
        }elseif($clave != $clave_conf) {
            echo "<script> mostrarAlerta('error','Error','Las claves no coinciden intentalo de nuevo ');</script>";
            
         // si ingresa los datos correctamente se registrará el usuario
        }else{
            usuarios :: Registrar($datos);
            echo "<script> alertaRegistro('success','Tu registro ha sido exitoso','Ahora puedes iniciar sesión');</script>";
        
            
    
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