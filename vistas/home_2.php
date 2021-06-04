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


$amigos = amigos::codigos_amigos($_SESSION['id_user']);
$post = post::mostrarTodo(1);

if(isset($_POST['comentario']))
{
    if(!empty($_POST['comentario']))
    {
        comentarios::agregar($_POST['comentario'], $_SESSION['id_user'], $_POST['id_publicaciones']);
        notificaciones :: agregar(1, $_POST['id_publicaciones'] ,$_SESSION['id_user']); 
    }
}
if(isset($_GET['mg']))
{
    echo $_GET['id_publicaciones'];
    mg::agregar($_GET['id_publicaciones'], $_SESSION['id_user']);
    notificaciones :: agregar(FALSE, $_GET['id_publicaciones'] ,$_SESSION['id_user']);  
}

require('publicacionesGeneral.php'); 

?>


       
           