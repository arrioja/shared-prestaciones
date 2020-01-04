<html>
   <head>
        <title>Formulario Criterio de Vacaciones</title>
    </head>
    <body>
   <table Border=1 Width=100% > 
 <tr>
 <th align="right"></th>
 <td bgcolor="Blue" align="center" background="white" width="100%"> Módulo Criterio de Vacación</td>
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

        $form->add("label", "label_resolucion", "resolucion", "Nro. Resolución");
        $obj = & $form->add("text", "resolucion");
        $obj->setRule(array("mandatory"=>array("e1", "Por favor! Introduzca el número de resolución para este criterio de Vacación")));
        
        $form->add("label", "label_fecharesolucion", "fecharesolucion", "Fecha de Resolución:");
        $obj = & $form->add("date", "fecharesolucion");
        // set some properties of the date picker
        $obj->datePicker->preselectedDate = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
        $obj->datePicker->dateFormat = "d M Y";
        $obj->setRule(array("mandatory"=>array("e6", "Por favor! seleccione la fecha de la Resolución del Criterio")));
        
        $form->add("label", "label_estado", "estado", "Estado del Criterio");
        $obj = & $form->add("select", "estado");
        $obj->addOptions(array("- Selecione -", "Vigente", "Anterior"));
        $obj->setRule(array("mandatory"=>array("e7", "Por favor! Especifique la Vigencia del criterio")));

        $form->add("label", "label_periodo", "periodo", "Periodo");
        $obj = & $form->add("text", "periodo");
        $obj->setRule(array("mandatory"=>array("e8", "Por favor! Introduzca el periodo en años para el criterio")));

        $form->add("label", "label_diasdisfrute", "diasdisfrutes", "Nro. días del disfrute");
        $obj = & $form->add("text", "diasdisfrute");
        $obj->setRule(array("mandatory"=>array("e9", "Por favor! Introduzca el número de días correspondiente al disfrute para este periodo")));
 
        $form->add("label", "label_diaspagados", "diaspagados", "Nro. días de Bono");
        $obj = & $form->add("text", "diaspagados");
        $obj->setRule(array("mandatory"=>array("e10", "Por favor! Introduzca el número de días correspondiente al Bono para este periodo")));
        
        $form->add("submit", "submit_aceptar", "Aceptar");
        
        $form->add("button", "button_aceptar", "Aceptar");
          
        $form->add("reset", "reset_cancelar", "Cancelar");
        // place a submit button
       
    
        // validate the form
        if ($form->validate()) {
        
            // code if form is valid
            print_r("Form is valid. Redirect or whatever...");

        }
        
        // display the form with the specified template
        $form->render("example.xtpl");

    ?>
    </table>
    </body>
</html>
