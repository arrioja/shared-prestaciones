<?php

/**
 *  A generic class that all the form's controls extend
 *
 *  @author     Stefan Gabos <ix@nivelzero.ro>
 *  @copyright  (c) 2006 Stefan Gabos
 *  @package    HTMLForm_Controls
 */
class HTMLForm_control
{

    /**
     *  Array of HTML attributes of the element
     *
     *  @var array
     *
     *  @access private
     */
    var $attributes;

    /**
     *  Array of HTML attributes that control's renderProperties() method should skip
     *
     *  @access private
     */
    var $privateAttributes;

    /**
     *  Array of validation rules set for the element
     *
     *  @access private
     */
    var $rules;

    /**
     *  Constructor of the class
     *
     *  @return void
     *
     *  @access private
     */
    function HTMLForm_control()
    {
    
        // Sets default values of the class' properties
        // We need to do it this way for the variables to have default values PHP 4
        
        $this->attributes = array();
        $this->privateAttributes = array();
        $this->rules = array();

    }
    
    /**
     *  Sets one or more HTML attributes of the control
     *
     *  <code>
     *  /*
     *  create a text field named "name"
     *  (notice the use of the "&" symbol -> it's how we make it work in PHP 4, too!)
     *  {@*}
     *
     *  $obj = & $form->add("text", "name");
     *
     *  /*
     *  set some HTML attributes for the text control
     *  more specifically set it's "size" attribute to 2
     *  and it's "readonly" attribute
     *  {@*}
     *
     *  $obj->setAttributes(array("size"=>2, "readonly"=>"readonly"));
     *  </code>
     *
     *  @param  array   $attributes     An associative array of type attributeName=>attributeValue
     *
     *  @return void
     */
    function setAttributes($attributes)
    {

        // check if $attributes is given as an array
        if (is_array($attributes)) {
        
            // iterate through the given attributes array
            foreach ($attributes as $attribute=>$value) {
            
                // add attribute to attributes array
                $this->attributes[$attribute] = $value;
                
            }
            
        }
        
    }
    
    /**
     *  Returns the values of requested HTML attributes of the control
     *
     *  <code>
     *  /*
     *  create a text field named "name"
     *  (notice the use of the "&" symbol -> it's how we make it work in PHP 4, too!)
     *  {@*}
     *
     *  $obj = & $form->add("text", "name");
     *
     *  /*
     *  set some HTML attributes for the text control
     *  more specifically set it's "size" attribute to 2
     *  and it's "readonly" attribute
     *  {@*}
     *
     *  $obj->setAttributes(array("size"=>2, "readonly"=>"readonly"));
     *
     *  /*
     *  now read the attributes
     *  {@*}
     *
     *  $attributes = $obj->getAttributes(array("size", "readonly"));
     *
     *  /*
     *  The result will be an associative array
     *
     *  $attributes = Array(
     *      [size]      => 2,
     *      [readonly]  => "readonly"
     *  )
     *  {@*}
     *  </code>
     *
     *  @param  mixed   $attributes     The name of a single HTML attribute or an array of names representing HTML attributes
     *                                  of which values' to be returned
     *
     *  @return array   Returns an associative array of type attributeName=>attributeValue where the array's keys are the requested
     *                  attributes' names and the array's values are each key's respective value
     */
    function getAttributes($attributes)
    {
    
        // initialize the array that will be returned
        $result = array();

        // if the argument is an array
        if (is_array($attributes)) {
        
            // iterate through the array
            foreach ($attributes as $attribute) {
            
                // if attribute exists
                if (array_key_exists($attribute, $this->attributes)) {
                
                    // populate the $result array
                    $result[$attribute] = $this->attributes[$attribute];
                    
                }
                
            }
            
        // if the argument is a string
        } else {
        
            // if attribute exists
            if (array_key_exists($attributes, $this->attributes)) {
            
                // populate the $result array
                $result[$attributes] = $this->attributes[$attributes];

            }
            
        }
        
        // return the results
        return $result;

    }
    
    /**
     *  Converts the array with control's attributes to valid HTML markup interpreted by the {@link toHTML()} method
     *
     *  <i>Note that this method skips {@link $privateCellAttributes}</i>
     *
     *  @return array   Returns an associative array with a single item where the key is the word "attributes"
     *                  and the value is the resulted string
     *
     *  @access private
     */
    function renderAttributes()
    {
    
        // the string to be returned
        $attributes = "";
        
        // iterates through the control's attributes
        foreach ($this->attributes as $attribute=>$value) {
        
            if (
                // if there are no private attributes set for the class
                !isset($this->privateAttributes) ||
                // or attribute not in array of private attributes
                !@in_array($attribute, $this->privateAttributes)
            ) {
        
                // add attribute=>value pair to the return string
                $attributes .= ($attributes != "" ? " " : "") . $attribute . "=\"" . $value . "\"";
                
            }
        
        }
        
        // returns string
        return $attributes;
    
    }

    /**
     *  Sets validation rules for the control
     *
     *  Here are the available rules:
     *
     *      -   <b>mandatory</b>
     *
     *          Specified as "mandatory"=>array($errorMessage, $errorMessageContainerBlock)
     *
     *          Validates only if the control has a value
     *
     *          Available for {@link HTMLForm_checkbox}, {@link HTMLForm_password}, {@link HTMLForm_radio}, {@link HTMLForm_select},
     *          {@link HTMLForm_text}, {@link HTMLForm_textarea}
     *
     *          <code>
     *          $obj->setRule("mandatory"=>array("This field is required", "errorBlock1"));
     *          </code>
     *
     *      -   <b>minlength</b>
     *
     *          Specified as "minlength"=>array($minimumLength, $errorMessage, $errorMessageContainerBlock)
     *
     *          Validates only if entered text's length is greater than $minimumLength
     *
     *          Available for {@link HTMLForm_password}, {@link HTMLForm_text}, {@link HTMLForm_textarea}
     *
     *          <code>
     *          $obj->setRule("minlength"=>array("6", "6 characters is minimum!", "errorBlock1"));
     *          </code>
     *
     *      -   <b>maxlength</b>
     *
     *          Specified as "maxlength"=>array($maximumLength, $errorMessage, $errorMessageContainerBlock)
     *
     *          Validates only if entered text's length is shorter than $maximumLength
     *
     *          Available for {@link HTMLForm_password}, {@link HTMLForm_text}, {@link HTMLForm_textarea}
     *
     *          <code>
     *          $obj->setRule("maxlength"=>array("12", "12 Characters is maximum", "errorBlock1"));
     *          </code>
     *
     *      -   <b>email</b>
     *
     *          Specified as "email"=>array($errorMessage, $errorMessageContainerBlock)
     *
     *          Validates only if entered text is a valid email address
     *
     *          Available for {@link HTMLForm_password}, {@link HTMLForm_text}, {@link HTMLForm_textarea}
     *
     *          <code>
     *          $obj->setRule("mandatory"=>array("Not a valid email address!", "errorBlock1"));
     *          </code>
     *
     *      -   <b>digitsonly</b>
     *
     *          Specified as "digitsonly"=>array($errorMessage, $errorMessageContainerBlock)
     *
     *          Validates only if entered characters are all digits
     *
     *          Available for {@link HTMLForm_password}, {@link HTMLForm_text}, {@link HTMLForm_textarea}
     *
     *          <code>
     *          $obj->setRule("digitsonly"=>array("Only numbers allowed!", "errorBlock1"));
     *          </code>
     *
     *      -   <b>compare</b>
     *
     *          Specified as "compare"=>array($controlIDToCompareWith, $errorMessage, $errorMessageContainerBlock)
     *
     *          Validates only control's value is equal with the value of the control indicated by $controlIDToCompareWith
     *
     *          Useful for when you want to check password confirmation
     *
     *          Available for {@link HTMLForm_password}, {@link HTMLForm_text}, {@link HTMLForm_textarea}
     *
     *          <code>
     *          $obj->setRule("compare"=>array("password", "Password not confirmed correctly!", "errorBlock1"));
     *          </code>
     *
     *      -   <b>custom</b>
     *
     *          This rule allows you to define custom rules.
     *
     *          It must be specified as
     *          "custom"=>array($callbackFunctionName, [optional arguments to be passed to the function], $errorMessage, $errorMessageContainerBlock)
     *
     *          <b>Note that the custom function's first parameter will ALWAYS be the control's submitted value and the optional arguments
     *          to be passed to the function will start as of second argument!</b>
     *
     *          <b>Also note that the custom validation function MUST return TRUE on success or FALSE on failure!</b>
     *
     *          <code>
     *          /*
     *              custom function that checks if a control's value is equal
     *              to a defined value
     *          {@*}
     *          function textIs($controlsSubmittedValue, $valueToCompareTo)
     *          {
     *              if ($controlsSubmittedValue != $valueToCompareTo) {
     *                  return false;
     *              }
     *              return true;
     *          }
     *
     *          /*
     *              add a text box control to the form
     *          {@*}
     *          $obj = & $form->add("text", "control_id");
     *
     *          /*
     *              set the custom rule which will compare weather the text box control's submitted value
     *              is 'admin' and display the error message in specified error block if is not
     *          {@*}
     *          $obj->setRule("custom"=>array("textIs", "admin", "errorBlock", "Text must be 'admin'!"));
     *
     *          </code>
     *
     *  @param  array   $rules  An associative array
     *
     *                          See above how it needs to be specified for each rule
     *
     *  @return void
     */
    function setRule($rules)
    {

        // continue only if argument is an array
        if (is_array($rules)) {
        
            // iterate through the given rules
            foreach ($rules as $ruleName => $ruleProperties) {

                // append the rule and rule's properties to the rules array
                $this->rules[$ruleName] = $ruleProperties;
                
                switch (strtolower($ruleName)) {

                    case "digitsonly":

                        $this->setAttributes(array("onkeypress"=>"return digitsOnly(event)"));
                        
                        break;
                        
                    case "maxlength":
                    
                        //$this->setAttributes(array("maxlength"=>$ruleProperties[0]));
                        
                        break;

                }
                
            }

        }
        
    }
    
    /**
     *  Gets submitted value of the control and makes this value the "preselected" value of the control
     *
     *  @return void
     *
     *  @access private
     */
    function getSubmittedValue()
    {
    
        // get the form's name submission method
        global $HTMLForm_method, $HTMLForm_name;
        
        // get some attributes of the control
        $attribute = $this->getAttributes(array("name", "type", "value"));
        
        // strip any [] from the control's name (usually used in conjunciton with multi-select select box-es and checkboxes)
        $attribute["name"] = preg_replace("/\[\]/", "", $attribute["name"]);
        
        if (
            // if form was submitted
            eval("return isset(\$_".$HTMLForm_method."[\"HTMLForm_formname\"]);") &&
            eval("return \$_".$HTMLForm_method."[\"HTMLForm_formname\"] == '".$HTMLForm_name."';")
        ) {
        
            if (
                // if control was submitted
                // note that we have @ in front of it as some controls are not submitted when the
                // form they are in is (i.e unchecked checkboxes)
                @eval("return isset(\$_".$HTMLForm_method."[\"".$attribute["name"]."\"]);")
            ) {

                // create the submittedValue property for the control and assign to it the submitted value of the control
                $this->submittedValue = eval("return \$_".$HTMLForm_method."[\"".$attribute["name"]."\"];");

            } else {

                // we set this for those controls that are not submitted even when the form they reside in is
                // (i.e. unchecked checkboxes) so that we know that they were indeed submitted but they just don't have a value
                $this->submittedValue = false;
                
            }

        }

        // if control was submitted
        if (isset($this->submittedValue)) {
        
            // the assignment of the submitted value is type dependant
            switch ($attribute["type"]) {

                // if control is a checkbox
                case "checkbox":

                    if (

                        // if is submitted value is an array
                        (is_array($this->submittedValue) &&
                        // and the checbox's value is in the array
                        in_array($attribute["value"], $this->submittedValue))
                        //or
                        ||
                        // assume submitted value is not an array and the
                        // checkbox's value is the same as the submitted value
                        ($attribute["value"] == $this->submittedValue)
                        
                    ) {

                        // set the "checked" attribute of the control
                        $this->setAttributes(array("checked"=>"checked"));

                    }

                    break;
                    
                // if control is a radio button
                case "radio":
                

                    if (
                    
                        // if the radio button's value is the same as the submitted value
                        ($attribute["value"] == $this->submittedValue)
                        
                    ) {

                        // set the "checked" attribute of the control
                        $this->setAttributes(array("checked"=>"checked"));

                    }

                    break;

                // if control is a select box
                case "select":

                    // set the "value" private attribute of the control
                    // the attribute will be handled by the HTMLForm_select::renderAttributes() method
                    $this->setAttributes(array("value"=>$this->submittedValue));

                    break;

                // if control is a file upload control, a hidden control, a password field, a text field or a textarea control
                case "file":
                case "hidden":
                case "password":
                case "text":
                case "textarea":

                    // set the "value" standard HTML attribute of the control
                    $this->setAttributes(array("value"=>$this->submittedValue));

                    break;

            }
            
        }
            
    }

}

?>
