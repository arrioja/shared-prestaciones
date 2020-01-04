<?php

/**
 *  Class for button controls
 *
 *  @author     Stefan Gabos <ix@nivelzero.ro>
 *  @copyright  (c) 2006 Stefan Gabos
 *  @package    HTMLForm_Controls
 */
class HTMLForm_button extends HTMLForm_control
{

    /**
     *  Places a button control
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
     *  $obj = & $form->add("button", "control_id", "Click me!");
     *
     *  </code>
     *
     *  @param  string  $controlID      Unique name to identify the control in form
     *
     *                                  <i>Note that control's ID attribute will be, by default, the same as the name attribute!</i>
     *
     *  @param  string  $caption        (optional) Caption of the button control
     *
     *  @param  array   $attributes     (optional) an array of user specified HTML attributes valid for a button control
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
    function HTMLForm_button($controlID, $caption, $attributes = "")
    {
    
        // call the constructor of the parent class
        parent::HTMLForm_control();
        
        // set the default attributes for the button control
        $this->setAttributes(
            array(
                "type"  =>  "button",
                "id"    =>  $controlID,
                "name"  =>  $controlID,
                "value" =>  $caption,
                "class" =>  "HTMLForm-button"
            )
        );

        // sets user specified attributes for the table cell
        $this->setAttributes($attributes);

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
