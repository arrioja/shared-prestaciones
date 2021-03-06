<?php

/**
 *  Class for checkbox controls
 *
 *  @author     Stefan Gabos <ix@nivelzero.ro>
 *  @copyright  (c) 2006 Stefan Gabos
 *  @package    HTMLForm_Controls
 */
class HTMLForm_checkbox extends HTMLForm_control
{

    /**
     *  Places a checkbox control
     *
     *  <b>Do not instantiate this class directly!</b>
     *
     *  Use {@link HTMLForm::add()} method instead!
     *
     *  <code>
     *  /*
     *  note the use of the "&" symbol -> it's the way we can have a refference to the object in PHP4
     *  {@*}
     *
     *  $obj = & $form->add("checkbox", "control_id", "checkbox value");
     *
     *  </code>
     *
     *  @param  string  $controlID      Unique name to identify the control in form
     *
     *                                  <i>Note that the</i> <b>name</b> <i>attribute of the control will have the value of $controlID,
     *                                  while the</i> <b>id</b> <i>attribute will be
     *                                  str_replace(array(" ", "[", "]"), array("_", ""), $controlID."_".$value)
     *                                  So, if $controlID is "checkbox" and $value is "value 1", the control's actual ID will be "checkbox_value_1"</i>
     *
     *  @param  mixed   $value          (optional) Value of the checkbox
     *
     *  @param  array   $attributes     (optional) an array of user specified HTML attributes valid for a checkbox control
     *
     *                                  must be specified as an associative array of type attributeName=>attributeValue
     *
     *                                  See {@link HTMLForm_control::setAttributes()} method to see how to set HTML attributes,
     *                                  other than through the class' contructor
     *
     *                                  <i>note that the following properties are automatically set and should not
     *                                  be altered manually:</i>
     *
     *                                  <b>type</b>, <b>id</b>, <b>name</b>, <b>value</b>, <b>class</b>
     *
     *  @return void
     */
    function HTMLForm_checkbox($controlID, $value, $attributes = "")
    {
    
        // call the constructor of the parent class
        parent::HTMLForm_control();
    
        // set the default attributes for the checkbox control
        $this->setAttributes(
            array(
                "type"  =>  "checkbox",
                "id"    =>  str_replace(array(" ", "[", "]"), array("_", ""), $controlID."_".$value),
                "name"  =>  $controlID,
                "value" =>  $value,
                "class" =>  "HTMLForm-checkbox"
            )
        );
        
        // sets user specified attributes for the table cell
        $this->setAttributes($attributes);
        
        // manage submitted value
        $this->getSubmittedValue();

    }
    
    /**
     *  Returns the HTML code of the control
     *
     *  @return string  Resulted HTML code
     *
     *  @access private
     */
    function toHTML()
    {

        return "<input ".$this->renderAttributes()." />";

    }

}

?>
