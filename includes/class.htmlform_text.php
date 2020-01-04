<?php

/**
 *  Class for text controls
 *
 *  @author     Stefan Gabos <ix@nivelzero.ro>
 *  @copyright  (c) 2006 Stefan Gabos
 *  @package    HTMLForm_Controls
 */
class HTMLForm_text extends HTMLForm_control
{

    /**
     *  Places a text control
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
     *  $obj = & $form->add("text", "control_id", "Default text");
     *
     *  </code>
     *
     *  @param  string  $controlID      Unique name to identify the control in form
     *
     *                                  <i>Note that control's ID attribute will be, by default, the same as the name attribute!</i>
     *
     *  @param  string  $defaultValue   (optional) Default text
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
     *                                  <b>type</b>, <b>id</b>, <b>name</b>, <b>value</b>, <b>class</b>, <b>onfocus</b>, <b>onblur</b>
     *
     *  @return void
     */
    function HTMLForm_text($controlID, $defaultValue = "", $attributes = "")
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
                "class"     =>  "HTMLForm-text",
                "onfocus"   =>  "this.className = 'HTMLForm-text-focus'",
                "onblur"    =>  "this.className = 'HTMLForm-text'"
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
