<?php
include("../controlador/funciones.php");
require("../modelo/clases.php");
$id=$_GET['id'];

usuarios::eliminarUsuario($id);



?>