<?php


    function __autoload($class_name) {
        require_once 'classes/Validator/' . $class_name . '.php';
    }
    

    $s = microtime();
    $input = new Form_Input();
    //$input->start();
    $e = microtime();

    $time = $e - $s;
    echo 'Execution in ' , $time , 'ms';


    var_dump($input->getRawResults());
   
    
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
