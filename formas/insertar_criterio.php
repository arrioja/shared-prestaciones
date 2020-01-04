<?php include('conexion.php') ?>

<html>
   <head>
        <title>Formulario Criterio de Vacaciones</title>
    </head>
    <body>
   <table Border=1 Width=100% > 
 <tr>
  <th align="right"></th>
 <td bgcolor="" align="center" background="white" width="100%"> Módulo Egreso del Personal</td>
 </tr>
     <?php

        // create a custom function that compares a control's
        // submitted value with another value
        function valueCompare($controlValue, $valueToCompareTo)
        {
            // if values are not the same
            if ($controlValue != $valueToCompareTo) {

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

        $form->add("label", "label_fechaley", "fechaley", "Fecha de la ley:");
        $obj = & $form->add("date", "fechaley");
        // set some properties of the date picker
        $obj->datePicker->preselectedDate = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
        $obj->datePicker->dateFormat = "d M Y";
        $obj->setRule(array("mandatory"=>array("e1", "Por favor! seleccione la fecha de la Ley")));
        
        $form->add("label", "label_fechacalculo", "fechacalculo", "Fecha del Cálculo:");
        $obj = & $form->add("date", "fechacalculo");
        // set some properties of the date picker
        $obj->datePicker->preselectedDate = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
        $obj->datePicker->dateFormat = "d M Y";
        $obj->setRule(array("mandatory"=>array("e2", "Por favor! seleccione la fecha para el cálculo de la Ley")));
 
        
        
        
        $form->add("label", "label_descripcion", "descripcion", "Tipo de Egreso");
        $obj = & $form->add("text", "descripcion");
        $obj->setRule(array("mandatory"=>array("e1", "Por favor! Introduzca el tipo de Egreso")));
        $obj->setAttributes(array("size" =>45));      
        
        $form->add("label", "label_estado", "estado", "Estado del Egreso");
        $obj = & $form->add("select", "estado");
        $obj->addOptions(array("- Selecione -",  "1"=>"Romania", "Deshabilitado"));
        $obj->setRule(array("mandatory"=>array("e7", "Por favor! Especifique la Vigencia del Egreso")));

        
        $form->add("submit", "submit_aceptar", "Aceptar");
                 
        $form->add("reset", "reset_cancelar", "Cancelar");
        // place a submit button
       
    
        // validate the form
        if ($form->validate()) {
        
            // code if form is valid
            print_r("Form is valid. Redirect or whatever...");
        }
      
        // display the form with the specified template
        $form->render("tipoegreso.xtpl");

    ?>

    </table>
    </body>
</html>
