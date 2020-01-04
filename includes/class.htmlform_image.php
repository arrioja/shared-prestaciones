<?php

/**
 *  Class for image controls
 *
 *  @author     Stefan Gabos <ix@nivelzero.ro>
 *  @copyright  (c) 2006 Stefan Gabos
 *  @package    HTMLForm_Controls
 */
class HTMLForm_image extends HTMLForm_control
{

    /**
     *  Places an image control
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
     *  $obj = & $form->add("image", "control_id", "path_to_an_image");
     *
     *  </code>
     *
     *  @param  string  $controlID      Unique name to identify the control in form
     *
     *                                  <i>Note that control's ID attribute will be, by default, the same as the name attribute!</i>
     *
     *  @param  string  $image          Path to an image to display
     *
     *  @param  array   $attributes     (optional) an array of user specified HTML attributes valid for an image control
     *
     *                                  must be specified as an associative array of type attributeName=>attributeValue
     *
     *                                  See {@link HTMLForm_control::setAttributes()} method to see how to set HTML attributes,
     *                                  other than through the class' contructor
     *
     *                                  <i>note that the following properties are automatically set and should not
     *                                  be altered manually:</i>
     *
     *                                  <b>type</b>, <b>id</b>, <b>name</b>, <b>src</b>, <b>class</b>
     *
     *  @return void
     */
    function HTMLForm_image($controlID, $image, $attributes = "")
    {
    
        // call the constructor of the parent class
        parent::HTMLForm_control();
        
        // set the default attributes for the image control
        $this->setAttributes(
            array(
                "type"  =>  "image",
                "id"    =>  $controlID,
                "name"  =>  $controlID,
                "src"   =>  $image,
                "class" =>  "HTMLForm-image"
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
