<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
  <title>datepicker test</title>
  </head>
  <body>
<?php
    // requires the class
    require "../class.datepicker.php";
    
    // instantiate the object
    $db=new datepicker();
    
    // uncomment the next line to have the calendar show up in german
    //$db->language = "german";
    
    // set the selectable range
    $db->selectableRange = array(
        // allow dates to be selected starting from tomorow and the following 10 days
        mktime()=>strtotime("+10 days", mktime()),
        // and also, starting 14 days from tomorrow allow another 5 days
        strtotime("+14 days", mktime())=>strtotime("+5 days", strtotime("+14 days", mktime()))
    );
    // users will not be able to select dates outside those ranges

    // set the first day of week to Monday
    // users from the United States will set this to 0 (Sunday)
    $db->firstDayOfWeek = 1;

    // set the format in which the date to be returned
    $db->dateFormat = "m/d/Y";
?>

    <input type="text" id="date">
    <input type="button" value="Click to open the date picker" onclick="<?=$db->show("date")?>">

  </body>
</html>
