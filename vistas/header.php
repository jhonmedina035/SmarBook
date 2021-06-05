<?php 
require('../controlador/funciones.php');
require('../modelo/clases.php');
session_start();
verificar_session();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">
    <title>HOME 2</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="css/estilo_home9.css">
    <link rel="stylesheet" href="css/estilos_home_2.css">
    <link rel="stylesheet" href="logo/iconos/style.css">
</head>
    <body>
        <header class="header">
            <div class="contenedor_header">
            
                <a href=""> <img class="logo" src="logo/logo2.png" alt=""></a>
                
                <form action="buscar.php">
                    <input type="text" name="busqueda" placeholder="Buscar amigos">
                </form> 
                
                <nav class="navegacion">
                    <ul class="menu-header">       
                        <li><a href="home_2.php" ><samp class="icon-home"></samp> INICIO</a></li>
                        <li id="info-solicitud">
                        <?php $soli = amigos::solicitudes($_SESSION['id_user']);?>
                            <a href="#"><samp class="icon-users"></samp> <samp><?php if(count($soli) > 0) echo count($soli) ?></samp></a>
                            <?php if(count($soli) > 0): ?>
                                
                                <ul class="sup_menu">
                                    <?php  foreach($soli as $solicitudes): ?>
                                        <li><a href="perfil.php?id_user=<?php echo $solicitudes[0]?>"><?php echo $solicitudes[1]; ?></a></li>
                                        <ul id="solicitud-confirmar">
                                            <li>
                                            <a href="../controlador/solicitud.php?id_amigo=<?php echo $solicitudes[2]?>&&accion=1" class="icon-checkmark"></a>
                                            </li>
                                            <li>
                                            <a href="../controlador/solicitud.php?id_amigo=<?php echo $solicitudes[2]?>&&accion=2" class="icon-cross"></a>
                                            </li>
                                        </ul>
                                    <?php endforeach; ?>
                                </ul>
                           <?php endif;?> 
                        </li>
                        <li id="innfo-notificaciones">
                            <?php $not = notificaciones::mostrar($_SESSION['id_user']) ?>
                            <a href="#"><samp class="icon-bell"></samp> <samp><?php if(!empty($not)) echo count($not)?></samp></a>
                            <?php if(!empty($not)): ?>
                            <ul class="sup_menu">
                                <li>
                                <?php foreach($not as $noti): ?>   
                                    <a href="post.php?id_publicacion=<?php echo $noti[4]?>&&id_not=<?php echo $noti[2]; ?>">
                                    <?php  echo $noti[1]?>
                                    <?php if($noti[3] == 0): ?>
                                        <p>Le gusta tu publicacion</p>
                                    <?php else:?>
                                        <p>Comento una publicion</p> 
                                    <?php endif; ?>     
                                    </a>
                                    <?php endforeach; ?>
                                </li>
                            </ul>
                            <?php endif; ?>  
                        </li>

                        <li class="menu"><a href="#" ><samp class="icon-list"></samp></a>
                            <ul class="sup_menu">
                                <li><a href="#"><?php echo $_SESSION['nombre'];?></a>
                                <li><a href="perfil.php?id_user=<?php echo $_SESSION['id_user']?>">perfil</a></li>
                                <li><a href="subir_curso.PHP"> Montar contenido </a></li>
                                <li><a href="../controlador/cerrar_session.php">salir</a></li>
                            </ul>
                        </li>    
                    </ul>
                </nav>
            </div>
        </header>