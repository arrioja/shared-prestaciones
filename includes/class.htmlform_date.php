<?php

/**
 *  Class for date controls
 *
 *  @author     Stefan Gabos <ix@nivelzero.ro>
 *  @copyright  (c) 2006 Stefan Gabos
 *  @package    HTMLForm_Controls
 */
class HTMLForm_date extends HTMLForm_control
{

    /**
     *  Places a date control
     *
     *  <b>Note that this class creates a refference to the Zebra Framework PHP Date Picker Class named "datePicker" through which
     *  you can alter all the properties of the date picker</b>
     *
     *  <b>Also note that the output of this control will be a text box control and an icon to the left of it, as set in the stylesheet
     *  of the {@link $template} file as the class named "HTMLForm-calendarIcon"</b>
     *
     *  <b>Do not instantiate this class directly!</b>
     *
     *  Use {@link HTMLForm::add()} method instead!
     *
     *  <code>
     *  /*
     *  notice the use of the "&" symbol -> it's the way we can have a refference to the object in PHP4
     *  {@*}
     *
     *  $obj = & $form->add("date", "control_id");
     *
     *  </code>
     *
     *  @param  string  $controlID      Unique name to identify the control in form
     *
     *                                  <i>Note that control's ID attribute will be, by default, the same as the name attribute!</i>
     *
     *  @param  array   $attributes     (optional) an array of user specified HTML attributes valid for a text control
     *
     *                                  must be specified as an associative array of type attributeName=>attributeValue
     *
     *                                  See {@link HTMLForm_control::setAttributes()} method to see how to set HTML attributes,
     *                                  other than through the class' contructor
     *
     *                                  <i>note that the following properties are automatically set and should not
     *                                  be altered manually:</i>
     *
     *                                  <b>type</b>, <b>id</b>, <b>name</b>, <b>value</b>, <b>class</b>, <b>onfocus</b>, <b>onblur</b>,
     *                                  <b>readonly</b>
     *
     *  @return void
     */
    function HTMLForm_date($controlID, $defaultValue = "", $attributes = "")
    {
    
        // call the constructor of the parent class
        parent::HTMLForm_control();
    
        // set the default attributes for the text control
        $this->setAttributes(
            array(
                "type"      =>  "text",
                "id"        =>  $controlID,
                "name"      =>  $controlID,
                "value"     =>  $defaultValue,
                "readonly"  =>  "readonly",
                "class"     =>  "HTMLForm-date",
                "onfocus"   =>  "this.className = 'HTMLForm-date-focus'",
                "onblur"    =>  "this.className = 'HTMLForm-date'"
            )
        );
        
        // sets user specified attributes for the table cell
        $this->setAttributes($attributes);
        
        // instantiate the date picker class
        $this->datePicker = new datepicker();

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

        // get some attributes of the control
        $attributes = $this->getAttributes(array("name"));
        
        return "<input ".$this->renderAttributes()." /><a href=\"javascript:;\" onclick=\"".$this->datePicker->show($attributes["name"]).";\"><div class=\"HTMLForm-calendarIcon\"></div></a>";

    }

}

?>
