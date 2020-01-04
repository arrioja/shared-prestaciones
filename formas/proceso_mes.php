<html>
<head>
<title>Módulo Procesar Mes de Prestación</title>
</head>
<body>
<?
    // Pinto la tabla del titulo
    echo "<table align=center border=2 bgcolor='#D5E7FB' width=100%>";
    echo "<tr bgcolor='#A4B4C1'><td colspan=5 align=center><strong><font size=5>Módulo: Procesar Mes</font></strong></td><tr bgcolor='#D5E7FB'>";
    echo "<tr bgcolor='#E8F2FC'><td colspan=5 align=center><strong><font size=5>Infomación</font></strong></td><tr bgcolor='#E8F2FC'>";
    echo "<td colspan=5 align=center><font size=4>Este proceso cierra el mes activo y genera el siguiente;
         cálcula: Prestaciones Sociales, Disposiciones Transitorias e Interese de Mora.
         Se le recomienta respalda la base de datos antes de iniciar este proceso.</font></th><tr bgcolor='#E8F2FC'>";
   
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

    $form->add("label", "label_ano", "ano", "Año");
        
    $obj = & $form->add("text", "ano");
    $obj->setRule(array("digitsonly"=>array("e1", "Por favor! Introduzca el correspondiente")));
    $obj->setAttributes(array("size" =>4));  
               
   $form->add("label", "label_mes", "mes", "Mes");
        
   $obj = & $form->add("select", "mes");
   $obj->addOptions(array("- Selecione -","1" =>"Enero", "2" =>"Febrero", "3" =>"Marzo", "4" =>"Abril",
                          "5" =>"Mayo", "6" =>"Junio", "7" =>"Julio", "8" =>"Agosto", "9" =>"Septiembre",
                          "10" =>"Octubre", "11" =>"Noviembre", "12" =>"Diciembre"));
   $obj->setRule(array("mandatory"=>array("e2", "Por favor! Seleccione el mes correspondiente al año que dese incluir")));

   
   $form->add("submit", "submit_aceptar", "Procesar");
                 
   $form->add("reset", "reset_cancelar", "Cancelar");
    // place a submit button   
    // validate the form

    if ($form->validate()) 
      {     
        // code if form is valid
        #include('registrar_tipoegreso.php');      
      }
    
       // display the form with the specified template
   $form->render("procesomes.xtpl");      
?>
     </td>
    </tr>
  </table> 
 </body>
</html>
