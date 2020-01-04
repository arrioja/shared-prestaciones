<?php

/**
 *  Class for hidden controls
 *
 *  @author     Stefan Gabos <ix@nivelzero.ro>
 *  @copyright  (c) 2006 Stefan Gabos
 *  @package    HTMLForm_Controls
 */
class HTMLForm_hidden extends HTMLForm_control
{

    /**
     *  Places a hidden control
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
     *  $obj = & $form->add("hidden", "control_id", "hidden value");
     *
     *  </code>
     *
     *  @param  string  $controlID      Unique name to identify the control in form
     *
     *                                  <i>Note that control's ID attribute will be, by default, the same as the name attribute!</i>
     *
     *  @param  string  $defaultValue   (optional) Default value to be stored in the hidden value
     *
     *  @return void
     */
    function HTMLForm_hidden($controlID, $defaultValue = "")
    {
    
        // call the constructor of the parent class
        parent::HTMLForm_control();
    
        // set the default attributes for the hidden control
        $this->setAttributes(
            array(
                "type"  =>  "hidden",
                "id"    =>  $controlID,
                "name"  =>  $controlID,
                "value" =>  $defaultValue
            )
        );
        
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
