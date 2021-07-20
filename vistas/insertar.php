<?php 
require('../controlador/funciones.php');
require('../modelo/clases.php');
require('alerta.php');
$clave = $_POST['clave'];
$clave_conf = $_POST['confirmar_clave'];
$usuario=$_POST['usuario'];
// encripatamos los datos 
$salt = substr ($usuario, 0, 3); //substraer del usuario
$clave_crypt = crypt ($clave, $salt);

$nombre=$_POST['nombre'];
$edad=$_POST['edad'];
$profesion=$_POST['profesion'];
$correo=$_POST['correo'];
$ciudad=$_POST['ciudad'];
$clave_crypt = crypt ($clave, $salt);
$rol=$_POST['rol'];
$estado=$_POST['id_estado'];
$foto_perfil="img/img_sin_foto_perfil.jpg";

if(!empty(usuarios :: verificar($usuario))){
 
    //echo "<script> alertaRegistro('error','Error','contraseña incorrecta');</script>";
    echo "<script> alerta('error','Error','Este nombre de usuario $usuario  ya esta en uso ingrese otro diferente', '../vistas/administrador.php');</script>";       

}
elseif(!empty(usuarios::verificarCorreo($correo))){
    echo "<script> alerta('error','Error','Este correo $correo  ya esta en uso ingrese otro diferente', '../vistas/administrador.php');</script>";

}elseif($clave<>$clave_conf){
    echo "<script> alerta('error','Error','las claves no coinciden', '../vistas/administrador.php');</script>";
}
else{
    usuarios::insetarUsuario($foto_perfil,$nombre,$usuario,
    $clave_crypt,$ciudad,$profesion,$edad,$rol,$estado,$correo);

}

 



