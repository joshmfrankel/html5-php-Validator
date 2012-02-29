<?php

    function __autoload($class_name) {
        require_once 'classes/Validator/' . $class_name . '.php';
    }
    
    $input  = new String_Validator();
    
    $var = NULL;
    $output = $input->validate($var);

    if($output) {
        echo 'TRUE';
    } else {
        echo 'FALSE';
    }

    echo '<pre>';
    print_r($output);
    echo '</pre>';
    

?>