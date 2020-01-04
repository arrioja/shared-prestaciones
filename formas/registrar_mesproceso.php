<?php
   include("conexion.php");
   $link=Conectarse();

   // Realiza la Inclusion.		
   $ano_r=$_POST['ano'];
   $mes_r=$_POST['mes']; 
   $situacion_r=$_POST['situacion'];
   
   $fechareg= date("YYYY-mm-dd, H:i:s"); 
   $clave=$_GET['id'];  

   if (($clave) == '' )
    {
     $result= mysql_query("SELECT * FROM mes_proceso where ((ano='$ano_r') and (mes='$mes_r'))", $link);
     $cant=mysql_num_rows($result); 
     if ($cant == '')               
      {
        mysql_query("insert into mes_proceso(ano,mes,situacion,fecha_registro) values ('$ano_r','$mes_r','$situacion_r','$fechareg')",$link);
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
    		
    		
    	}

    }	   
   else 
    {
   	  mysql_query("delete from mes_proceso where id_mes = $clave",$link); 
      // colocar la integridad 	   
    }
  
   header("Location: insertar_mes.php");
 
?>