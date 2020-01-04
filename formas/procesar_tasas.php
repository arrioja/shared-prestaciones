<html>
<head>
   <title>Plantilla Tasas</title>
</head>
<body>
<H1></H1>
<FORM ACTION="procesar_tasas.php" METHOD="POST">
<TABLE border="1" align="center" width="100%">
<TR>
   <TD>Fecha:</TD>
   <TD><INPUT TYPE="text" NAME="fecha" SIZE="20" MAXLENGTH="30"></TD>
</TR>
<TR>
   <TD>Nro. Gaceta:</TD>
   <TD><INPUT TYPE="text" NAME="gaceta" SIZE="20" MAXLENGTH="30"></TD>
</TR>
<TR>
   <TD>Activa:</TD>
   <TD><INPUT TYPE="text" NAME="activa" SIZE="20" MAXLENGTH="30"></TD>
</TR><TR>
   <TD>Pasiva:</TD>
   <TD><INPUT TYPE="text" NAME="pasiva" SIZE="20" MAXLENGTH="30"></TD>
</TR><TR>
   <TD>Promedio:</TD>
   <TD><INPUT TYPE="text" NAME="promedio" SIZE="20" MAXLENGTH="30"></TD>
</TR>
</TABLE>
<INPUT TYPE="submit" NAME="accion" VALUE="Aceptar" id="boton">
</FORM>
<hr>
<?php
   include("conexion.php");
   $link=Conectarse();
   $result=mysql_query("select * from tasas",$link);
?>
   <TABLE BORDER=1 CELLSPACING=1 CELLPADDING=1 width="100%">
      <TR><TD align="center">&nbsp;<B>Fecha</B></TD> <TD align="center">&nbsp;<B>Gaceta</B>&nbsp;</TD> <TD align="center">&nbsp;<B>Activa</B></TD>
      <TD align="center">&nbsp;<B>Pasiva</B></TD><TD align="center">&nbsp;<B>Promedio</B></TD><TD align="center">&nbsp;<B>Modificar</B></TD><TD align="center">&nbsp;<B>Eliminar</B></TD></TR>
<?php      

   while($row = mysql_fetch_array($result)) {
      printf("<tr><td>&nbsp;%s</td> <td>&nbsp;%s&nbsp;</td><td>&nbsp;%s</td><td>&nbsp;%s</td><td>&nbsp;%s</td>
      <td><a href=\"modificar_tasas.php?id=%d\">Modificar</a></td><td><a href=\"eliminar_tasas.php?id=%d\">Eliminar</a></td></tr>", $row["fecha_tasa"],
      $row["resolucion"],$row["activa"],$row["pasiva"],$row["promedio"],$row["id_tasa"],$row["id_tasa"]);
   }
   mysql_free_result($result);
   mysql_close($link);   
?>
</table>

</body>
</html> 