<?php
require("../modelo/clases.php");
require("../controlador/funciones.php");


if(isset($_GET['id_amigo']) and isset($_GET['accion']))
{
    
    if(isset($_GET['accion'])==1)
    {
        amigos::aceptar(($_GET['id_amigo']));
        
        
    }else{
        amigos::eliminar_solicitud($_GET['id_amigo']);
        
    }
}
?>