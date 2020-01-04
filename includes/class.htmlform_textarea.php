<?php

/**
 *  Class for textarea controls
 *
 *  @author     Stefan Gabos <ix@nivelzero.ro>
 *  @copyright  (c) 2006 Stefan Gabos
 *  @package    HTMLForm_Controls
 */
class HTMLForm_textarea extends HTMLForm_control
{

    /**
     *  Places a textarea control
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
     *  $obj = & $form->add("textarea", "control_id", "Default text");
     *
     *  </code>
     *
     *  @param  string  $controlID      Unique name to identify the control in form
     *
     *                                  <i>Note that control's ID attribute will be, by default, the same as the name attribute!</i>
     *
     *  @param  string  $defaultValue   (optional) Default text
     *
     *  @param  array   $attributes     (optional) an array of user specified HTML attributes valid for a textarea control
     *
     *                                  must be specified as an associative array of type attributeName=>attributeValue
     *
     *                                  See {@link HTMLForm_control::setAttributes()} method to see how to set HTML attributes,
     *                                  other than through the class' contructor
     *
     *                                  <i>note that the following properties are automatically set and should not
     *                                  be altered manually:</i>
     *
     *                                  <b>id</b>, <b>name</b>, <b>class</b>, <b>onfocus</b>, <b>onblur</b>
     *
     *  @return void
     */
    function HTMLForm_textarea($controlID, $defaultValue = "", $attributes = "")
    {
    
        // call the constructor of the parent class
        parent::HTMLForm_control();
    
        // set the private attributes of this control
        // these attributes are private for this control and are for internal use only
        $this->privateAttributes =  array(
            "type",
            "value"
        );

        // set the default attributes for the textarea control
        $this->setAttributes(
            array(
                "type"      =>  "textarea",
                "id"        =>  $controlID,
                "name"      =>  $controlID,
                "value"     =>  $defaultValue,
                "class"     =>  "HTMLForm-textarea",
                "onfocus"   =>  "this.className = 'HTMLForm-textarea-focus'",
                "onblur"    =>  "this.className = 'HTMLForm-textarea'"
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

        // get private attributes
        $privateAttributes = $this->getAttributes("value");

        return "<textarea ".$this->renderAttributes().">".(isset($privateAttributes["value"]) ? $privateAttributes["value"] : "")."</textarea>";

    }

}

?>
