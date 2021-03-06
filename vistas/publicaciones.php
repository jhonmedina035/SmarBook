<?php

if(isset($_POST['comentario']))
{
    if(!empty($_POST['comentario']))
    {
        comentarios::agregar($_POST['comentario'], $_SESSION['id_user'], $_POST['id_publicaciones']);
        notificaciones :: agregar(1, $_POST['id_publicaciones'] ,$_SESSION['id_user']); 
    }
}
// validar accion si es like o dislike 
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
?>
<div class="publicaciones">
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
                <p id="like"class=" fas fa-thumbs-up"><?php echo mg::mostrarlikes($posts['id_publicaciones'])[0][0]; ?> me gusta</p>
                <p id="like"class="fas fa-thumbs-down"><?php echo mg::mostrarDislikes($posts['id_publicaciones'])[0][0]; ?> no gusta</p>
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
                    <a href = "<?php echo $_SERVER['PHP_SELF']?>?mg=1&&id_publicaciones=<?php echo $posts['id_publicaciones']?>&&accion=1" class="far fa-thumbs-up"></a>
                    <a href = "<?php echo $_SERVER['PHP_SELF']?>?mg=1&&id_publicaciones=<?php echo $posts['id_publicaciones']?>&&accion=0" class="far fa-thumbs-down"></a>
                <?php else: ?> 
                    <a  class="far fa-thumbs-up"></a>
                    <a class="far fa-thumbs-down"></a>
                <?php endif; ?>    
                <i ></i>
                  
                <form action="<?php echo $_SERVER['PHP_SELF']?>" class="comentario" method="POST">
                    <input type="text" name="comentario" placeholder="Escribe tu comentario">
                    <input type="hidden" name="id_publicaciones" value="<?php echo $posts['id_publicaciones']?>">
                </form>
            </div>
        <?php endforeach;?>
    <?php endif;?>
</div>
</Main> 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

