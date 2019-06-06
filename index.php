<?php
require 'config.php';

//Also spl autoload_register take a look at it if you like
function __autoload($class){
    require LIBS . "class.$class.php";
}



$app = new Bootstrap();
/*
//Don't need this, I enabled it in the .htaccess file
ini_set('display_errors', 1); //for error reporting
ini_set('display_startup_errors', 1); //for error reporting
error_reporting(E_ALL);//for error reporting
*/