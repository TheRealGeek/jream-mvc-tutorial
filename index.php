<?php
//use an autoloader! //he mentioned spl autoloader is a good one
require 'libs/class.bootstrap.php';
require 'libs/class.controller.php';
require 'libs/class.model.php';
require 'libs/class.view.php';

//Library
require 'libs/class.database.php';
require 'libs/class.session.php';
require 'libs/class.hash.php';


require 'config/paths.php';
require 'config/database.php';
require 'config/constants.php';


$app = new Bootstrap();
/*
//Don't need this, I enabled it in the .htaccess file
ini_set('display_errors', 1); //for error reporting
ini_set('display_startup_errors', 1); //for error reporting
error_reporting(E_ALL);//for error reporting
*/