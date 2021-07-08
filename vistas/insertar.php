<?php 
require('../controlador/funciones.php');



$clave = $_POST['clave'];
$clave_conf = $_POST['confirmar_clave'];
$usuario=$_POST['usuario'];
// encripatamos los datos 
$salt = substr ($usuario, 0, 3); //substraer del usuario
$clave_crypt = crypt ($clave, $salt);

$con=conexion();
$nombre=$_POST['nombre'];
$usuario=$_POST['usuario'];
$edad=$_POST['edad'];
$profesion=$_POST['profesion'];
$correo=$_POST['correo'];
$ciudad=$_POST['ciudad'];
$clave_crypt = crypt ($clave, $salt);
$rol=$_POST['rol'];
$estado=$_POST['id_estado'];
$foto_perfil="img/img_sin_foto_perfil.jpg";


$instruccion="INSERT INTO usuarios (id_user,foto_perfil,nombre,usuario,clave,ciudad,profesion,edad,rol,id_estado,correo)VALUES (null,'$foto_perfil' ,'$nombre', '$usuario', '$clave', '$ciudad','$profesion','$edad', '$rol','$estado','$correo')";
$consulta= mysqli_query($con,$instruccion)
or die ("Fallo registrar un usuario ");

if($consulta){
    header("Location: administrador.php");


}

 



