<?php
//inicio de sesion 
session_start();
session_destroy()
?>

<script>//mostrar al usuario el error y direccionar 
         window.alert('La sesion a finalizado con exito');
         window.location='../vistas/index.php';
</script>