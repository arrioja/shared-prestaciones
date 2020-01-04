


<?php
// suponemos que en "tabla", tenemos un campo llamado nombre, otro ID, y otro, contenido
$consulta = mysql_query("SELECT nombre,id FROM `tabla`") or die(mysql_error());
while ( $ob = mysql_fetch_object($consulta) )
  {
     echo ' <a href="otra_pagina.php?id='.$ob->id.'">'.$ob->nombre.'</a> <br /> ';
  }
?>
  ///

# evitamos un posible injection
if( isset($_GET["id"]) && is_numeric($_GET["id"]) )
  {
     $id = $_GET["id"];
     $consulta = mysql_query ("SELECT * FROM `tabla` WHERE `id` = '$id'") or die(mysql_error());
     $ob = mysql_fetch_object($consulta);
     $nu = mysql_num_rows($consulta);
         if ($nu == 1)
           {
                // se supone que la id es unica
               echo '<h1> '.$ob->nombre.' </h1>';
              echo $ob->contenido;
           } else {
              echo 'No hay ningun registro con ID: '. $id;
           }
  } else {
   echo '<a href="index.php">vuelva</a>';
  }
?>


function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":       $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";       break;    
    case "int":       $theValue = ($theValue != "") ? intval($theValue) : "NULL";       break;
    case "double":       $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";       break;
    case "date":       $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";       break;
    case "defined":       $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;       break;
  }
  return $theValue;
}
if (isset($_POST['boton'])) 
 {
  $err=0;    
  if  ($_POST['boton']=="Aceptar") 
  {
 	if ((trim($_POST['fecha_tasa'])!="")&&(trim($_POST['gaceta'])!="")&&(trim($_POST['activa'])!="")
	    &&(trim($_POST['pasivo'])!="")&&(trim($_POST['promedio'])!=""))
		{ 
		  $fechareg= date("YYYY-mm-dd, H:i:s"); 
          $var_usuario='';
		  $insertvend = sprintf("INSERT INTO tasas (fecha_tasa,resolucion,activa,pasiva,promedio,fecha_registro, usuario_registro)  values(
		                        %s,%s,%s, %s, %s, %s,%s)",
  
		  GetSQLValueString($_POST['fecha_tasa'], "date"),
                       GetSQLValueString($_POST['gaceta'], "text"),
					   GetSQLValueString($_POST['activa'], "double"),
					   GetSQLValueString($_POST['pasiva'], "double"),
					   GetSQLValueString($_POST['promedio'], "double"),
					   GetSQLValueString($fechareg, "date"),
					   GetSQLValueString($var_usuario, "text"));
        $Result2 = mysql_query($insertvend, $link) or die(mysql_error());	  
	}
	else 
	{
		$vacios=1;
	}
 
  }//del aceptar
  if ($vacios==0)
  {
  	header("Location: procesar_tasas.php?");
  }
  else
  {
  }
}//del if isset    
