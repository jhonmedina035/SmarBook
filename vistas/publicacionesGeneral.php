<?php 
$amigos = amigos::cantidad_amigos1($_SESSION['id_user']);



foreach ($amigos as $a) {
    echo $a[2];
}

$post = post::mostrarTodo(1);
?>