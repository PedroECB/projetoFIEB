<?php 

require_once("vendor/autoload.php");

use \Slim\Slim;
use \Hcode\Page;
use \Hcode\PageAdmin;
use \Hcode\PageUser;


$app = new Slim();

$app->config('debug', true);

$app->get('/', function() {
    
	$page = new Page();
  $page->setTpl("index");
  
});





$app->get('/admin', function() {
    
  $page = new PageAdmin();
  
  $page->setTpl("index");

});


$app->get('/user', function() {
    
  $page = new PageUser();
  
  $page->setTpl("index");

});


$app->get('/login', function() {
    
  $page = new Page([
    "header"=>false,
    "footer"=>false,
  ]);
  
  $page->setTpl("pagelogin");

});





$app->run();

 ?>
