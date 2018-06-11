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

    User::verifyLoginAll();

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

    User::verifyLoginAll();
    
    $page = new Page([
      "header"=>false,
      "footer"=>false,
    ]);
    
    $page->setTpl("pagelogin");

});




$app->post('/login', function() {
    
  User::login2($_POST['login'], $_POST['senha']);
  User::verifyLoginAll();

});



$app->get('/logout', function() {
    
  User::logout();                                         #Função de logout
  exit;
});




                                     // ADMIN

                                                  //Cadastro e Exclusão de usuários









$app->get('/admin/users', function() {  
                          
      User::verifyLoginAdmin();                     
                                          # Admin Listando usuários 
      $users = User::listUsers();      

      $page = new PageAdmin();   
      $page->setTpl("users", array("users"=>$users));
});

$app->get('/admin/users/create', function() {
       
      User::verifyLoginAdmin();          
                       
                                                    #Admin Cadastrando usuários GET
      $sindicatos = User::listSindicatos();
      $page = new PageAdmin();   
      $page->setTpl("users-create", array("sindicatos"=>$sindicatos));
});


$app->post('/admin/users/create', function() {
       
  User::verifyLoginAdmin();
                                                   #Admin Cadastrando usuários POST
  $user = new User();
  $user->setData($_POST);
  $user->saveUser($_POST);

  header("Location: /admin/users");
  exit;


});










$app->get('/admin/users-focais', function() {  
                          
      User::verifyLoginAdmin();                     
                                          # Admin Listando Pontos focais
      $users = User::listFocais();      

      $page = new PageAdmin();   
      $page->setTpl("users-focais", array("users"=>$users));
});



$app->get('/admin/users-focais/create', function() {  
              
      User::verifyLoginAdmin();          
                       
                                                    #Admin Cadastrando usuários Pontos focais
      $sindicatos = User::listSindicatos();
      $page = new PageAdmin();   
      $page->setTpl("focais-create", array("sindicatos"=>$sindicatos));


});









$app->get('/admin/users/:iduser/delete', function($iduser) {
      
      User::verifyLoginAdmin();
                                  #Admin Deletando usuários
      User::deleteUser($iduser);
      header("Location: /admin/users");
      exit;
});



$app->get('/admin/users/:iduser', function($iduser) {
      
      User::verifyLoginAdmin();
                                                     #Admin Editando usuários
      $user = User::loadById($iduser);
      $page = new PageAdmin();   
      $page->setTpl("users-update3", array("user"=>$user[0]));
});


$app->post('/admin/users/:iduser', function($iduser) {
      
      User::verifyLoginAdmin();

                                                     #Admin Editando usuários
      //      $user = User::loadById($iduser);
              User::updateFocal($iduser, $_POST);
              header("Location: /admin/users");
              exit;
 
});



$app->get('/admin/solicitations', function() {  
                          
      User::verifyLoginAdmin();
     $solicitations = User::listAllSolicitations();

                                          # Admin Listando usuários 
      //$users = User::listUsers();      

      $page = new PageAdmin();   
      $page->setTpl("solicitations", array("solicitations"=>$solicitations));
});











                                                  //Cadastro e Exclusão de empresas






















$app->run();

 ?>
