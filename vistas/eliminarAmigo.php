
<?php
require('header.php');

if(isset($_GET['id_user'])){
    amigos :: eliminar($_SESSION['id_user'],$_GET['id_user']);
    header('location: ../vistas/home_2.php');
}else{
    echo("no entro al if");
}
?>



