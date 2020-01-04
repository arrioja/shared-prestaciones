<html>
<head>
<title>Menú de Opciones</title>
<style type="text/css">
<!--
body {text-align:center;}
td.row1 { background-color: #D5E7FB; }
td.row2 { background-color: #A4B4C1;}
th.row1 { background-color: #A4B4C1; }
#menu {margin:auto;text-align:center;width:20%;font-family: Verdana, Arial, Helvetica,
sans-serif; font-size: 7.5pt; border: 2px dashed Black; padding: 1px; background=#FAFAFF;}
#menu a {display:block;width:100%; text-decoration:none;color:#000000}
#menu a:active,#menu a:link,#menu a:visited{background-color: #D5E7FB;}
#menu a:hover{background-color: #FAFAFF;}
-->
</style>
</head>
<body>
<FORM METHOD="post" ACTION="menu_secundario.php">
<table id="menu" cellpadding='0' cellspacing='0' align="left">
<tr>
<th class="row1" colspan=1>Opciones</th></tr>
<?
  $link= array("1&Parametros","2&Proceso","4&Transacciones","3&Consulta");
  $cambio=0;
  for ($i=0;$i<count($link);$i++)
 {
   $datos=explode("&",$link[$i]);
   if ($cambio==0) 
   { 
   	echo "<tr>"; 
   }
?> 
<td class="row1"><a href="menu_secundario.php?cod=<?=$datos[0]?>&nom=<?=$datos[1]?>"><?=$datos[1]?></a></td> 
<?
   $cambio++;
   if ($cambio==1) 
   {
   	echo "</tr>"; 
   	$cambio=0;
   }
}
?> 
<tr><td class="row2" colspan=3><marquee>Menú Principal</marquee></td></tr>
</table>
</body>
</html>