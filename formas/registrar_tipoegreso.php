<?php
   include("conexion.php");
   $link=Conectarse();

   // Realiza la Inclusion.		
   $nombre_r=$_POST['descripcion'];
   $tipo_r=$_POST['tipo']; 

   
   $fechareg= date("YYYY-mm-dd, H:i:s"); 
   $clave=$_GET['id'];  

   // convertir en mayuscula
   $nombreM= strtoupper($nombre_r);

   if (($clave) == '' )
    {
       mysql_query("insert into tipo_egreso (descripcion,tipo,fecha_registro) values ('$nombreM','$tipo_r','$fechareg')",$link);
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
   	  mysql_query("delete from tipo_egreso where id_egreso = $clave",$link); 
      // colocar la integridad 	   
    }
  header("Location: insertar_tipoegreso.php");
 
?>