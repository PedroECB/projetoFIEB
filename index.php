<?php 

session_cache_expire(1);
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
      
      User::verifyLoginAdmin(); 

      $page = new PageAdmin();   
      $page->setTpl("index");
});




$app->get('/user', function() {  
     
    User::verifyLoginUser();

    $page = new PageUser();
    $page->setTpl("index");

});







$app->get('/user2', function() {  
     
     User::verifyLoginUser2();

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

  if($_SESSION['nivel_acesso'] == 1){                         #Página de Login
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
    
  User::logout();                                         #Função de logout
  
});



                


                               // ADMIN

                                                  //Cadastro e Exclusão de usuários



$app->get('/admin/users', function() {  
                          
if(!isset($_SESSION['nivel_acesso']) || $_SESSION['nivel_acesso']!== "1"){
    header("Location: /login");
    exit;                                               
   }                        
                                          # Admin Listando usuários 
      $users = User::listUsers();      

      $page = new PageAdmin();   
      $page->setTpl("users", array("users"=>$users));
});





$app->get('/admin/users/create', function() {
       
if(!isset($_SESSION['nivel_acesso']) || $_SESSION['nivel_acesso']!== "1"){
    header("Location: /login");
    exit;                                        #Admin Cadastrando usuários
  }
      $sindicatos = User::listSindicatos();
      $page = new PageAdmin();   
      $page->setTpl("users-create", array("sindicatos"=>$sindicatos));
});


$app->post('/admin/users/create', function() {
       
if(!isset($_SESSION['nivel_acesso']) || $_SESSION['nivel_acesso']!== "1"){
    header("Location: /login");
    exit;                                        #Admin Cadastrando usuários
  }

  $user = new User();
  $user->setData($_POST);
  $user->saveUser($_POST);

  header("Location: /admin/users");
  exit;


});





$app->get('/admin/users/:iduser/delete', function($iduser) {
      
if(!isset($_SESSION['nivel_acesso']) || $_SESSION['nivel_acesso']!== "1"){
    header("Location: /login");
    exit;                                     #Admin Deletando usuários
   }

      $page = new PageAdmin();   
      $page->setTpl("users-update");
});



$app->get('/admin/users/:iduser', function($iduser) {
      
if(!isset($_SESSION['nivel_acesso']) || $_SESSION['nivel_acesso']!== "1"){
    header("Location: /login");
    exit;                                     #Admin Editando usuários
   }
      $user = User::loadById($iduser);
      $page = new PageAdmin();   
      $page->setTpl("users-update3", array("user"=>$user[0]));
});

                                                  //Cadastro e Exclusão de empresas






















$app->run();

 ?>
