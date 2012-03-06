<?php


    function __autoload($class_name) {
        require_once 'classes/Validator/' . $class_name . '.php';
    }
    

    $s = microtime();
    $input = new Form_Input();
    $e = microtime();

    $time = $e - $s;
    echo 'Execution in ' , $time , 'ms';

    print_r($input->getformattedErrorResults());
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
