<html>
<head>
<title>M�dulo insertar Tipos de Egresos</title>
</head>
<body>
<?
    // Pinto la tabla del titulo
    echo "<table align=center border=2 bgcolor='#D5E7FB' width=100%>";
    echo "<tr bgcolor='#A4B4C1'><td colspan=5 align=center><strong><font size=5>M�dulo: Tipos de Egresos</font></strong></td><tr bgcolor='#D5E7FB'>";
      
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

    // cambie los text y select 

    $form->add("label", "label_descripcion", "descripcion", "Descripci�n");
        
    $obj = & $form->add("text", "descripcion");
    $obj->setRule(array("mandatory"=>array("e1", "Por favor! Introduzca la descripci�n correspondiente al egreso")));
    $obj->setAttributes(array("size" =>45));  
               
              
   $form->add("label", "label_tipo", "tipo", "Tipo");
        
   $obj = & $form->add("select", "tipo");
   $obj->addOptions(array("- Selecione -","Por el Trabajador" =>"Por el Trabajador", "Por la Empresa" =>"Por la Empresa"));
   $obj->setRule(array("mandatory"=>array("e2", "Por favor! Seleccione el Tipo de Egreso ")));
        
   $form->add("submit", "submit_aceptar", "Aceptar");
                 
   $form->add("reset", "reset_cancelar", "Cancelar");
    // place a submit button   
    // validate the form

    if ($form->validate()) 
      {     
        // code if form is valid
        include('registrar_tipoegreso.php');      
      }
    
       // display the form with the specified template
   $form->render("tipoegreso.xtpl");      
?>

<hr align="center" size="2" width="100%"></hr>    

<?php
   include('conexion.php');
  //Creamos las variables b�sicas del paginador
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
 #$hostname_connBD = "192.168.50.14";
 #$database_connBD = "prestaciones";
 #$username_connBD = "orlenis";
 #$password_connBD = "123456";
 #$connBD = mysql_pconnect($hostname_connBD, $username_connBD, $password_connBD) or trigger_error(mysql_error(),E_USER_ERROR);
  $link=Conectarse();
 
  //Selecionamos la tabla y realizamos la consulta
  #mysql_select_db($database_connBD, $connBD);
 $query_rsTablaPersonalizada = "SELECT * FROM tipo_egreso ORDER BY descripcion ASC";
  
//a�adimos las variables de URL necesarias
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
  
//si alg�n valor esta en fracci�n lo redondeamos al n�mero mayor y restamos 1 para la pag. de inicio
  $totalPaginas_resultados = ceil($total_resultados/$maximo_resultados)-1;
// almacenamos los resultados como strings
 $string_resultados = "";
// creamos los par�metros de la URL: numero_pagina y total_resultados
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
 echo "<tr style =bgcolor='$color0'>Datos Registrados</tr>";
 echo "<tr bgcolor='$color0'><th>Descripci�n del Egreso</th><th>Tipo del Egreso</th><th>Modificar</th><th>Eliminar</th></tr>";
 do 
  {
  //Creamos el java
   echo " <tr align=\"center\" style=\"background-color:$color\" onMouseOver=\"this.style.backgroundColor='$color3'\" onMouseOut=\"this.style.backgroundColor='$color'\" >";
   echo "<td>".$row_rsTablaPersonalizada['descripcion'] . "</td>";
   echo "<td>".$row_rsTablaPersonalizada['tipo'] . "</td>";
   echo "<td>"."<a href=\"modificar_tipoegreso.php?id=".$row_rsTablaPersonalizada['id_egreso']."\">Modificar</a>". "</td>";
   echo "<td>"."<a href=\"registrar_tipoegreso.php?id=".$row_rsTablaPersonalizada['id_egreso']."\">Eliminar</a>". "</td>";
   #echo "<td>"."<a href=\"registrar_tipoegreso.php?id=".$row_rsTablaPersonalizada['id_egreso'].">Eliminar</a>". "</td>";
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
 //Creamos la Barra de Navegaci�n
 //utilizamos la funci�n max para motrar los 50 valores anteriores al valor m�ximo
 $pagNum_tmp = max(0, $numero_pagina-50);
  for ($pagNum_i=$pagNum_tmp+1;$pagNum_i<=$numero_pagina;$pagNum_i++) 
  {
    //p�ginas previas
?>
 <a href="<?php printf ("%s?numero_pagina=%d%s", $HTTP_SERVER_VARS["PHP_SELF"], $pagNum_i-1, $string_resultados); ?>"><?php echo $pagNum_i; ?></a>
<?php
  }
?>
 </td>
 <td><strong><?php
  //p�gina actual 
  echo $numero_pagina+1; ?></strong></td>
 <td width="50%"><?php
  $pagNum_tmp = min($numero_pagina+1+50, $totalPaginas_resultados+1);
  for ($pagNum_i=$numero_pagina+2;$pagNum_i<=$pagNum_tmp;$pagNum_i++) 
  {
  // p�ginas siguientes
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
 
  </body>
</html>
