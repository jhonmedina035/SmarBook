<?php
require('../controlador/funciones.php');
if($_SESSION['rol']==1)
{
$con=conexion();
$id=$_GET['id'];

$instruccion="SELECT * FROM usuarios WHERE id_user='$id'";
$consulta=mysqli_query($con,$instruccion);
$filas=mysqli_fetch_array($consulta);

    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" >
    <title>Document</title>
</head>
<body>
<div style="margin-top: 1em;" class="col-md-8 container">
<form action="update.php" method="POST">
            <input type="hiden"  class="form-control mb-3" name="id_user" readonly onmousedown="return false;" placeholder="id"value="<?php echo $filas['id_user']?>">
            <input type="hiden" class="form-control mb-3" name="nombre" placeholder="nombre" value="<?php echo $filas['nombre']?>">
            <input type="text" class="form-control mb-3" name="usuario" placeholder="usuario" value="<?php echo $filas['usuario']?>">
            <input type="text" class="form-control mb-3" name="edad" placeholder="edad" value="<?php echo $filas['edad']?>">
            <input type="text" class="form-control mb-3" name="profesion" placeholder="profesion" value="<?php echo $filas['profesion']?>">
            <input type="text" class="form-control mb-3" name="correo" placeholder="correo" value="<?php echo $filas['correo']?>">
            <input type="text" class="form-control mb-3" name="ciudad" placeholder="ciudad" value="<?php echo $filas['ciudad']?>">
            <input type="text" class="form-control mb-3" name="clave" placeholder="clave" value="<?php echo $filas['clave']?>">
            <input type="text" class="form-control mb-3" name="rol" placeholder="rol" value="<?php echo $filas['rol']?>">
            <input type="text" class="form-control mb-3" name="id_estado" placeholder="estado"value="<?php echo $filas['id_estado']?>">

            <div style="text-align: center;">
            <input  type="submit" class="btn btn-success" value="Actualizar">
            </div>
            
</form>

</div>
    
</body>
</html>
<?php
}
else{
    header('location: home_2.php');
}