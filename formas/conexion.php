<!-- cene -->
<html>
<head>
   <title>CONEXION BASE DE DATOS</title>
</head>
<body>
<?php
   // Varialbles para la conexión al Servidor de Base de Datos
   $host="192.168.50.14"; //nombre o dirección IP del servidor de BD -localhost
   $usuario="orlenis"; // nombre de usuario para conectarse la servidor de BD
   $password="123456"; // clave de acceso al servidor de BD
   
   // Función para establecer conexión con el servidor de MySql y la 
   // Base de Datos seleccionada.
function Conectarse()
{
   // Realiza la conexión con el servidor de MySQL.		
   if (!($link=mysql_connect("192.168.50.14","orlenis","123456")))
   {
      echo "Error Conectandose en el servidor.";
      exit();
   }
   // Elige la Base de Datos prestaciones
   if (!mysql_select_db("prestaciones",$link))
   {
      echo "Error seleccionando la base de datos.";
      exit();
   }
   return $link;
}

// Llamando a la función para conectarse
//$link=Conectarse();
    #echo "Conexión con la base de datos conseguida.<br>";
// Cerrando la conexión con el servidor MySQL
//mysql_close($link); //cierra la conexion
?>
</body>
</html> 