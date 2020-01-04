<html>
<head>
<title>Páginación de resultados</title>
</head>
<body bgcolor=#FFFFFF>
<?php
// Datos de conexión a la base
  $base="prestaciones";
//$con=mysql_connect(servidor,usuario,password);
//mysql_select_db($base,$con);

   include("conexion.php");
   $link=Conectarse();

   if (!isset($pg))
   $pg = 0; // $pg es la pagina actual
   $cantidad=1; // cantidad de resultados por página
   $inicial = $pg * $cantidad;

   $pegar = "SELECT * FROM tasas ORDER BY resolucion LIMIT $inicial,$cantidad";
   $cad = mysql_db_query($base,$pegar) or die (mysql_error());

   $contar = "SELECT * FROM tabla ORDER BY titulo";
   $contarok= mysql_db_query($base,$contar);
   $total_records = mysql_num_rows($contarok);
   $pages = intval($total_records / $cantidad);

// Imprimiendo los resultados
    while($array = mysql_fetch_array($cad)) 
    {
      echo $array['titulo']."<br>";
    }

// Cerramos la conexión a la base
    $link=mysql_close($link);

// Creando los enlaces de paginación
    echo "<p class=fonty>";
    if ($pg != 0) 
    {
     $url = $pg - 1;
     echo "<a href='$PHP_SELF?pg=".$url."'>&laquo; Anterior</a>&nbsp;";  
    } 
    else 
    {
      echo " ";
    }
    for ($i = 0; $i <= $pages; $i++) 
     {
      if ($i == $pg) 
       {
         if ($i == "0") 
          {
            echo "<b> 1 </b>";
          }
         else
          {
            $i = $i+1;
            echo "<b> ".$i." </b>";
          }        
       } 
       else
      {
       if ($i == "0") 
       {
         echo "<a href=$PHP_SELF?pg=".$i.">1</a> ";
       }
       else 
       {
        echo "<a href='$PHP_SELF?pg=".$i."'>";
        $i = $i+1;
        echo $i."</a>&nbsp;";
       }
      }
     }
    if ($pg < $pages) 
    {
     $url = $pg + 1;
     echo "<a href='$PHP_SELF?pg=".$url."'>Siguiente &raquo;</a>";
    }
    else
   {
    echo " ";
   }
    echo "</p>";
?>
</body>
</html>