<?php
   include("conexion.php");
   $link=Conectarse();

   // Realiza la Inclusion.		
   $fecha=$_POST['fecha_entrada'];
   $periodo=$_POST['periodo']; 
   $diasdisfrute=$_POST['diasdisfrute'];
   $diaspagados=$_POST['diaspagados']; 
   $estado=$_POST['estado'];
      
   $fechareg= date("YYYY-mm-dd, H:i:s"); 
   $clave=$_GET['id'];  

   if (($clave) == '' )
    {
       mysql_query("insert into criterio_vacaciones (fecha_escala, escala, cant_diasdisfrute, cant_diaspagados, activo) values ('$fecha','$periodo','$diasdisfrute','$diaspagados','$estado')",$link);
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
   	  mysql_query("delete from criterio_vacaciones where id_critvaca = $clave",$link); 
      // colocar la integridad 	   
    }
  header("Location: insertar_criteriovac.php");
 
?>