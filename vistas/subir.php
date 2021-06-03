<Main class="muro"> 
<?php 
$usuario =  usuarios::usuario_por_codigo($_SESSION['id_user']);
$row = mysqli_fetch_array($usuario, MYSQLI_BOTH); 
?>
            <div class="publicaciones">
                <div class="publi-info-perfil ">
                    <table>
                        <tr>
                            <td><a href="#"><img src="<?php echo $row['foto_perfil'];?> " alt="" class="publi-img-perfil"></a></td>
                            <td><a href="#" id="nombre_usuario" class="nombre_usuario"><?php echo $row['nombre'];?></a> </td>
                        </tr>
                    </table>
                </div>
                <div class="subir">
                  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" method="POST">
                    <input type="text" id="contenido" name="contenido" placeholder="Contenido del curso">
                    <label for="archivo" class="boton-subir icon-play"></label>
                    <input type="file" name="archivo" id="archivo" style="display: none">
                    <input type="hidden" name="publicar">
                    </form>   
                </div>  
            </div>