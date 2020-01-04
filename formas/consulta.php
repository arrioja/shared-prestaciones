<?php 
      echo<table align =center>;
      $columnes = 4; # Número de columnas (variable) 

      if (($rows=mysql_num_rows($result))==0) 
       { 
         echo <tr><td colspan=$columnes>No hay resultados en la BD.</td></tr>;
       } 
      else 
       { 
         echo <tr><td colspan=$columnes>$rows Resultados </td></tr>; 
       } 

      for ($i=1; $row = mysql_fetch_row ($result); $i++) 
       { 
         $resto = ($i % $columnes); # Número de celda del <tr> en que nos encontramos 
         if ($resto == 1) 
         {
         	echo <tr>;
         } # Si es la primera celda, abrimos <tr> 
         echo <td>$row[1]</td>; 
         if ($resto == 0) {echo </tr>;} # Si es la última celda, cerramos </tr> 
       } 
      if ($resto <> 0) 
       { # Si el resultado no es múltiple de $columnes acabamos de rellenar los huecos 
        $ajust = $columnes - $resto; # Número de huecos necesarios 
        for ($j = 0; $j < $ajust; $j++) 
         {
         	echo <td>&nbsp;</td>;
         } 
        echo </tr>; # Cerramos la última línea </tr> 
       } 
    mysql_close($connexion); 
    echo </table>; 
?> 