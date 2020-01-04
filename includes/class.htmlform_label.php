<?php

/**
 *  Class for labels
 *
 *  @author     Stefan Gabos <ix@nivelzero.ro>
 *  @copyright  (c) 2006 Stefan Gabos
 *  @package    HTMLForm_Controls
 */
class HTMLForm_label extends HTMLForm_control
{

    /**
     *  Places a label
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
     *  $obj = & $form->add("label", "control_id_to_assign_to", "label's caption");
     *
     *  </code>
     *
     *  @param  string  $controlID      Unique name to identify the control in form
     *
     *                                  <i>Note that control's ID attribute will be, by default, the same as the name attribute!</i>
     *
     *  @param  string  $forControlID    <b>ID</b> of the control to link the label to.
     *
     *                                  <i>Notice that is the ID attribute of the control and no the name attribute!
     *
     *                                  This is important as while most of the controls have their ID attribute set by default to the same
     *                                  value as their name attribute, the {@link HTMLForm_checkbox} and {@link HTMLForm_radio} behave
     *                                  differently</i>
     *
     *  @param  mixed   $caption        (optional) Caption of the label
     *
     *  @param  array   $attributes     (optional) an array of user specified HTML attributes valid for a label
     *
     *                                  must be specified as an associative array of type attributeName=>attributeValue
     *
     *                                  See {@link HTMLForm_control::setAttributes()} method to see how to set HTML attributes,
     *                                  other than through the class' contructor
     *
     *                                  <i>note that the following properties are automatically set and should not
     *                                  be altered manually:</i>
     *
     *                                  <b>name</b>, <b>id</b>, <b>for</b>, <b>class</b>
     *
     *  @return void
     */
    function HTMLForm_label($controlID, $forControlID, $caption, $attributes = "")
    {

        // call the constructor of the parent class
        parent::HTMLForm_control();

        // set the private attributes of this control
        // these attributes are private for this control and are for internal use only
        $this->privateAttributes = array("label");

        // set the default attributes for the label
        $this->setAttributes(
            array(
                "name"  =>  $controlID,
                "id"    =>  $controlID,
                "for"   =>  $forControlID,
                "label" =>  $caption,
                "class" =>  "HTMLForm-label"
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

        // get private attributes
        $privateAttributes = $this->getAttributes("label");

        return "<label ".$this->renderAttributes().">".$privateAttributes["label"]."</label>";

    }

}

?>
