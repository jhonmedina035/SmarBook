<?php
require('header.php');

if(isset($_GET['id_curso'])){
    $post = Cursos :: mostrarTodo($_GET['id_curso']);
    $cur = Cursos :: cursos_por_id($_GET['id_curso']);
    $datocur = mysqli_fetch_array($cur, MYSQLI_BOTH);
    $cat = Cursos :: mostrar_categoria_por_id($datocur[3]);
    $datocat = mysqli_fetch_array($cat, MYSQLI_BOTH);
}


?>

<div class="publicaciones">
    <div class="titulosCurso">
        <h1 class="centrarTxt"><?php echo $datocur[1];?> </h1>
        <H3 class="centrarTxt"> De la categoria de   <?php echo $datocat[1];?> </H3>
    </div>
    
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

    <form class="calificar">
        <h3 class="txtcalificar">Calificar curso</h3>

        <p class="clasificacion">
            <input id="radio1" type="radio" name="estrellas" value="5"><!--
            --><label for="radio1">★</label><!--
            --><input id="radio2" type="radio" name="estrellas" value="4"><!--
            --><label for="radio2">★</label><!--
            --><input id="radio3" type="radio" name="estrellas" value="3"><!--
            --><label for="radio3">★</label><!--
            --><input id="radio4" type="radio" name="estrellas" value="2"><!--
            --><label for="radio4">★</label><!--
            --><input id="radio5" type="radio" name="estrellas" value="1"><!--
            --><label for="radio5">★</label>
        </p>
    </form>
</div>