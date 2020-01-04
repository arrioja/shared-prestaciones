<html>
   <head>
        <title>Formulario Criterio de Vacaciones</title>
    </head>
    <body>
   <table Border=1 Width=100% > 
 <tr>
  <th align="right"></th>
 <td bgcolor="" align="center" background="white" width="100%"> Módulo Egreso del Personal</td>
 </tr>
     <?php
        // create a custom function that compares a control's
        // submitted value with another value
        function valueCompare($controlValue, $valueToCompareTo)
        {
            // if values are not the same
            if ($controlValue != $valueToCompareTo) {

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

        $form->add("label", "label_descripcion", "descripcion", "Descripción");
        
        $obj = & $form->add("select", "descripcion");
        $obj->addOptions(array("- Selecione -",  "Despido Injustificado"=>"Despido Injustificado", "Despido Justificado"=>"Despido Justificado",
        "Jubilación" => "Jubilación","Muerte" => "Muerte", "Pensión" => "Pensión", "Renuncia" => "Renuncia"));
        $obj->setRule(array("mandatory"=>array("e1", "Por favor! Seleccione la Descripción del Egreso")));
           
        $form->add("label", "label_tipo", "tipo", "Tipo");
        $obj = & $form->add("select", "tipo");
        $obj->addOptions(array("- Selecione -",  "1"=>"Por el Trabajador", "0"=>"Por la Empresa"));
        $obj->setRule(array("mandatory"=>array("e2", "Por favor! Seleccione el Tipo de Egreso ")));
        
        $form->add("submit", "submit_aceptar", "Aceptar");
                 
        $form->add("reset", "reset_cancelar", "Cancelar");
        // place a submit button   
    
        // validate the form
        if ($form->validate()) {     
            // code if form is valid
            print_r("Form is valid. Redirect or whatever...");
        }
      
        // display the form with the specified template
        $form->render("tipoegreso.xtpl");
        $form->render("registrar_tipoegreso.");
    ?>

    </table>
<hr align="center" size="2" width="100%"></hr>    
<?php
  #include('conexion.php');
//Creamos las variables básicas del paginador
 $maximo_resultados = 3;
 $numero_pagina = 0;
 //si existe un valor en el url lo guardamos en la variable $numero_pagina
 if (isset($_GET['numero_pagina'])) 
  {
    $numero_pagina = $_GET['numero_pagina'];
  }
//guardamos los valores de las variables en una sola
 $mostrar_resultados = $numero_pagina * $maximo_resultados;
// conectamos a la BD
 $hostname_connBD = "192.168.50.14";
 $database_connBD = "prestaciones";
 $username_connBD = "orlenis";
 $password_connBD = "123456";
 $connBD = mysql_pconnect($hostname_connBD, $username_connBD, $password_connBD) or trigger_error(mysql_error(),E_USER_ERROR);
//Selecionamos la tabla y realizamos la consulta
 mysql_select_db($database_connBD, $connBD);
 $query_rsTablaPersonalizada = "SELECT * FROM tasas ORDER BY fecha_tasa ASC";
  
//añadimos las variables de URL necesarias
  $query_limit_resultados = sprintf("%s LIMIT %d, %d", $query_rsTablaPersonalizada, $mostrar_resultados, $maximo_resultados);
  $rsTablaPersonalizada = mysql_query($query_limit_resultados, $connBD) or die(mysql_error());
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
 echo "<tr style =bgcolor='$color0'>Datos Registrados</tr>";
 echo "<tr bgcolor='$color0'><th>Fecha</th><th>Nro. Resolusión</th><th>Valor Activa</th><th>Valor Pasiva</th><th>Valor Promedo</th><th>Modificar</th><th>Eliminar</th></tr>";
 do 
  {
  //Creamos el java
   echo " <tr align=\"center\" style=\"background-color:$color\" onMouseOver=\"this.style.backgroundColor='$color3'\" onMouseOut=\"this.style.backgroundColor='$color'\" >";
   echo "<td>".$row_rsTablaPersonalizada['fecha_tasa'] . "</td>";
   echo "<td>".$row_rsTablaPersonalizada['resolucion'] . "</td>";
   echo "<td>".$row_rsTablaPersonalizada['activa'] . "</td>";
   echo "<td>".$row_rsTablaPersonalizada['pasiva'] . "</td>";
   echo "<td>".$row_rsTablaPersonalizada['promedio'] . "</td>";
   echo "<td>".$row_rsTablaPersonalizada['promedio'] . "</td>";  
   echo "<td>".$row_rsTablaPersonalizada['promedio'] . "</td>";
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
    
    </body>
</html>
