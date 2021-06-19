
<?php
require('header.php');
require('subir.php');


if(isset($_POST['crear_contenido']) and !empty($_FILES) and !empty($_POST['contenido']))
{
    $destino ='subidos/';
    $contenido = $_POST['contenido']; 
    $img = $destino . $_FILES['archivo']['name'];
    $tmp = $_FILES['archivo']['tmp_name'];
    post :: agregar($_SESSION['id_user'],$contenido, $img);
    move_uploaded_file($tmp,$img);
    header('location: home_2.php');
}

require('publicacionesGeneral.php');


?>


       
           