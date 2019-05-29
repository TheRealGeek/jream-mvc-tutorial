<?php
ini_set('display_errors', 1); //for error reporting
ini_set('display_startup_errors', 1);//for error reporting
error_reporting(E_ALL);//for error reporting
//use an autoloader!
//he mentioned spl autoloader
require 'libs/class.bootstrap.php';
require 'libs/class.controller.php';
require 'libs/class.database.php';
require 'libs/class.model.php';
require 'libs/class.view.php';

require 'config/paths.php';
require 'config/database.php';


$app = new Bootstrap();
