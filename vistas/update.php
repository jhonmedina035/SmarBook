<?php
include("../controlador/funciones.php");
//require("../modelo/clases.php");
$con=conexion();



   

$id=$_POST['id_user'];
$nombre=$_POST['nombre'];
$usuario= $_POST['usuario'];
$clave=$_POST['clave'];
$ciudad=$_POST['ciudad'];
$profesion= $_POST['profesion'];
$edad= $_POST['edad'];
$rol= $_POST['rol'];
$estado=$_POST['id_estado'];
$correo=$_POST['correo'];




$instruccion="UPDATE usuarios SET nombre='$nombre', usuario='$usuario', clave='$clave', ciudad='$ciudad',    profesion='$profesion', edad='$edad', rol='$rol', id_estado='$estado', correo='$correo'  WHERE id_user='$id'";
$consulta= mysqli_query($con,$instruccion)
or die("fallo algo");

if($consulta){
    header("Location: administrador.php");


}




?>