<?php 

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
    if($_GET['accion']==1) // caso de like
    {
        mg::agregarlike($_GET['id_publicaciones'], $_SESSION['id_user']);//agregar like a la tabla 
        notificaciones :: agregar(FALSE, $_GET['id_publicaciones'] ,$_SESSION['id_user']);// agregar la notificacion 
    }elseif($_GET['accion']==0){ // caso dislike
        mg::agregarDislike($_GET['id_publicaciones'], $_SESSION['id_user']); // agregar disLike
        // No notifico negativamente por cuestion de moral 
    }
}

$amigos = amigos::cantidad_amigos1($_SESSION['id_user']);

$misAmigos[] = $_SESSION['id_user'];
foreach ($amigos as $a) {
    if ($a[1] != $_SESSION['id_user'])
    {
        $misAmigos[] = $a[1];
    }elseif($a[2] != $_SESSION['id_user'])
    {
        $misAmigos[] = $a[2];
    }
}

?>
<div class="publicaciones">
    <?php foreach ($misAmigos as $mia):?>
    <?php $post = post::mostrarTodo($mia)?>
    <?php if(!empty($post)):?>
        <?php foreach($post as $posts): ?>
            <div class="publi-info-perfil ">
                <table>
                    <tr>
                        <td><a href="#"><img src="<?php echo $posts['foto_perfil'];?> " alt="" class="publi-img-perfil"></a></td>
                        <td><a href="#" id="nombre_usuario" class="nombre_usuario"> <?php echo $posts['nombre'];?></a> </td>
                    </tr>
                </table>
            
            </div >
            <div class="publi-contenidos "><p><?php echo $posts['contenido'];?> </p></div>
            <div class="publi-thumb ">
                <video src="<?php echo $posts['img'];?>" controls poster="posterimage.jpg"> 
            </div>
            <div class="link_mostrar">
                <p id="like"><?php echo mg::mostrarlikes($posts['id_publicaciones'])[0][0]; ?> me gusta</p>
                <p id="like"><?php echo mg::mostrarDislikes($posts['id_publicaciones'])[0][0]; ?> no gusta</p>
            </div>
            
            <div id="mostrar comentario">
                <?php $comentario = comentarios::mostrar($posts['id_publicaciones']); ?>
                <?php if(!empty($comentario)): ?>
                    <?php foreach($comentario as $c): ?>
                        <p class="comentario-nombre"> <?php echo $c[0]?><samp>: </samp> <samp class="comentarios"><?php echo $c[1] ?></samp></p>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <div class="publi-contene-like">
                <?php if(count(mg::verificar_mg($posts['id_publicaciones'], $_SESSION['id_user'])) == 0): ?>  
                    <a href = "<?php echo $_SERVER['PHP_SELF']?>?mg=1&&id_publicaciones=<?php echo $posts['id_publicaciones']?>&&accion=1" class="like icon-happy"></a>
                    <a href = "<?php echo $_SERVER['PHP_SELF']?>?mg=1&&id_publicaciones=<?php echo $posts['id_publicaciones']?>&&accion=0" class="like icon-sad"></a>
                <?php else: ?> 
                    <a  class="like icon-happy"></a>
                    <a class="like icon-sad"></a>
                <?php endif; ?>    
                  
                <form action="<?php echo $_SERVER['PHP_SELF']?>" class="comentario" method="POST">
                    <input type="text" name="comentario" placeholder="Escribe tu comentario">
                    <input type="hidden" name="id_publicaciones" value="<?php echo $posts['id_publicaciones']?>">
                </form>
            </div>
        <?php endforeach;?>
    <?php endif;?>
<?php endforeach; ?>
</div>
</Main> 