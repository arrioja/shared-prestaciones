<html>
<head>
<title>Módulo gestion de Personal</title>
</head>
<body>
<?
    // Pinto la tabla del titulo
    echo "<table align=center border=2 bgcolor='#D5E7FB' width=100%>";
    echo "<tr bgcolor='#A4B4C1'><td colspan=5 align=center><strong><font size=5>Módulo: Gestión de Personal</font></strong></td><tr bgcolor='#D5E7FB'>";
    echo "<tr bgcolor='#A4B4C1'><td colspan=5 align=left><strong><font size=3>Datos Personales</font></strong></td><tr bgcolor='#D5E7FB'>";
?>
   <table align="center" border="0" bgcolor='#D5E7FB' width="100%">
   <tr><td colspan="5" align="left">Nro. Cédula :</td>
   <td align="left" ><input type="text" name="cedula" value="" size=10><input type=submit value="Aceptar"></td></tr>
   <tr><td colspan="5" align="left">Nombre y Apellido : </td>
   <td align="left" width="100%"> <input type="text" name="nombre" value="" size=45></td></tr>
   </table>
     
   <table align="center" border="0" bgcolor='#D5E7FB' width="100%">
   <tr bgcolor='#A4B4C1'><td colspan=5 align=left width="100%"><strong><font size=3>Datos Adelatos</font></strong></td><tr bgcolor='#D5E7FB'>
   <td colspan="5" align="left">Monto de Prestación : </td>
   <td align="left" width="100%"> <input type="text" name="montoprestacion" value="" size=30></td><tr>
   <td colspan="5" align="left">Monto Máximo de Adelanto : </td>
   <td align="left" width="100%"> <input type="text" name="montomax" value="" size=45></td><tr>
   
<?php
    echo "<tr bgcolor='#A4B4C1'><td colspan=5 align=left><strong><font size=3>Datos Adelatos</font></strong></td><tr bgcolor='#D5E7FB'>";
     
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
        // cambie 
      
        $form->add("label", "label_montoadelanto", "montoadelanto", "Monto del Adelanto");
        $obj = & $form->add("text","montoadelanto");
        $obj->setAttributes(array("size" =>15));            
        $obj->setRule(array("mandatory"=>array("e1", "Por favor! Introduzca Cifras Válidas")));
       
        
        $form->add("submit", "submit_aceptar", "Procesar");

        
        // validate the form
        if ($form->validate()) {
        
            // code if form is valid
            
        }
      
        // display the form with the specified template
        $form->render("gestionpersonal.xtpl");
    ?>
    </body>
</html>
