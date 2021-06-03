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
    <div class="form_editar">
        <h1> Editar perfil</h1>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data" method ="post">
            <input type="text" name="nombre" class="input-control" value="<?php echo $usuario['nombre']; ?>">
            <input type="text" name="correo" class="input-control" value="<?php echo $usuario['correo']; ?>">
            <input type="text" name="profesion" class="input-control" value="<?php echo $usuario['profesion']; ?>">
            <input type="text" name="ciudad" class="input-control" value="<?php echo $usuario['ciudad']; ?>">
            <input type="file" name="foto" >
            <input type="submit" value="Editar" name="editar" class="botton">
        </form>
        <div class="Registrar">
            <a href="perfil.php?id_user=<?php echo $_SESSION['id_user'];?>"> Volver al perfil</a>
        </div>
    </div>

</div>

</body>
</html>
