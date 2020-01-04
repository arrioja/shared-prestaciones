<html>
<head>
<title>Módulo Consulta de Pasivo Laboral</title>
</head>
<body>
<?
    // Pinto la tabla del titulo
    echo "<table align=center border=2 bgcolor='#D5E7FB' width=100%>";
    echo "<tr bgcolor='#A4B4C1'><td colspan=5 align=center><strong><font size=5>Módulo: Consultar Pasivo Laboral Individual</font></strong></td><tr bgcolor='#D5E7FB'>";
    echo "<tr bgcolor='#A4B4C1'><td colspan=5 align=left><strong><font size=3>Datos Personales</font></strong></td><tr bgcolor='#E8F2FC'>";
?>
   <table align="center" border="0" bgcolor='#E8F2FC' width="100%">
   <tr><td colspan="5" align="left">Nro. Cédula:</td>
   <td align="left" width="80%" ><input type="text" name="cedula" value="" size=10><input type=submit value="Aceptar"></td></tr>
   <tr><td colspan="5" align="left">Nombre y Apellido: </td>
   <td align="left" width="80%"> <input type="text" name="nombre" value="" size=45></td></tr>
   </table>
 <?
   echo "<table align=center border=0 bgcolor='#E8F2FC' width=100%>";  
   echo "<tr bgcolor='#A4B4C1'><td colspan=5 align=left><strong><font size=3>Datos Laborales</font></strong></td><tr bgcolor='#E8F2FC'>";
?>    
   <table align="center" border="0" bgcolor='#E8F2FC' width="100%">
<tr><td colspan="5" align="left" width="10%">Fecha Ingreso: </td>
    <td align="left" width="10%"> <input type="text" name="fecha_ingreso" value="" size=10></td>
    <td colspan="5" align="left" width="10%">Situación: </td>
    <td align="left" width="10%"> <input type="text" name="situacion" value="" size=25></td></tr>
  
<?php   
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
      
        
        $form->add("label", "label_ano", "ano", "Año");
        
        $obj = & $form->add("text","ano");
        $obj->setAttributes(array("size" =>4));            
        $obj->setRule(array("mandatory"=>array("e1", "Por favor! el año a consultar")));        
           
        $form->add("label", "label_mes", "mes", "Mes");
        $obj = & $form->add("select", "mes");
        $obj->addOptions(array("- Selecione -","1" =>"01", "2" =>"02", "3" =>"03", "4" =>"04",
                          "5" =>"05", "6" =>"06", "7" =>"07", "8" =>"08", "9" =>"09",
                          "10" =>"10", "11" =>"11", "12" =>"12"));
        $obj->setRule(array("mandatory"=>array("e2", "Por favor! Seleccione el mes correspondiente al año que dese incluir")));

        $form->add("label", "label_estatus", "estatus", "Estatus");      
        $obj = & $form->add("select", "situacion");
        $obj->addOptions(array("- Selecione -","Activo" =>"Activo","Cerrado" =>"Cerrado", "Habilitado" =>"Habilitado"));
        $obj->setRule(array("mandatory"=>array("e3", "Por favor! Seleccione la situación del mes en proceso")));
       
        
        $form->add("submit", "submit_consultar", "consultar");
        
        // validate the form
        if ($form->validate()) 
        {
        
            // code if form is valid
           
        }
      
        // display the form with the specified template
        $form->render("pasivolaboral.xtpl");
?>  
<table align="center" border="0" bgcolor='#E8F2FC' width="100%">
<tr><td colspan="5" align="left" width="15%">Indemnización Art.666:</td>
   <td align="left" width="10%" ><input type="text" name="art_666" value="" size=15></td>
   <td colspan="5" align="left" width="15%">Intereses Acumulado: </td>
   <td align="left" width="10%"> <input type="text" name="interes_acum_disp" value="" size=15></td></tr>  
<tr><td colspan="5" align="left" width="10%">Compensación por Transferencia:</td>
   <td align="left" width="10%" ><input type="text" name="comp_transferencia" value="" size=15></td>
   <td colspan="5" align="left" width="10%">Interes Retirados: </td>
   <td align="left" width="10%"> <input type="text" name="interes_reti" value="" size=15></td></tr> 
<tr><td colspan="5" align="left" width="10%">Sub.Total Disposiciones:</td>
   <td align="left" width="10%" ><input type="text" name="total_disp" value="" size=15></td>
   <td colspan="5" align="left" width="10%">Intereses por Pagar: </td>
   <td align="left" width="10%"> <input type="text" name="interes_pagar" value="" size=15></td></tr>
<tr><td colspan="5" align="left" width="10%">Capitalización de Intereses:</td>
   <td align="left" width="10%" ><input type="text" name="capi_interes" value="" size=15></td>
   <td colspan="5" align="left" width="10%">Mora Acumulado: </td>
   <td align="left" width="10%"> <input type="text" name="mora_acum" value="" size=15></td></tr>
<tr><td colspan="5" align="left" width="10%">Acumulado Pagado:</td>
   <td align="left" width="10%" ><input type="text" name="acum_pagado" value="" size=15></td>
   <td colspan="5" align="left" width="10%">Mora Pagada: </td>
   <td align="left" width="10%"> <input type="text" name="mora_pagada" value="" size=15></td></tr>
<tr><td colspan="5" align="left" width="10%">SubTotal Capital :</td>
   <td align="left" width="10%" ><input type="text" name="sub_capital" value="" size=20></td>
   <td colspan="5" align="left" width="10%">Mora Pendiente: </td>
   <td align="left" width="10%"> <input type="text" name="mora_pendi" value="" size=15></td></tr>
<tr><td colspan="5" align="left" width="10%"></td>
   <td align="left" width="10%" ></td>
   <td colspan="5" align="left" width="10%">Deuda Actual: </td>
   <td align="left" width="10%"> <input type="text" name="deuda_actual" value="" size=15></td></tr>
</table>         
<?
   echo "<table align=center border=0 bgcolor='#E8F2FC' width=100%>";  
   echo "<tr bgcolor='#A4B4C1'><td colspan=5 align=center><strong><font size=3>Prestaciones Sociales</font></strong></td><tr bgcolor='#E8F2FC'>";
?>  
   <table align="center" border="0" bgcolor='#E8F2FC' width="100%">
<tr><td colspan="5" align="left" width="10%">Sueldo Integral:</td>
   <td align="left" width="10%" ><input type="text" name="sueldointegral" value="" size=15></td>
   <td colspan="5" align="left" width="10%">Intereses Acumulado: </td>
   <td align="left" width="10%"> <input type="text" name="interes_acum" value="" size=15></td></tr>
<tr><td colspan="5" align="left" width="10%">Nro.Días del Mes: </td>
   <td align="left" width="10%"> <input type="text" name="num_dias" value="" size=4></td>
   <td colspan="5" align="left" width="10%">Intereses Retirados: </td>
   <td align="left" width="10%"> <input type="text" name="intereses_reti" value="" size=15></td></tr>
<tr><td colspan="5" align="left" width="10%">Monto Antiguedad Nro. 108:</td>
   <td align="left" width="10%" ><input type="text" name="monto_art108" value="" size=15></td>
   <td colspan="5" align="left" width="10%">Saldo Intereses por Retirar: </td>
   <td align="left" width="10%"> <input type="text" name="saldo_inte_reti" value="" size=15></td></tr> 
<tr><td colspan="5" align="left" width="10%">Nro.Días Acumulados:</td>
   <td align="left" width="10%" ><input type="text" name="num_dias_acum" value="" size=4></td>
   <td colspan="5" align="left" width="10%">Saldo Fideicomiso Laboral: </td>
   <td align="left" width="10%"> <input type="text" name="saldo_fide_laboral" value="" size=15></td></tr>

<tr><td colspan="5" align="left" width="10%">Antigüedad Acumulada:</td>
   <td align="left" width="10%" ><input type="text" name="antoguedad_acum" value="" size=15></td>
   <td colspan="5" align="left" width="10%">Total Pasivo Laboral: </td>
   <td align="left" width="10%"> <input type="text" name="total_pasivo_labo" value="" size=20></td></tr>

<tr><td colspan="5" align="left" width="10%">Interes Capitalizado:</td>
   <td align="left" width="10%" ><input type="text" name="interes_capi" value="" size=15></td>
   <td colspan="5" align="left" width="10%" bgcolor="#E0FAC5">Monto Máximo Adelanto: </td>
   <td align="left" width="10%" bgcolor="#E0FAC5"> <input type="text" name="monto_max_adela" value="" size=15></td></tr>
      
   
<tr><td colspan="5" align="left" width="10%">Acumulado Adelantos:</td>
   <td align="left" width="10%" ><input type="text" name="acum_adelantos" value="" size=15></td>
   <td colspan="5" align="left" width="10%" bgcolor="#E0FAC5">Fecha Próximo Retiro Int.: </td>
   <td align="left" width="10%" bgcolor="#E0FAC5"> <input type="text" name="fecha_proxi_reti" value="" size=10></td></tr>

<tr><td colspan="5" align="left" width="10%">Sub Total del Capital:</td>
   <td align="left" width="10%" ><input type="text" name="sub_capital" value="" size=20></td>
   <td colspan="5" align="left" width="10%" bgcolor="#E0FAC5">Monto Máximo Solicitar: </td>
   <td align="left" width="10%" bgcolor="#E0FAC5"> <input type="text" name="monto_max_soli" value="" size=20></td></tr>  
   </table>
    </body>
</html>
