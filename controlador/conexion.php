<?php
    
    try{
        $user="root";
        $pass="";
        $server="localhost";
        $db="red_social";

        $conexion = new mysqli($server,$user,$pass,$db);
        echo("conecto");
        

    }catch(PDOException $e){
      echo ("Error :". $e->getMessage());
      echo("no coencto");  
    }
    


/*
try {

  $usuario ="root";
  $contra ="";

  $con = new PDO('mysql :host=localhost;dbname=red_social',$usuario, $contra);
  return $con;
  echo("conecto esta mierda");
} catch (PDOException $e) {
  echo("fallo esta mierda");
  return $e->getMessage(); 
}
*/
?>
