<?php 


session_start();

require_once("vendor/autoload.php");

use \Slim\Slim;
use \Hcode\Page;
use \Hcode\PageAdmin;
use \Hcode\PageUser;
use \Hcode\PageUser2;
use Hcode\Model\User;


 
$app = new Slim();

$app->config('debug', true);

require_once("site.php");
require_once("admin.php");
require_once("user.php");
require_once("user2.php");







$app->run();

 ?>
