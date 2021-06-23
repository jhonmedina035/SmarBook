<?php
//inicio de sesion 
require('../vistas/alerta.php');
session_start();
session_destroy();



 echo "<script> alerta('success','sesión','La sesíon ha sido finallizada con exito','../vistas/index.php');</script>";

//alerta(icono,titulo,texto,ubicacion)
?>