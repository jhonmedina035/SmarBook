<?php 

    function conexion()
    {
        try{
            $user="root";
            $pass="";
            $server="localhost";
            $db="red_social";
    
            $conexion = new mysqli($server,$user,$pass,$db);
            return($conexion);
            echo("conecto");
            
    
        }catch(PDOException $e){
          echo ("Error :". $e->getMessage());
          echo("no coencto");  
        }

    }
    
    function datos_vacios($datos)
    {
        $vacio= false;
        $tan = count($datos);
        for($c = 0; $c < $tan; $c++)
        {
            if(empty($datos[$c]))
            {
                $vacio = true;
                break;
            }
        }
        return $vacio;
    }

    function limpiar($datos)
    {

        $tan = count($datos);
        for($c = 0 ; $c < $tan; $c++)
        {
           if($c != 2 )
           {
               $datos[$c]= htmlspecialchars($datos[$c]);
               $datos[$c] = trim($datos[$c]);
               $datos[$c] =stripcslashes($datos[$c]);
           } 
        }

        return $datos;

    }

    function verificar_session()
    {
       if(! isset($_SESSION['id_user']))
       {
           header('location: login.php');
       }
    }

?>