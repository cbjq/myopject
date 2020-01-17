<?php
spl_autoload_register(
    function($class_name){
        if(is_file('./include/'.$class_name.'.php')){
            require './include/'.$class_name.'.php';
        }else{
            require '../include/'.$class_name.'.php';
        }
    
}
);