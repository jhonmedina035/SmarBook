<?php
include("../controlador/funciones.php");
require("../modelo/clases.php");
if($_SESSION['rol']==1)
{
$id=$_GET['id'];

usuarios::eliminarUsuario($id);

}
else{
    header('location: home_2.php');
}

?>