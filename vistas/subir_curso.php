<?php 
require('header.php');
//trae los datos del usuario que abrio la session 
$usuario =  usuarios::usuario_por_codigo($_SESSION['id_user']);
$row = mysqli_fetch_array($usuario, MYSQLI_BOTH);
//hacer validaciones para que todos los datos esten llenos no olvidar !!!! 
// verificando que el formulario este lleno 
if(!empty($_POST['crear_curso']))
{
  //enviando los datos a la fucion agregar
  Cursos::agregar($_POST['nombre_curso'],$_POST['menu'], $_SESSION['id_user']);
}
$cate = Cursos :: mostrar_categoria();
$cursos = Cursos :: mostrar_cursos($_SESSION['id_user']);



if(isset($_POST['crear_contenido']) and !empty($_FILES) and !empty($_POST['contenido']))
{
    $destino ='subidos/';
    opendir($destino);
    $id_curso = $_POST['menu-curso']; 
    $contenido = $_POST['contenido'];
    $video = $destino . basename($_FILES['archivo']['name']);
    $tmp = $_FILES['archivo']['tmp_name']; 
    move_uploaded_file($tmp,$video);
    post :: agregar($_SESSION['id_user'],$contenido, $video, $id_curso);
    header('location: home_2.php');
}

?>

<h2 style="margin-bottom: 0.5em;" class="titulo_curso">Crear un curso</h2>

<div class="publicaciones" style="margin-bottom:2em;">
  <div class="publi-info-perfil ">
    <table>
      <tr>
          <td><a href="#"><img src="<?php echo $row['foto_perfil'];?> " alt="" class="publi-img-perfil"></a></td>
          <td><a href="#" id="nombre_usuario" class="nombre_usuario"><?php echo $row['nombre'];?></a> </td>
      </tr>
    </table>
  </div>
    <div class="subir" >
       <div class="col-md-12">
          <form class="prueba" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" method="POST">
              <input type="text" class="form-control mb-2" id="nombre_curso" name="nombre_curso" placeholder=" nombre del curso ">
              <div>
                <label for="menu">Categorias</label><br>
                <select class="form-select mb-3" style="width: 534px; margin-right: 10px;"  name="menu" id="exampleFormControlSelect1">
                  <option value="0"></option>
                  <?php foreach($cate as $c): ?>
                  <option value="<?php echo $c['id_categoria'];?>"><?php echo $c['nombre'];?></option> 
                  <?php endforeach; ?>
                </select>
              </div>
                <input type="submit" name="crear_curso" id="botonn"  class="btn" value="Crear">
          </form> 
          
          <h4 style="margin-top: 1em;" class="titulo_curso">Subir contenido</h4>

          <form class="prueba" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" method="POST">
              <div class="form-group">
                <textarea type="text" style="width:534px;" class="form-control mb-2" id="nombre_contenido" rows="3" name="contenido" placeholder="Haz una breve descripción del contenido que vas a montar"></textarea>
              </div>
              <div>
                <label for="menu">Cursos</label><br>
                <select name="menu-curso" style="width:534px; margin-right: 10px;" class="form-select mb-3">
                  <option value="0"></option>
                  <?php foreach($cursos as $c): ?>
                    <option value="<?php echo $c['id_cursos'];?>"><?php echo $c['nombre'];?></option> 
                  <?php endforeach; ?>
                </select>
              </div>
                <input type="file" class="form-control mb-3" style="margin-bottom:2em;" name="archivo" id="archivo">
                <input  style="margin-bottom:2em;"type="submit" id="botonn" name="crear_contenido" class="btn" value="publicar video">
          </form>  
      </div>

    </div>  
</div>
</body>
</html>