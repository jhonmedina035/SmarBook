
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
            <div class="publi-thumb "><img src="<?php echo $posts['img'];?>" alt=""></div>
            <div class="publi-thumb "><video src="<?php echo $posts['img'];?>" width=320  height=240 controls poster="vistaprevia.jpg"> alt=""></div>
            <p id="like"><?php echo mg::mostrar($posts['id_publicaciones'])[0][0]; ?> me gusta</p>
            
            <div id="mostrar comentario">
                <?php $comentario = comentarios::mostrar($posts['id_publicaciones']); ?>
                <?php if(!empty($comentario)): ?>
                    <?php foreach($comentario as $c): ?>
                        <p class="comentario-nombre"> <?php echo $c[0] ?><samp class="comentarios"><?php echo $c[1] ?></samp></p>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
           
            <div class="publi-contene-like">
     
                <?php if(count(mg::verificar_mg($posts['id_publicaciones'], $_SESSION['id_user'])) == 0): ?>  
                    <a href = "<?php echo $_SERVER['PHP_SELF']?>?mg=1&&id_publicaciones=<?php echo $posts['id_publicaciones']?>" class="like icon-happy"></a> 
                <?php else: ?> 
                    <a  class="like icon-happy2"></a>
                <?php endif; ?>    
                <a href = "<?php echo $_SERVER['PHP_SELF']?>" class="like icon-sad"></a>
                     
                <form action="<?php echo $_SERVER['PHP_SELF']?>" class="comentario" method="POST">
                    <input type="text" name="comentario" placeholder="Escribe tu comentario">
                    <input type="hidden" name="id_publicaciones" value="<?php echo $posts['id_publicaciones']?>">
                </form>
            </div>
        <?php endforeach;?>
    <?php endif;?>
</div>
</Main> 
