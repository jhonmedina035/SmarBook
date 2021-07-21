<?php 
require('header.php');
usuarios::quitar_nuevo($_SESSION['id_user']);
header('location: home_2.php');
?>