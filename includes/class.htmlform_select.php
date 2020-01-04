<?php

/**
 *  Class for select box controls
 *
 *  @author     Stefan Gabos <ix@nivelzero.ro>
 *  @copyright  (c) 2006 Stefan Gabos
 *  @package    HTMLForm_Controls
 */
class HTMLForm_select extends HTMLForm_control
{

    /**
     *  Places a select box control
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
     *  $obj = & $form->add("select", "control_id", "2");
     *
     *  /*
     *  "Spiders" will be selected by default as we specified that in the constructor
     *  {@*}
     *  $obj->addOptions(array(" - select - ", "Monsters", "Spiders", "Snakes"));
     *
     *  </code>
     *
     *  @param  string  $controlID      Unique name to identify the control in form
     *
     *                                  <i>Note that control's ID attribute will be, by default, the same as the name attribute (with '['
     *                                  and ']' trimmed, if found)!</i>
     *
     *  @param  mixed   $defaultValue   (optional) Default selected option
     *
     *  @param  array   $attributes     (optional) an array of user specified HTML attributes valid for a select box control
     *
     *                                  must be specified as an associative array of type attributeName=>attributeValue
     *
     *                                  See {@link HTMLForm_control::setAttributes()} method to see how to set HTML attributes,
     *                                  other than through the class' contructor
     *
     *                                  <i>note that the following properties are automatically set and should not
     *                                  be altered manually:</i>
     *
     *                                  <b>id</b>, <b>name</b>, <b>class</b>
     *
     *  @return void
     */
    function HTMLForm_select($controlID, $defaultValue = "", $attributes = "")
    {
    
        // call the constructor of the parent class
        parent::HTMLForm_control();
    
        // set the private attributes of this control
        // these attributes are private for this control and are for internal use only
        $this->privateAttributes = array(
            "type",
            "value",
            "options"
        );

        // set the default attributes for the textarea control
        $this->setAttributes(
            array(
                "type"  =>  "select",
                "id"    =>  str_replace(array("[", "]"), "", $controlID),
                "name"  =>  $controlID,
                "value" =>  $defaultValue,
                "class" =>  "HTMLForm-select"
            )
        );
        
        // sets user specified attributes for the table cell
        $this->setAttributes($attributes);
        
        // manage submitted value
        $this->getSubmittedValue();

    }
    
    /**
     *  Adds options to the select box control
     *
     *  <b>note that, if the "multiple" attribute is not set, the first option will be always considered as the
     *  "nothing is selected" state of the control!</b>
     *
     *  @param  array   $options    An associative array of options where the key is the value of the option and the value is
     *                              the actual text to be displayed for the option
     *
     *  @return void
     */
    function addOptions($options)
    {

        // continue only if parameter is an array
        if (is_array($options)) {

            // set the options attribute of the control
            $this->setAttributes(
                array(
                    "options"   =>  $options
                )
            );

        }
        
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

        // get the options of the select control
        $privateAttributes = $this->getAttributes(array("options", "value"));

        $optContent = "";

        // if options have been set
        if (!empty($privateAttributes["options"])) {

            // iterate through the options and get the value and the content of each
            foreach ($privateAttributes["options"] as $value => $content) {

                // create the option list
                $optContent .= "\n

                    <option value='" . $value . "' " .

                    ($privateAttributes["value"] != "" &&
                    ((is_array($privateAttributes["value"]) && in_array($value, $privateAttributes["value"])) ||
                    (!is_array($privateAttributes["value"]) && $value == $privateAttributes["value"])) ? "selected" : "") . ">" .

                    $content . "</option>";

            }


        }

        return "<select ".$this->renderAttributes().">".$optContent."\n</select>";

    }

}

?>
