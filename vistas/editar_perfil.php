<?php 
require('header.php');

$usuario = mysqli_fetch_array(usuarios::usuario_por_codigo($_SESSION['id_user']), MYSQLI_BOTH);
if(isset($_POST['editar']))
{
    // destino para alacenar la foto fisica 
    $destino ='subidos/';
    //revisar esta validacion 
    $foto_perfil = !empty($_FILES) ? $destino.$_FILES['foto']['name']:$usuario['foto_perfil'];
    $tmp = $_FILES['foto']['tmp_name'];
    //creamos arreglo de los datos del formulario editar 
    $datos = array(
        $_POST['nombre'],
        $_POST['correo'],
        $_POST['profesion'],
        $_POST['ciudad'],
        $foto_perfil
    );
    // verificamos que el arreglo no este vacio 
    if(strpos($datos[1], " ") == false)
    {
        //enviamos id y el arreglo al metodo editar 
        usuarios::editar($_SESSION['id_user'], $datos);
        // guardamos la imagen de perfil 
        move_uploaded_file($tmp , $foto_perfil);
        //redirecionamos 
        header('location: editar_perfil.php');
    }
}

?>

<div class="editar_perfil">
<div class="imagen-perfil">
        <img id="img" src="../vistas/img/perfil.svg" alt="">

    </div>
    <div class="form_editar">
        <h2 class="titulo_editar">Editar perfil </h2>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data" method ="post">
            <input type="text" name="nombre" class="form-control mb-3" value="<?php echo $usuario['nombre']; ?>">
            <input type="text" name="correo" class="form-control mb-3" value="<?php echo $usuario['correo']; ?>">
            <input type="text" name="profesion" class="form-control mb-3" value="<?php echo $usuario['profesion']; ?>">
            <input type="text" name="ciudad" class="form-control mb-3" value="<?php echo $usuario['ciudad']; ?>">
            <input type="file"name="foto" class="form-control mb-3" value="Carga tu foto">
            <input type="submit" value="Editar" name="editar" id="botonn"class="btn ">
        </form>
        <div class="Registrar">
            <a id="volver"class="btn fas fa-long-arrow-alt-left" href="perfil.php?id_user=<?php echo $_SESSION['id_user'];?>"> Volver al perfil</a>
        </div>
    </div>
  

</div>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</body>
</html>
