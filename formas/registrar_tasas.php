<?php
   include("conexion.php");
   $link=Conectarse();
  
   $fecha=$_POST['\fechatasa'];
   $gaceta=$_POST['resolucion'];   
   $activa=$_POST['activa'];
   $pasiva=$_POST['pasiva'];   
   $promedio=$_POST['promedio'];   
   $fechareg= date("Y-m-d, H:i:s"); 
   
   $clave=$_GET['id'];       
   $fecha_formato= date("Y-m-d", ($fecha)); 
    if (($clave) == '' )
    {
       mysql_query("insert into tasas (fecha_tasa,resolucion, activa, pasiva, promedio, fecha_registro) values ('$fecha_formato','$gaceta','$activa','$pasiva','$promedio','$fechareg')",$link);
       #comprobamos el resultado de la insercion
       # el error CERO significa NO ERROR
       # el error 1062 significa Clave duplicada
       # en otros errores forzamos a que nos ponga el número de error
       # y el significado de ese error (aunque sea en ingles)....
  
       if (mysql_errno($link)==0)
         {
    	    echo "<h2>Registro AÑADIDO</b></H2>";
         }
       else
         {
           if (mysql_errno($link)==1062)
            {
              echo "<h2>No ha podido añadirse el registro<br>Ya existe un campo con este DNI</h2>";
            }
           else
            { 
              $numerror=mysql_errno($link);
              $descrerror=mysql_error($link);
              echo "Se ha producido un error nº $numerror que corresponde a: $descrerror  <br>";
            }
         } 
       
    }	   
   else 
    {
   	  mysql_query("delete from tasas where id_tasa = $clave",$link); 
      // colocar la integridad 	   
    }
  header("Location: insertar_tasas.php");
 
?>