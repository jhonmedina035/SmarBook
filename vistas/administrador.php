<?php

require('../controlador/funciones.php');
session_start();
verificar_session();
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
    <title>Document</title>
</head>
<body>
 <header>
    <h1 class="usuario">Bienvenid@ <?php echo $_SESSION['nombre']; ?></h1>
    </header>
    <div class="container mt-5">
        <div class="row">
            <div id="formulario"class="col-md-3">
            <h3 class="titulo">Ingresar Usuarios</h3>
            <form action="insertar.php" method="POST">
            <input type="text" class="form-control mb-3" name="nombre" placeholder="nombre">
            <input type="text" class="form-control mb-3" name="usuario" placeholder="usuario">
            <input type="text" class="form-control mb-3" name="edad" placeholder="edad">
            <input type="text" class="form-control mb-3" name="profesion" placeholder="profesion">
            <input type="email" class="form-control mb-3" name="correo" placeholder="correo">
            <input type="text" class="form-control mb-3" name="ciudad" placeholder="ciudad">
            <input type="password" class="form-control mb-3" name="clave" placeholder="clave">
            <input type="password" class="form-control mb-3" name="confirmar_clave" placeholder="confirmar_clave">
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

            <input type="submit" class="btn btn-success" value="Guardar" name="guardar">
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
                    <th><a href="actualizar.php?id=<?php echo $filas['id_user']?>" class="btn btn-info">Editar</a></th>
                    <th><a href="eliminar.php?id=<?php echo $filas['id_user']?>" class="btn btn-danger">Eliminar</a></th>
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
</html>