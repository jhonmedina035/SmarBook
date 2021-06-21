<?php
require('header.php');

$amigos = amigos::amigos_por_id($_SESSION['id_user']);
// traer todos los id de mis amigos 
foreach ($amigos as $a) {
    if ($a[1] != $_SESSION['id_user'])
    {
        $misAmigos[] = $a[1];
    }elseif($a[2] != $_SESSION['id_user'])
    {
        $misAmigos[] = $a[2];
    }
}
    // pintar la informacion de mis amigos 
    ?>
    <div class="resultado-busqueda">
        <h1 class="no-resultados"> Todos mis amigos</h1>
        <?php if(!empty($misAmigos)): ?>
            <?php foreach($misAmigos as $r):?>
                <?php $user = usuarios:: usuario_por_codigo($r);
                $row = mysqli_fetch_array($user, MYSQLI_BOTH);?> 
                <div class="usuarios">
                    <div class="img"> 
                        <a href="perfil.php?id_user=<?php echo $row['id_user']; ?>"><img src="<?php echo $row['foto_perfil'];?>" alt=""></a>
                    </div>
                    <div class="nombre_usuario">
                        <a href="perfil.php?id_user=<?php echo $row['id_user']; ?>"><?php echo $row['nombre']; ?></a>
                    </div>
                </div>
            <?php endforeach;?>
        <?php else: ?>        
            <h2 class="no-resultados">no tienes amigos</h2>
        <?php endif; ?>    
    </div>
 
</body>
</htmla>