<?php 

require('header.php');

if(isset($_GET['id_publicacion']))
{
    notificaciones::vistas($_GET['id_not']);
    $post = post::mostrar_por_codigo_post($_GET['id_publicacion']);
    require('publicaciones.php');
}

?>

</body>
</html>