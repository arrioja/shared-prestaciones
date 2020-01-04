<html>
<head>
<title>Módulo Registrar Adelantos de Prestaciones</title>
</head>
<body>
<?
    // Pinto la tabla del titulo
    echo "<table align=center border=2 bgcolor='#D5E7FB' width=100%>";
    echo "<tr bgcolor='#A4B4C1'><td colspan=5 align=center><strong><font size=5>Módulo: Insertar Salario de Prestaciones</font></strong></td><tr bgcolor='#D5E7FB'>";
    echo "<tr bgcolor='#A4B4C1'><td colspan=5 align=left><strong><font size=3>Datos Personales</font></strong></td><tr bgcolor='#E8F2FC'>";
?>
   <table align="center" border="0" bgcolor='#E8F2FC' width="100%">
   <tr><td colspan="5" align="left">Nro. Cédula:</td>
   <td align="left" width="80%" ><input type="text" name="cedula" value="" size=10><input type=submit value="Aceptar"></td></tr>
   <tr><td colspan="5" align="left">Nombre y Apellido: </td>
   <td align="left" width="80%"> <input type="text" name="nombre" value="" size=45></td></tr>
   </table>
 <?
   echo "<table align=center border=0 bgcolor='#E8F2FC' width=100%>";  
   echo "<tr bgcolor='#A4B4C1'><td colspan=5 align=left><strong><font size=3>Datos Laborales</font></strong></td><tr bgcolor='#E8F2FC'>";
?>    
   <table align="center" border="0" bgcolor='#E8F2FC' width="100%">
   <td colspan="5" align="left">Fecha Ingreso: </td>
   <td align="left" width="10%"> <input type="text" name="fecha_ingreso" value="" size=10></td>
   <td colspan="5" align="left">Fecha Ingreso Contraloria: </td>
   <td align="left" width="10%"> <input type="text" name="fecha_ingcene" value="" size=10></td>
   <td colspan="5" align="left">Fecha Administración Pública: </td>
   <td align="left" width="10%"> <input type="text" name="fecha_admpublica" value="" size=10></td>
   
<?php   
  // create a custom function that compares a control's
  // submitted value with another value
   function valueCompare($controlValue, $valueToCompareTo)
    {
     // if values are not the same
     if ($controlValue != $valueToCompareTo) 
     {
        // return false
       return false;
     }
       // return true if everything is ok
       return true;
    }
        // require the htmlform class
    require "../class.htmlform.php";
        // instantiate the class
    $form = new HTMLForm("form", "post");
    
    // specify the date to the datepicker class (a member of the Zebra PHP Framework)
    // if class is not found the execution will break when you try to instantiate a date control
    $form->datePickerPath = "../../datepicker/class.datepicker.php";       
        // cambie 
      
        
        $form->add("label", "label_fechadesde", "fechadesde", "Desde:");
        $obj = & $form->add("date", "fechadesde");
        // set some properties of the date picker
        $obj->datePicker->preselectedDate = mktime(0, 0, 0, date("d"), date("m"), date("Y"));
        $obj->datePicker->dateFormat = "d/m/Y";
        $obj->setRule(array("mandatory"=>array("e1", "Por favor! seleccione la fecha de inicio del proceso")));
        $obj->setAttributes(array("size" =>10));  
        
        $form->add("label", "label_fechahasta", "fechahasta", "Hasta:");
        $obj = & $form->add("date", "fechahasta");
        // set some properties of the date picker
        $obj->datePicker->preselectedDate = mktime(0, 0, 0, date("d"), date("m"), date("Y"));
        $obj->datePicker->dateFormat = "d/m/Y";
        $obj->setRule(array("mandatory"=>array("e2", "Por favor! seleccione la fecha de final para proceso")));
        $obj->setAttributes(array("size" =>10));  
        
        $form->add("label", "label_monto", "monto", "Monto Salario");
        $obj = & $form->add("text","monto");
        $obj->setAttributes(array("size" =>15));            
        $obj->setRule(array("mandatory"=>array("e3", "Por favor! Introduzca Cifras Válidas")));
       
        
        $form->add("submit", "submit_buscar", "Buscar");
        $form->add("submit", "submit_procesar", "Procesar");
        $form->add("submit", "submit_generar", "Generar");
        
        // validate the form
        if ($form->validate()) 
        {
        
            // code if form is valid
           
        }
      
        // display the form with the specified template
        $form->render("salarioprestaciones.xtpl");
    ?>
    
<hr align="center" size="2" width="100%"></hr>    

<?php
   include('conexion.php');
  //Creamos las variables básicas del paginador
 $maximo_resultados = 10;
 $numero_pagina = 0;
 //si existe un valor en el url lo guardamos en la variable $numero_pagina
 if (isset($_GET['numero_pagina'])) 
  {
    $numero_pagina = $_GET['numero_pagina'];
  }
//guardamos los valores de las variables en una sola
 $mostrar_resultados = $numero_pagina * $maximo_resultados;

 // conectamos a la BD
  $link=Conectarse();
 
  //Selecionamos la tabla y realizamos la consulta
 $query_rsTablaPersonalizada = "SELECT * FROM salario ORDER BY ano_proceso, mes_proceso ASC";
  
//añadimos las variables de URL necesarias
  $query_limit_resultados = sprintf("%s LIMIT %d, %d", $query_rsTablaPersonalizada, $mostrar_resultados, $maximo_resultados);
  $rsTablaPersonalizada = mysql_query($query_limit_resultados, $link) or die(mysql_error());
  $row_rsTablaPersonalizada = mysql_fetch_assoc($rsTablaPersonalizada);

//Si la consulta trae resultados lo almacenamos en la variable $total_resultados
 if (isset($_GET['total_resultados'])) 
  {
   $total_resultados = $_GET['total_resultados'];
  } 
 else  
  {
   $all_resultados = mysql_query($query_rsTablaPersonalizada);
   $total_resultados = mysql_num_rows($all_resultados);
  }
  
//si algún valor esta en fracción lo redondeamos al número mayor y restamos 1 para la pag. de inicio
  $totalPaginas_resultados = ceil($total_resultados/$maximo_resultados)-1;
// almacenamos los resultados como strings
 $string_resultados = "";
// creamos los parámetros de la URL: numero_pagina y total_resultados
 if (!empty($_SERVER['QUERY_STRING'])) 
  {
    $parametros = explode("&", $_SERVER['QUERY_STRING']);
    $newparametros = array();
    foreach ($parametros as $param) 
    {
     if (stristr($param, "numero_pagina") == false &&
        stristr($param, "total_resultados") == false) 
       {
        array_push($newparametros, $param);
       }
    }
   if (count($newparametros) != 0) 
    {
      $string_resultados = "&" . htmlentities(implode("&", $newparametros));
    }
  }
 $string_resultados = sprintf("&total_resultados=%d%s", $total_resultados, $string_resultados);
 
 //Definimos los colores a usar
  $color0 = "#A4B4C1";
  $color1 = "#D5E7FB";
  $color2 = "#E8F2FC";
  $color3 = "#E0FAC5";
  $color = $color1;

  //Creamos la tabla mostrar
 echo "<table border=\"0\" align=\"center\" cellspacing=\"2\" width =\"100%\">";
 echo "<tr style =bgcolor='$color0'>Desglose de Salario de Prestación</tr>";
 echo "<tr bgcolor='$color0'><th>Año</th><th>Mes</th><th>Salario Integral</th><th>Salario Diario</th><th>Alicuota de Vacación</th><th>Alicuota de B.Aguinaldo</th><th>Salario de Prestación</th><th>Modificar</th><th>Eliminar</th></tr>";
 do 
  {
  //Creamos el java
   echo " <tr align=\"center\" style=\"background-color:$color\" onMouseOver=\"this.style.backgroundColor='$color3'\" onMouseOut=\"this.style.backgroundColor='$color'\" >";
   echo "<td>".$row_rsTablaPersonalizada['ano_proceso'] . "</td>";
   echo "<td>".$row_rsTablaPersonalizada['mes_proceso'] . "</td>";
   echo "<td>".$row_rsTablaPersonalizada['salario_integral'] . "</td>";
   echo "<td>".$row_rsTablaPersonalizada['salario_diario'] . "</td>";
   echo "<td>".$row_rsTablaPersonalizada['alicuota_vacacion'] . "</td>";
   echo "<td>".$row_rsTablaPersonalizada['alicuota_aguinaldo'] . "</td>";
   echo "<td>".$row_rsTablaPersonalizada['salario_prestacion'] . "</td>";
   echo "<td>"."<a href=\"modificar_tipoegreso.php?id=".$row_rsTablaPersonalizada['id_critvaca']."\">Modificar</a>". "</td>";
   echo "<td>"."<a href=\"registrar_criterio.php?id=".$row_rsTablaPersonalizada['id_critvaca']."\">Eliminar</a>". "</td>";
   echo "</tr>";
 //diferenciamos los colores de las filas
  if ($color == $color1) 
   {
	$color = $color2;
   } 
  else
   {
	$color = $color1;
   }
  }
 while ($row_rsTablaPersonalizada = mysql_fetch_assoc($rsTablaPersonalizada));
 echo "</table>" ;
?>

<table width="50%"%"%" border="0" align="center" width="100%">
  <tr>
    <td width="50%" align="right" width="100%">
<?php
 //Creamos la Barra de Navegación
 //utilizamos la función max para motrar los 50 valores anteriores al valor máximo
 $pagNum_tmp = max(0, $numero_pagina-50);
  for ($pagNum_i=$pagNum_tmp+1;$pagNum_i<=$numero_pagina;$pagNum_i++) 
  {
    //páginas previas
?>
 <a href="<?php printf ("%s?numero_pagina=%d%s", $HTTP_SERVER_VARS["PHP_SELF"], $pagNum_i-1, $string_resultados); ?>"><?php echo $pagNum_i; ?></a>
<?php
  }
?>
 </td>
 <td><strong><?php
  //página actual 
  echo $numero_pagina+1; ?></strong></td>
 <td width="50%"><?php
  $pagNum_tmp = min($numero_pagina+1+50, $totalPaginas_resultados+1);
  for ($pagNum_i=$numero_pagina+2;$pagNum_i<=$pagNum_tmp;$pagNum_i++) 
  {
  // páginas siguientes
?>
  <a href="<?php printf ("%s?numero_pagina=%d%s", $HTTP_SERVER_VARS["PHP_SELF"], $pagNum_i-1, $string_resultados); ?>"><?php echo $pagNum_i; ?></a>
<?php
  }
?>
 </td>
 </tr>
 </table>
 <?php
 //liberamos memoria
   mysql_free_result($rsTablaPersonalizada);
 ?>        
    </table>    
    </body>
</html>
