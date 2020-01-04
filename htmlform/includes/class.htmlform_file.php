<?php

/**
 *  Class for file upload controls
 *
 *  @author     Stefan Gabos <ix@nivelzero.ro>
 *  @copyright  (c) 2006 Stefan Gabos
 *  @package    HTMLForm_Controls
 */
class HTMLForm_file extends HTMLForm_control
{

    /**
     *  Places a file upload control
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
     *  $obj = & $form->add("file", "control_id");
     *
     *  </code>
     *
     *  @param  string  $controlID      Unique name to identify the control in form
     *
     *                                  <i>Note that control's ID attribute will be, by default, the same as the name attribute!</i>
     *
     *  @param  array   $attributes     (optional) an array of user specified HTML attributes valid for a file upload control
     *
     *                                  must be specified as an associative array of type attributeName=>attributeValue
     *
     *                                  See {@link HTMLForm_control::setAttributes()} method to see how to set HTML attributes,
     *                                  other than through the class' contructor
     *
     *                                  <i>note that the following properties are automatically set and should not
     *                                  be altered manually:</i>
     *
     *                                  <b>type</b>, <b>id</b>, <b>name</b>, <b>class</b>, <b>onfocus</b>, <b>onblur</b>
     *
     *  @return void
     */
    function HTMLForm_file($controlID, $attributes = "")
    {
    
        // call the constructor of the parent class
        parent::HTMLForm_control();
    
        // set the default attributes for the text control
        $this->setAttributes(
            array(
                "type"      =>  "file",
                "id"        =>  $controlID,
                "name"      =>  $controlID,
                "class"     =>  "HTMLForm-file",
                "onfocus"   =>  "this.className = 'HTMLForm-file-focus'",
                "onblur"    =>  "this.className = 'HTMLForm-file'"
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
