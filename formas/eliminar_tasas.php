<?php
   include("conexion.php");
   $id=$_GET['id'];
   if (isset($id))
   { // process form
    $link=Conectarse();
   	mysql_query("delete from tasas where id_tasa = $id",$link);
   }
   else
   {
    echo "Debe especificar un 'id'.\n";
   }
  header("Location: procesar_tasas.php");
?>
   
   