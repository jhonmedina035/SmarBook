<?php


class Cursos{

    public static function agregar($nombre, $categoria, $id_user)
    {
        $con = conexion();
        $instruccion =("INSERT INTO `cursos`(`id_cursos`, `nombre`, `id_user`, `id_categoria`, `id_estado`) 
                        VALUES (null,'$nombre','$id_user','$categoria',1)");
        $consulta = mysqli_query($con,$instruccion)
        or die ("Fallo en la consulta mostrar categorias");
       
    }
    
    public static function mostrar_categoria()
    {
        $con = conexion();
        $instruccion =("SELECT * FROM categorias ");
        $consulta = mysqli_query($con,$instruccion)
        or die ("Fallo en la consulta mostrar categorias");
        $nfilas = $consulta ;
        return $nfilas;
    }

    public static function mostrar_categoria_por_id($id)
    {
        $con = conexion();
        $instruccion =("SELECT * FROM categorias where id_categoria = $id");
        $consulta = mysqli_query($con,$instruccion)
        or die ("Fallo en la consulta mostrar categorias por id");
        $nfilas = $consulta ;
        return $nfilas;
    }

    public static function mostrar_cursos($id_user)
    {
        $con = conexion();
        $instruccion =("SELECT * FROM cursos where id_user = $id_user");
        $consulta = mysqli_query($con,$instruccion)
        or die ("Fallo en la consulta mostrar cursos");
        $nfilas = $consulta;
        return $nfilas;
    }

    public static function cantidad_cursos($id_user)
    {
        $con = conexion();
        $instruccion =("SELECT count(*)from cursos where(id_user = $id_user) and id_estado = 1");
        $consulta = mysqli_query($con,$instruccion)
        or die ("Fallo en la consulta solicitudes");

        $resultado = $consulta->fetch_all(); 
        return $resultado;  
    }

    public static function contenido_por_id_cursos($id_curso)
    {
        $con = conexion();
        $instruccion =("SELECT * FROM publicaciones WHERE id_cursos = $id_curso");
        $consulta = mysqli_query($con,$instruccion)
        or die ("Fallo en la consulta mostrar categorias");
        $nfilas = $consulta ;
        return $nfilas;
    }

    public static function cursos_por_id($id_curso)
    {
        $con = conexion();
        $instruccion =("SELECT * FROM cursos WHERE id_cursos = $id_curso");
        $consulta = mysqli_query($con,$instruccion)
        or die ("Fallo en la consulta mostrar categorias");
        $nfilas = $consulta ;
        return $nfilas;
    }

    public static function mostrarTodo($cursos)
    {
        $con = conexion();
        $instruccion =("SELECT U.id_user, U.nombre, U.foto_perfil, P.id_publicaciones, P.contenido, P.img
          from usuarios U inner join publicaciones P on U.id_user = P.id_user where P.id_cursos in('$cursos')" 
                                );
        $consulta = mysqli_query($con,$instruccion)
        or die ("Fallo en la consulta post mostrar todo");                        
        $resultado =$consulta;
        return $resultado;  
    }

    public static function contenido_por_id_cursos1($id_curso)
    {
        $con = conexion();
        $instruccion =("SELECT MIN(id_publicaciones) FROM publicaciones WHERE id_cursos =  $id_curso");
        $consulta = mysqli_query($con,$instruccion)
        or die ("Fallo en la consulta contenido curso1");
        $nfilas = $consulta ;
        return $nfilas;
    }


   
}

class usuarios{

    public static function Registrar($datos)
    {
        // extraer los datos de un arreglo a las variables 
        $con = conexion();
        $nombre = $datos[0];
        $usuario = $datos[1];
        $clave= $datos[2];
        $ciudad = $datos[3];
        $profesion = $datos[4];
        $edad = $datos[5];
        $correo =$datos[6];
        // datos por defecto 
        $foto_perfil = "img/img_sin_foto_perfil.jpg";
        $rol = 2;
        $estado = 1; 

        
        $instruccion ="INSERT INTO usuarios(id_user,foto_perfil,nombre,usuario,clave,ciudad,profesion,edad,rol,id_estado,correo) 
                       VALUES (null,'$foto_perfil','$nombre','$usuario','$clave', '$ciudad', '$profesion','$edad','$rol','$estado','$correo')";
        $consulta = mysqli_query($con,$instruccion)
        or die ("Fallo registrar un usuario ");
        
    }

    public static function eliminarUsuario($id)
    {
        $con= conexion();
        $instruccion="DELETE FROM usuarios WHERE id_user='$id'";    
        $consulta=mysqli_query($con,$instruccion);

        if($consulta){
            header("Location: administrador.php");


        }

    }


    public static function verificar($usuario)
    {
        $con = conexion();
        $instruccion =("SELECT * FROM usuarios WHERE usuario = '$usuario'");
        $consulta = mysqli_query($con,$instruccion)
        or die ("Fallo en la consulta verificar");
        $nfilas =mysqli_fetch_array($consulta);
        return $nfilas;
    } 

    public static function verificarCorreo($correo)
    {
        //verificar que el correo que se va a ingresar no exista en la base de datos
        $con = conexion();
        $instruccion =("SELECT * FROM usuarios WHERE correo = '$correo'");
        $consulta = mysqli_query($con,$instruccion)
        or die ("Fallo en la consulta verificar");
        $nfilas =mysqli_fetch_array($consulta);
        return $nfilas;
    } 
    public static function validarEdad($valor, $opciones=null)
    {   
            if(filter_var($valor, FILTER_VALIDATE_INT, $opciones) === FALSE){
               return false;
            }else{
               return true;
            }
       
    }

    public static function editar($id_user,$datos)
    {
        $con = conexion();
       
        $nombre = $datos[0];
        $correo =$datos[1];
        $profesion=$datos[2];
        $ciudad=$datos[3];
        $foto_perfil=$datos[4];
      
        
        $instruccion =("UPDATE usuarios set foto_perfil = '$foto_perfil', nombre = '$nombre', correo ='$correo',
                     profesion = '$profesion', ciudad= '$ciudad' where id_user = '$id_user'");

        $consulta = mysqli_query($con,$instruccion)
        or die ("Fallo en la consulta verificar");             


    }
    
    public static function usuario_por_codigo($id_user)
    {
        $con = conexion();
        $instruccion=("SELECT * from usuarios where id_user = $id_user");
        $consulta = mysqli_query($con,$instruccion)
        or die ("Fallo en la consulta usuario_por_codigo 56");                        
        $resultado = $consulta;
        return $resultado;  
    }
}

class post{

    public static function agregar($id_user, $contenido, $img, $id_curso)
    {
        $con = conexion();
        $instruccion =("INSERT into publicaciones(id_publicaciones,contenido,img,id_user,id_estado,id_cursos)
                        values(null,'$contenido','$img','$id_user',1,'$id_curso')");
        $consulta = mysqli_query($con,$instruccion)
        or die ("Fallo en la consulta post agregar");                            
        
    }

    public static function mostrarTodo_por_id_post($amigos)
    {
        $con = conexion();
        $instruccion =("SELECT U.id_user, U.nombre, U.foto_perfil, P.id_publicaciones, P.contenido, P.img, P.id_cursos
                        from usuarios U inner join publicaciones P on U.id_user = P.id_user where P.id_publicaciones in('$amigos')
                        ORDER BY P.id_publicaciones DESC" 
                                );
        $consulta = mysqli_query($con,$instruccion)
        or die ("Fallo en la consulta post mostrar todo");                        
        $resultado =$consulta;
        return $resultado;  
    }

    public static function post_por_usuario($id_user)
    {
        $con = conexion();
        $instruccion =("SELECT  U.id_user, U.nombre, U.foto_perfil, P.id_publicaciones, P.contenido, P.img
                                    from usuarios U inner join publicaciones P on U.id_user = P.id_user where P.id_user =$id_user
                                    ORDER BY P.id_publicaciones DESC" 
                                );
        $consulta = mysqli_query($con,$instruccion)
        or die ("Fallo en la consulta post_por_usuario");                        
        $resultado =$consulta;
        return $resultado;
    }
    public static function mostrarTodo($amigos)
    {
        $con = conexion();
        $instruccion =("SELECT U.id_user, U.nombre, U.foto_perfil, P.id_publicaciones, P.contenido, P.img, P.id_cursos
                        from usuarios U inner join publicaciones P on U.id_user = P.id_user where P.id_user in('$amigos')
                        ORDER BY P.id_publicaciones DESC" 
                                );
        $consulta = mysqli_query($con,$instruccion)
        or die ("Fallo en la consulta post mostrar todo");                        
        $resultado =$consulta;
        return $resultado;  
    }

    public static function mostrar_por_codigo_post($id_publicasiones)
    {
        $con = conexion();
        $instruccion =("SELECT U.id_user, U.nombre, U.foto_perfil, P.id_publicaciones, P.contenido, P.img
                                    from usuarios U inner join publicaciones P on U.id_user= P.id_user where P.id_publicaciones =$id_publicasiones
                                    ORDER BY P.id_publicaciones DESC" 
                                );
        $consulta = mysqli_query($con,$instruccion)
        or die ("Fallo en la consulta post mostrar todo");                        
        $resultado =$consulta;
        return $resultado; 
    }

}

class comentarios{

    public static function agregar($comentario, $id_user, $id_publicaciones)
    {
        echo( $id_publicaciones);
        $con = conexion();
        $instruccion =("INSERT into comentarios(id_comentarios,comentario,id_user,id_publicacion) 
                        values( null ,'$comentario','$id_user','$id_publicaciones')");                    
        $consulta = mysqli_query($con,$instruccion)
        or die ("Fallo en la consulta post agregar comentario");    
    }

    public static function mostrar($id_publicaciones)
    {
        $con = conexion();
        $instruccion=("SELECT U.nombre , C.comentario from usuarios U inner join  
            comentarios C on U.id_user = C.id_user where C.id_publicacion = $id_publicaciones ");
        $consulta = mysqli_query($con,$instruccion)
        or die ("Fallo en la consulta post mostrar comentario 132");                        
        $resultado =$consulta->fetch_all();
        return $resultado; 
    }
}

class mg
{
    public static function agregarlike($id_publicaciones, $id_user)
    {
      $con = conexion();
      $instruccion =("INSERT into mg(id_like, id_publicacion ,id_user, tipo) values(null, $id_publicaciones, $id_user,1)");
      $consulta = mysqli_query($con,$instruccion)
      or die ("Fallo en la consulta agregar me gusta "); 
     
    }

    public static function agregarDislike($id_publicaciones, $id_user)
    {
      $con = conexion ();
      $instruccion =("INSERT into mg(id_like, id_publicacion ,id_user, tipo) values(null, $id_publicaciones, $id_user,0)");
      $consulta = mysqli_query($con,$instruccion)
      or die ("Fallo en la consulta agregar me gusta "); 
     
    }

    public static function mostrarlikes($id_publicasiones)
    {
      $con = conexion ();
      $instruccion = ("SELECT count(*) from mg where id_publicacion = '$id_publicasiones' and tipo = 1");
      
      $consulta = mysqli_query($con,$instruccion)
      or die ("Fallo en la consulta post mostrar");                        
      $resultado =$consulta->fetch_all();
      return $resultado; 
    }

    public static function mostrarDislikes($id_publicasiones)
    {
      $con = conexion ();
      $instruccion = ("SELECT count(*) from mg where id_publicacion = '$id_publicasiones' and tipo = 0");
      
      $consulta = mysqli_query($con,$instruccion)
      or die ("Fallo en la consulta post mostrar");                        
      $resultado =$consulta->fetch_all();
      return $resultado; 
    }

    public static function verificar_mg($id_publicaciones, $id_user)
    {
      $con = conexion ();
      $instruccion =("SELECT id_like from mg where id_publicacion = $id_publicaciones and id_user = $id_user");
      $consulta = mysqli_query($con,$instruccion)
      or die ("Fallo en la consulta verificar me gusta ");                        
      $resultado =$consulta->fetch_all();
      return $resultado; 
    }

}

class notificaciones
{
    public static function agregar($accion, $id_publicasiones,$id_user)
    {
        $con = conexion ();
        $instruccion = ("INSERT into notificaciones(id_not, accion, visto, id_publicacion, id_user) 
                        values(null,'$accion',0,'$id_publicasiones','$id_user')");

        $consulta = mysqli_query($con,$instruccion)
        or die ("Fallo en la consulta notificaciones 185 ");

    }

    public static function mostrar($id_user)
    {
        $con = conexion();
        $instruccion =("SELECT U.id_user, U.nombre, N.id_not , N.accion, N.id_publicacion
                                   from notificaciones N inner join usuarios U on U.id_user = N.id_user 
                                   where N.id_publicacion in(select id_publicaciones from publicaciones
                                   where id_user = $id_user) and N.visto = 0 and N.id_user != $id_user");
        $consulta = mysqli_query($con,$instruccion)
        or die ("Fallo en la consulta mostrar");
        $resultado =$consulta->fetch_all();
        return $resultado;

    }

    public static function vistas($id_publicaciones){
        $con = conexion();
        $instruccion =("UPDATE notificaciones set visto = 1  where id_not = $id_publicaciones");
        $consulta = mysqli_query($con,$instruccion)
        or die ("Fallo en la consulta mostrar vistas");
        
    }
}

class amigos
{
    public static function agregar($user_enviador,$user_receptor)
    {
        $con = conexion();
        $instruccion =("INSERT into amigos(id_amigo, user_enviador, user_receptor,status,solicitud) 
                           values(null,$user_enviador, $user_receptor,'', 1)");
       $consulta = mysqli_query($con,$instruccion)
       or die ("Fallo en la consulta ");

                   
    }

    public static function verificar($user_enviador,$user_receptor)
    {
        $con = conexion();
        $instruccion = ("SELECT * from amigos where (user_enviador = $user_enviador and user_receptor =
                                 $user_receptor)or(user_enviador = $user_receptor and user_receptor = $user_enviador)");
        $consulta = mysqli_query($con,$instruccion)
        or die ("Fallo en la consulta VERIFICAR AMIGO ");
        $resultado =$consulta->fetch_all();
        return $resultado;     
    }
    public static function codigos_amigos($id_user)
    {
        $con = conexion();
        $instruccion =("SELECT GROUP_CONCAT(user_enviador,',',user_receptor) as amigos from amigos
                        where(user_enviador = $id_user or user_receptor = $id_user) and status = 1");
        $consulta = mysqli_query($con,$instruccion)
        or die ("Fallo en la consulta amigos codigo");  
        $resultado = $consulta -> fetch_all(); 
        return $resultado;  
    }

    public static function solicitudes($id_user)
    {
        $con = conexion();
        $instruccion = ("SELECT U.id_user, U.nombre, A.id_amigo FROM usuarios U inner join amigos A on 
                        U.id_user = A.user_enviador where A.user_receptor = $id_user and A.status != 1");
        $consulta = mysqli_query($con,$instruccion)
        or die ("Fallo en la consulta solicitudes");

        $resultado = $consulta->fetch_all(); 
        return $resultado;  
    }

    public static function aceptar($id_amigo)
    {
        $con = conexion();
        $instruccion = ("UPDATE amigos set status = 1 where id_amigo = $id_amigo");
        $consulta = mysqli_query($con,$instruccion)
        or die ("Fallo en la Aceptar solicitudes");
    }

    public static function eliminar_solicitud($id_amigo)
    {
        $con = conexion();
        $instruccion =("DELETE FROM amigos where id_amigo = $id_amigo");
        $consulta = mysqli_query($con,$instruccion)
        or die ("Fallo en la consulta solicitudes");  
    }

    public static function cantidad_amigos($id_user)
    {
        $con = conexion();
        $instruccion =("SELECT count(*)from amigos where(user_enviador =$id_user or user_receptor =$id_user) and status = 1");
        $consulta = mysqli_query($con,$instruccion)
        or die ("Fallo en la consulta solicitudes");

        $resultado = $consulta->fetch_all(); 
        return $resultado;  
    } 
    
    public static function amigos_por_id($id_user)
    {
        $con = conexion();
        $instruccion =("SELECT * from amigos where(user_enviador =$id_user or user_receptor =$id_user) and status = 1");
        $consulta = mysqli_query($con,$instruccion)
        or die ("Fallo en la consulta solicitudes");
        $resultado = $consulta->fetch_all(); 
        return $resultado;  
    }
    

}

?>