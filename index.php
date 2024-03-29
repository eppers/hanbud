<?php 

session_start();
//$_SESSION['user_id']=1;

require './lib/Slim/Slim.php';
require './lib/Admin_class.php';
require './lib/Slim/LogWriter.php';
require './lib/twigView_class.php';
require_once './lib/Twig/Autoloader.php';
require './lib/Paris/idiorm.php';
require './lib/Paris/paris.php';
require './lib/functions.php';

require 'conf.php';

// Models

require './models/Menu.php';
require './models/Category.php';
require './models/Subcategory.php';
require './models/Product.php';

require './models/Site.php';
require './models/Foto.php';
require './models/Image.php';


Twig_Autoloader::register();
$app = new Slim(array(
    'view' => 'twigView',
    'debug' => true,
    'log.enabled' => true,
    'templates.path' => './template',
    'log.writer' => new LogWriter()
    
));

$admin = new Admin();
$admin->app=$app;

require './app/routes/session.php';
require './app/routes/admin.php';

$app->run();

?>


