<?php
   include("conexion.php");
   $id=$_GET['id'];
   if (isset($id))
   { // process form
    $link=Conectarse();
    
# hacemos la llamada a MySQL mediante la funci�n mysql_query
# y le decimos que UPDATE (modifique) la tabla
# y que lo haga (SET) en el campo ID 
# poniendo el valor que corresponde
 
    mysql_query("UPDATE $tasas SET id_tasa=$id",$link);
   echo "<h2>Proceso de actualizaci�n terminado</h2>";
   }
   else
   {
    echo "Debe especificar un 'id'.\n";
   }
   
   
   //header("Location: procesar_tasas.php");
?>
<!--
###################################################################
#   AHORA YA ESTAMOS EN HTML (hemos cerrado el script PHP con ?>  #
###################################################################

      escribimos esta script de JAVASCRIPT 
     para que el navegador cargue en la ventana actual
     la p�gina que nos permite visualizar el contenido
     de las tablas y que es un ejemplo que hemos desarrollado
     en la p�gina anterior.
     Como observar�s esta llamada no la hacemos desde PHP
     sino desde JavaScript, la raz�n es simple:
     PHP se ejecuta en el servidor SIEMPRE
     JavaScript se ejecuta siempre el el cliente (navegador del usuario)
     y lo que pretendemos ahora es que el navegador del usuario
     cargue la p�gina indicada  -->

<script language="JavaScript">
window.self.location="ejemplo128.php";
</script>