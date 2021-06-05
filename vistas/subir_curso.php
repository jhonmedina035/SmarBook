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
<h1 class="titulo_curso">Crear un curso</h1>

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

      <form class="prueba" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" method="POST">
          <input type="text" id="nombre_curso" name="nombre_curso" placeholder=" nombre del curso ">
          <div>
            <label for="menu"> Categorias</label>
            <select name="menu" >
              <option value="0"></option>
              <?php foreach($cate as $c): ?>
               <option value="<?php echo $c['id_categoria'];?>"><?php echo $c['nombre'];?></option> 
              <?php endforeach; ?>
            </select>
          </div>
            <input type="submit" name="crear_curso" value="Crear">
      </form> 
      
      <h3 class="titulo_curso"> Subir contenido </h3>

      <form class="prueba" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" method="POST">
          <input type="text" id="nombre_contenido" name="contenido" placeholder="Has una breve descripción de contenido que vas a montar">
          <div>
            <label for="menu"> Cursos </label>
            <select name="menu-curso">
              <option value="0"></option>
              <?php foreach($cursos as $c): ?>
                <option value="<?php echo $c['id_cursos'];?>"><?php echo $c['nombre'];?></option> 
              <?php endforeach; ?>
            </select>
          </div>
            <input type="file" name="archivo" id="archivo">
            <input type="submit" name="crear_contenido" value="publicar video">
      </form>  

    </div>  
</div>
</body>
</html>