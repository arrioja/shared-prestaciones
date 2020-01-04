<?
# recogemos en una variable el nombre de BASE DE DATOS

$base="prestaciones";

# recogemos en una variable el nombre de la TABLA

$tabla="mes_progreso";

# recoger y adaptar las variables pasadas desde el formulario
# ni el DNI ni los nombres y apellidos necesitan ninguna modificacion
# por eso los pasamos a la variable directamente

#$v1=$p_v1;
#$v2=$p_v2;
#$v3=$p_v3;
#$v4=$p_v4;
///

$ano=
$mes=
$estado=
# recogemos la cadena fecha en formato AAAA-MM-DD
# para ello encadenamos los valores recogidos del formulario
# año ($p_v5[0]) mes ($p_v5[1]) y día ($p_v5[2])
# incluyendo los separadores de fechas (-)
# y los recogemos en la variable $v5


#$v5=$p_v5[0]."-".$p_v5[1]."-".$p_v5[2];

# la variable Sexo la recogemos sin modificaciones
# ya que desde el formulario solo recibimos
# valor M ó valor F

#$v6=$p_v6;

# encadenamos las variables horas ($p_v7[0])
# minutos ($p_v7[1]) y segundo ($p_v7[2])
# incluyendo el separador de hora (:)
# recogemos el resultado en $v7


#$v7=$p_v7[0].":".$p_v7[1].":".$p_v7[2];

# la variable $p_v8 puede contener valores
# 0 (no fumador) ó 1 (si fumador)
# con este bucle asignamos NULL para el primero de los casos
# o CADENA VACIA para el segundo
# ¡¡Atención......
# fijate como pasamos la cadena vacia
# y fijate que en el INSERT no ponemos la variable $v8 entre comillas
# es la excepción para el tipo de variable CHAR(O)
# LA UNICA QUE NO PASAMOS ENTRECOMILLADA

#if ($p_v8==0) {
# $v8='"\n"';
# }else{
# $v8='""';
#}

# el truco de asignar en el formulario valores 1,2,4,8,16,32 a las opciones de idioma
# nos permite sumarlos aquí para obtener el valor conjunto
# aqui se suman todos los valores de la matriz pasada desde el formulario

#foreach($p_v9 as $valor) {
#$v9+=$valor;
#};

# establecemos la conexion con el servidor

$conexion=mysql_connect("192.168.50.14","orlenis","123456");

#asiganamos la conexión a una base de datos determinada

mysql_select_db($base,$conexion);

# AÑADIMOS EL NUEVO REGISTRO

mysql_query("INSERT $tabla (DNI,Nombre,Apellido1,Apellido2, Nacimiento,Sexo,Hora,Fumador,Idiomas) VALUES ('$v1','$v2','$v3','$v4','$v5','$v6','$v7',$v8,'$v9')",$conexion);

#comprobamos el resultado de la insercion
# el error CERO significa NO ERROR
# el error 1062 significa Clave duplicada
# en otros errores forzamos a que nos ponga el número de error
# y el significado de ese error (aunque sea en ingles)....


if (mysql_errno($conexion)==0){echo "<h2>Registro AÑADIDO</b></H2>";
             }else{
        if (mysql_errno($conexion)==1062){echo "<h2>No ha podido añadirse el registro<br>Ya existe un campo con este DNI</h2>";
            }else{ 
            $numerror=mysql_errno($conexion);
            $descrerror=mysql_error($conexion);
            echo "Se ha producido un error nº $numerror que corresponde a: $descrerror  <br>";
        }

}

# cerramos la conexion

 mysql_close(); 

?>