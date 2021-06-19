<?php
require('header.php');

if(isset($_GET['id_user']))
{ 
    $usuario =  usuarios::usuario_por_codigo($_GET['id_user']);
    if(empty($usuario)) header('location: home_2.php');
    $verificar_amigos = amigos::verificar($_SESSION['id_user'], $_GET['id_user']);
    $post = post::post_por_usuario($_GET['id_user']);
    $row = mysqli_fetch_array($usuario, MYSQLI_BOTH);

}

if(isset($_GET['agregar']))
{
    amigos::agregar($_SESSION['id_user'], $_GET['id_user']);
    header('location: perfil.php?id_user='.$_GET['id_user']);
}

if(isset($_POST['comentario']))
{
    if(!empty($_POST['comentario']))
    {
        comentarios::agregar($_POST['comentario'], $_SESSION['id_user'], $_POST['id_publicaciones']);
        notificaciones :: agregar(1, $_POST['id_publicaciones'] ,$_SESSION['id_user']); 
    }
}


?>

<div id="perfil"> 
    
    <ul class="contenedor_perfil">   
        <li><img src="<?php echo $row['foto_perfil'] ?>" alt="" id="img"></li>
        <li>
            <h1 class="no-resultados"> Perfil</h1>
            <H3><?php echo $row['nombre']?></H3>
            <ul>
                <li>correo <samp> <?php echo $row['correo'] ?> </samp></li>
                <li>Edad <samp> <?php echo $row['edad'] ?> </samp></li>
                <li>Profesión <samp><?php echo $row['profesion'] ?></samp></li>
                <li>Direccion <samp><?php echo $row['ciudad'] ?></samp></li>
                <li>Amigos 
                    <samp>
                        <?php 
                            
                            if(!empty(amigos::cantidad_amigos($_GET['id_user'])))
                                echo amigos::cantidad_amigos($_GET['id_user'])[0][0];
                            else echo 0;      
                        ?>
                    </samp>
                </li>   
                <li>Cursos
                    <samp>
                        <?php 
                            //cambiar a cursos 
                            if(!empty(cursos::cantidad_cursos($_GET['id_user'])))
                                echo cursos::cantidad_cursos($_GET['id_user'])[0][0];
                            else echo 0;      
                        ?>
                    </samp>
                </li>  
            </ul>
        </li>

       
            <?php if($_GET['id_user'] != $_SESSION['id_user']):?>
                <?php if(empty($verificar_amigos)):?>
                    <li><a href="perfil.php?id_user=<?php echo $_GET['id_user']?>&&agregar=<?php echo $_GET['id_user'];?>">Agregar</a></li>
                <?php elseif($verificar_amigos[0][3] != 0):  ?>    
                    <li><a href="#">Amigos</a></li>
                <?php else: ?>    
                    <li><a href="#">Solicitud enviadas</a></li>
                <?php endif; ?>    
            <?php else:?>
                <li><a href="editar_perfil.php">Editar</a></li>
                <li><a href="buscar_amigos.php">Mis amigos</a></li>    
            <?php endif; ?>
    </ul>
</div>
<?php require('publicaciones.php'); ?>

</body>
</html>