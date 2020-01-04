<html>
<head>
<title>Sub Menú </title>
<style type="text/css">
<!--
body {text-align:center;}
td.row1 { background-color: #D5E7FB; }
td.row2 { background-color: #A4B4C1;}
th.row1 { background-color: #A4B4C1; }
#menu {margin:auto;text-align:center;width:100%;font-family: Verdana, Arial, Helvetica,
sans-serif; font-size: 7.5pt; border: 2px dashed Black; padding: 1px; background=#FAFAFF;}
#menu a {display:block;width:100%; text-decoration:none;color:#000000}
#menu a:active,#menu a:link,#menu a:visited{background-color: #D5E7FB;}
#menu a:hover{background-color: #FAFAFF;}
-->
</style>
</head>
<body>
<table id="menu" cellpadding='0' cellspacing='0'>
<tr>
<th class="row1" colspan=3>SubMenú de Opciones</th></tr>
<?
$codigo = $_GET['cod'];
$nombre=$_GET['nom'];
 switch ($codigo) 
 {
     case 0:
      $opcion= array("direccion1&nombre1","direccion2&nombre2",
              "direccion3&nombre3","direccion4&nombre4",
              "direccion&nombre", "");
       break;
     case 1:
      $opcion= array("direccion1&Parametros Del Sistema","insertar_mes.php&Meses Activos",
              "insertar_tasas.php&Tasas de Intereses","insertar_tipoegreso.php&Egresos",
              "insertar_criteriovac.php&Criterio de Vacaciones", "");
       break;
     case 2:
      $opcion= array("direccion1&Actualizar Sueldo Integral del Mes(Masivo)","calculo_mesindividual.php&Cálculo del Mes Individual",
              "proceso_mes.php&Cerrar Mes","insertar_salarioprestaciones.php&Desglose de Salario de Prestación",
               "insertar_liquidacion.php&Liquidación del Personal", "");
       break;
     case 3:
      $opcion= array("consultar_pasivolaboral.php&Consultar Pasivo Laboral del Personal","consultar_transacciones.php&Consultar Transacciones del Personal");
      break;     
     case 4:
      $opcion= array("nombre.php&Actualizar Sueldo Integral del Mes","gestion_personal.php&Gestión de Personal",
                     "nombre.php&Gestión de Personas","nombre.php&Pago de Disposiciones Transitorias",
                     "nombre.php&Pago Liquidación", "nombre.php&Retiro de Interes de Disposiciones Transitorias",
                     "nombre.php&Retiro de Interes de Prestaciones Sociales");
 
 }

?>
<?  
  $cambio=0;
  for ($i=0;$i<count($opcion);$i++)
 {
   $datos=explode("&",$opcion[$i]);
   if ($cambio==0) 
   { 
   	echo "<tr>"; 
   }
?> 
<td class="row1"><a href="<?=$datos[0]?>"><?=$datos[1]?></a></td> 
<?
   $cambio++;
   if ($cambio==3) 
   {
   	echo "</tr>"; 
   	$cambio=0;
   }
}
?> 
<tr><td class="row2" colspan=3><marquee>Escoja una Opción del Sub-Menú <?$nombre?> </marquee></td></tr>
</table>
</body>
</html>