<? 

#recogemos del formulario las variables Calificacion y Penitente
# en variables automaticas de PHP que serán $Calificacion y $Penitente
# atención a Mayusculas/Minusculas en nombres de variables
# recuerda que para PHP son DISTINTAS

 $nombre=$_GET['descripcion'];
 $nombre_tipo=$_GET['tipo']; 
 $fechareg= date("Y-m-d, H:i:s");   
 $clave=($_GET['ident']); 

 #$clave=$id;

 #$base="rinconastur";

# establecemos la conexión con el servidor
include ('conexion.php');
$link=Conectarse();
   #$conexion=mysql_connect ("localhost","root","pepe");

#Seleccionamos la BASE DE DATOS en la que PRETENDEMOS TRABAJAR

  #mysql_select_db ($base, $conexion);

# establecemos el nombre de la tabla en una variable

$tabla="tipo_egreso";

#########################################################################
# COMPROBACION DE LA EXISTENCIA DE UN REGISTRO CON ESE D.N.I.           #
#########################################################################

# Es una operación necesaria para advertir al usuario de la correcta realización
# del proceso de modificación.
# Si introducimos un DNI inexistente la función UPDATE no DARA MENSAJE DE ERROR
# aunque evidentemente NO LO ACTUALIZARA tampoco
#
# Para hacer esa comprobación tenemos múltiples opciones una de ellas sería
# contar los registros en los que el DNI es igual al valor recibido en la variable
# $Penitente
# Si existiera el DNI devolvería UNO en el índice CERO DEL ARRAY
# recuerda que los indices de ese array se corresponden con el orden
# en el que han sido insertados los campos en la opcion SELECT
# en este caso solo ponemos uno... COUNT(DNI) por lo que el índice del array
# ha de ser el primero de los posibles que como sabes es CERO

  $resultado=mysql_query("SELECT COUNT(id_egreso) FROM $tabla WHERE (id_egreso='$clave')",$link);
  $comprueba=mysql_fetch_array($resultado);

#HACEMOS LA COMPROBACION
# y en caso de inexistencia del recogemos en una variable ($Avisar)
# la cadena del mensaje de inexistencia
# en otro caso (cuando el DNI existe) hacemos que ese mensaje sea la cadena vacia

if($comprueba[0]==0) {$avisar="<h2>No existe ese registro ".$clave. " en la base de datos<br>Su Modificacion anterior no ha sido procesada</h2>";
            }else{
              $avisar="";
             }

# hacemos la llamada a MySQL mediante la función mysql_query
# y le decimos que UPDATE (modifique) la tabla
# y que lo haga (SET) en el campo Puntos 
# poniendo el valor que en este caso $valor
# si el DNI existe en la base de datos actualizará el valor
# y si no existe no pasa nada... ya tenemos el mensaje de error
# que nos aparecerá en la página formulario
 
$resultado=mysql_query("UPDATE $tabla SET descripcion='$nombre', tipo='$nombre_tipo', fecha_registro='$fechareg' WHERE (id_egreso='$clave')",$link);

#colocamos la opcion de mensaje de error por si se produce alguna incidencia

if (mysql_errno($link)==0){echo " "; 
             }else{ 
        if (mysql_errno($link)==1062){echo "<h2>No ha podido añadirse el registro<br>Ya existe un campo con este DNI</h2>"; 
            }else{  
            $numerror=mysql_errno($link); 
            $descrerror=mysql_error($link); 
            echo "Se ha producido un error nº $numerror que corresponde a: $descrerror  <br>"; 
        } 

}

# cerramos la conexión con la base de datos    
    

mysql_close($link);

# escribimos un mensaje para que nos avise del final de proceso de actualización

#insertamos el script de Java que nos devolverá al formulario

#####################################################
#fijate como pasamos el valor del mensaje de aviso  #
#####################################################

# para pasar valores a PHP hay la opcion de añadir a la direccion
# URL del script el simbolo de cerrar interrogacion
# seguido del nombre de la variable con la que será transferido
# el signo igual y el valor de la variable
#
# si quieres pasar mas de una variable la sintaxis sería
# http://loquesea.php?variable1=valor1&variable2=valor2&variable3=valor3


#
#<script language='JavaScript'>

#<? echo "window.self.location='insertar_tipoegreso.php?avisa=$avisar'" 


