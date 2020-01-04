<html>
   <head>
        <title>Formulario Criterio de Vacaciones</title>
    </head>
    <body>
   <table Border=3 Width=100% > 
   <tr>
    <td>
    <?php
       
      echo "Son exactamente las : ",Date("h:i:s"),"... y hoy es: ",Date("d-m-Y");
       echo "<BR>";
       echo "Es el dia numero <B>",Date("z"),"</B> del año";
    ?>
    </td>
   
   </tr>
   
   </table>
    </body>
</html>
