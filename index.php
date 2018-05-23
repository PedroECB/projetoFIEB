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






$app->get('/', function() {

if(isset($_SESSION['nivel_acesso'])){
       if($_SESSION['nivel_acesso'] == 1){
     header("Location: /admin");
      exit;
  }elseif($_SESSION['nivel_acesso'] == 2){
    header("Location: /user");
      exit;
  }elseif($_SESSION['nivel_acesso'] == 3){
    header("Location: /user2");
      exit;
  }
    }

    
          $page = new Page([
            "header"=>false,
            "footer"=>false,
          ]);
          
          $page->setTpl("index");
});





$app->get('/admin', function() {
           //User::verifyAdmin(); 
         if(!isset($_SESSION['nivel_acesso']) || $_SESSION['nivel_acesso']!== "1"){
              header("Location: /login");
              exit;
            }

          $page = new PageAdmin();   
          $page->setTpl("index");
});




$app->get('/user', function() {  
     if(!isset($_SESSION['nivel_acesso']) || $_SESSION['nivel_acesso']!=="2"){
      header("Location: /login");
      exit;
     }

      $page = new PageUser();
      $page->setTpl("index");

});







$app->get('/user2', function() {  
     if(!isset($_SESSION['nivel_acesso']) || $_SESSION['nivel_acesso']!=="3"){
      header("Location: /login");
      exit;
     }

      $page = new PageUser2(); 
      $page->setTpl("index");

});










$app->get('/login', function() {

    if(isset($_SESSION['nivel_acesso'])){
       if($_SESSION['nivel_acesso'] == 1){
     header("Location: /admin");
      exit;
  }elseif($_SESSION['nivel_acesso'] == 2){
    header("Location: /user");
      exit;
  }elseif($_SESSION['nivel_acesso'] == 3){
    header("Location: /user2");
      exit;
  }
    }

    
          $page = new Page([
            "header"=>false,
            "footer"=>false,
          ]);
          
          $page->setTpl("pagelogin");

});




$app->post('/login', function() {
    
  User::login2($_POST['login'], $_POST['senha']);

  if($_SESSION['nivel_acesso'] == 1){
     header("Location: /admin");
      exit;
  }elseif($_SESSION['nivel_acesso'] == 2){
    header("Location: /user");
      exit;
  }elseif($_SESSION['nivel_acesso'] == 3){
    header("Location: /user2");
      exit;
  }

});



$app->get('/logout', function() {
    
  User::logout();
  
});










$app->run();

 ?>
