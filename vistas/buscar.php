<?php
require('header.php');

if(isset($_GET['busqueda']))
{
    $nombre = $_GET['busqueda'];
    $con = conexion();
    $instruccion =("SELECT * FROM usuarios WHERE nombre like '$nombre' ");
    $consulta = mysqli_query($con,$instruccion)
    or die ("Fallo en la consulta verificar buscar");
    $nfilas =$consulta->fetch_all();    
}

?>
<div class="resultado-busqueda">
    <?php if(!empty($nfilas)): ?>
        <?php foreach($nfilas as $r): ?>
            <div class="usuarios">
                <div class="img"> 
                    <a href="perfil.php?id_user=<?php echo $r[0]; ?>"><img src="<?php echo $r[1];?>" alt=""></a>
                </div>
                <div class="nombre_usuario">
                    <a href="perfil.php?id_user=<?php echo $r[0]; ?>"><?php echo $r[2]; ?></a>
                </div>
            </div>
        <?php endforeach;?>
    <?php else: ?>        
        <h1 class="no-resultados">  No se a encontrado nada  </h1>
    <?php endif; ?>    
</div>
</body>
</htmla>