<?php

require('../controlador/funciones.php');
session_start();
verificar_session();
if($_SESSION['rol']==1)
{
$con= conexion();
$instruccion = ("SELECT * FROM usuarios");
$consulta= mysqli_query($con, $instruccion);
$filas = mysqli_fetch_array($consulta);
?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/administrador.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Administrador</title>
</head>
<body>
    <header>
        <h2 class="usuario">Bienvenid@ <?php echo $_SESSION['nombre']; ?></h2>
        <a id="logout" href="../controlador/cerrar_session.php" class="btn  fas fa-sign-out-alt">salir</a>
    </header>
    <div class="container mt-5">
        <div class="row">
            <div id="formulario"class="col-md-3">
            <h3 class="titulo">Ingresar Usuarios</h3>
            <form action="insertar.php" method="POST">
            <input type="text" class="form-control mb-3" name="nombre" placeholder="nombre" required>
            <input type="text" class="form-control mb-3" name="usuario" placeholder="usuario" required>
            <input type="text" class="form-control mb-3" name="edad" placeholder="edad" required>
            <input type="text" class="form-control mb-3" name="profesion" placeholder="profesion" required>
            <input type="email" class="form-control mb-3" name="correo" placeholder="correo" required>
            <input type="text" class="form-control mb-3" name="ciudad" placeholder="ciudad" required>
            <input type="password" class="form-control mb-3" name="clave" placeholder="clave" required>
            <input type="password" class="form-control mb-3" name="confirmar_clave" placeholder="confirmar_clave" required>
            <select class="form-control mb-3" name="rol" id="exampleFormControlSelect1">
            <option>Seleccione un rol</option>
            <option value="1">Administrador</option>
            <option value="2">Usuario</option>
            </select>
            <select class="form-control mb-3" name="id_estado" id="exampleFormControlSelect1">
            <option>Seleccione un estado</option>
            <option value="1">Activo</option>
            <option value="2">Inactivo</option>
            </select>
           
           
      

            <!--<input type="text" class="form-control mb-3" name="rol" placeholder="rol">
            <input type="text" class="form-control mb-3" name="id_estado" placeholder="estado">-->
            <div style="text-align: center;">
            <input id="prueba"type="submit" class="btn btn-success" value="Guardar" name="guardar">
            </div>
            </form>
            </div>
            <div  class="col-md-8">
                <table id="tabla1" class="table">
                    <thead id="tabla"class="table-striped">
                    <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Usuario</th>
                    <th>Edad</th>
                    <th>Correo</th>
                    <th>Rol</th>
                    <th>Estado</th>
                    <th></th>
                    <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                     
                        while($filas=mysqli_fetch_array($consulta)){
                    ?>
                    <tr>
                    <th><?php echo $filas['id_user']?></th>
                    <th><?php echo $filas['nombre']?></th>
                    <th><?php echo $filas['usuario']?></th>
                    <th><?php echo $filas['edad']?></th>
                    <th><?php echo $filas['correo']?></th>
                    <th><?php echo $filas['rol']?></th>
                    <th><?php echo $filas['id_estado']?></th>
                    <th><a href="actualizar.php?id=<?php echo $filas['id_user']?>" class="btn btn-primary fas fa-user-edit"></a></th>
                    <th><a href="eliminar.php?id=<?php echo $filas['id_user']?>" class="btn btn-danger fas fa-trash-alt"></a></th>
                    </tr>
                    <?php
                     }
                    
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="../vistas/js/prueba.js"></script>
</html>
<?php

}
else{
    header('location: home_2.php');
}