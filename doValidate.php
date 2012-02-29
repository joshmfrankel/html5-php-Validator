<?php

    function __autoload($class_name) {
        require_once 'classes/Validator/class.' . $class_name . '.php';
    }
    
    $input = new Form_Input();
    //$input->start();
    
    //var_dump($input->getRawResults());
   
    
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>

    </body>
</html>
