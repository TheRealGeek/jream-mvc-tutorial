<?

//use an autoloader!
//he mentioned spl autoloader
require 'libs/class.bootstrap.php';
require 'libs/class.controller.php';
require 'libs/class.view.php';
require 'libs/class.model.php';

require 'config/paths.php';
require 'config/database.php';

$app = new Bootstrap();
