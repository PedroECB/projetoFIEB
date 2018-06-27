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


$app->get("/forgot", function(){

User::verifyLoginAll();

    $page = new Page([
      "header"=>false,
      "footer"=>false,
    ]);
    
    $page->setTpl("forgot");


});

$app->post("/forgot", function(){

$user = User::getForgot($_POST['email']);

        header("Location: /forgot/sent");
        exit;

});


$app->get("/forgot/sent", function(){

  User::verifyLoginAll();

    $page = new Page([
      "header"=>false,
      "footer"=>false,
    ]);
    
    $page->setTpl("forgot-sent");

});



$app->get("/forgot/reset", function(){

 User::verifyLoginAll();

    $user = User::validForgotDecrypt($_GET['code']);

    $page = new Page([
      "header"=>false,
      "footer"=>false,
    ]);
    
    $page->setTpl("forgot-reset", array("name"=>$user['nome_func'], 
                                        "code"=>$_GET['code']));
});


$app->post("/forgot/reset", function(){

User::verifyLoginAll();

    $user = User::validForgotDecrypt($_POST['code']);

      User::setForgotUsed($user['idrecoverie']);

      User::setPassword($_POST['password'], $user['idFuncionario']);


        $page = new Page([
        "header"=>false,
        "footer"=>false,
       ]);
    
    $page->setTpl("forgot-reset-success");



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

     # Admin Listando solicitações 

      $page = new PageAdmin();   
      $page->setTpl("solicitations", array("solicitations"=>$solicitations));
});





$app->get('/admin/solicitations/:iduser/aprove', function($iduser) {  
                          
      User::verifyLoginAdmin();
     $dadosUser = User::getCadastro($iduser);
     
      User::aproveSolicitation($dadosUser[0]);

      header("Location: /admin/solicitations");
      exit;

      
});


$app->get('/admin/solicitations-info/:iduser', function($iduser) {  
                          
      User::verifyLoginAdmin();
      $user = User::getCadastro($iduser);
      

      $page = new PageAdmin();   
      $page->setTpl("solicitations-info1", array("user"=>$user[0])); 

      
});







$app->get('/user/solicitations', function() {  
                          
      User::verifyLoginUser();
      $solicitations = User::listAllSolicitationsUser($_SESSION['origem']);

      $page = new PageUser();   
      $page->setTpl("solicitations", array("solicitations"=>$solicitations));
});



$app->get('/user/solicitations/:iduser/aprove', function($iduser) {  
                          
      User::verifyLoginUser();
      $dadosUser = User::getCadastro($iduser);

    if($dadosUser[0]['origem'] == $_SESSION['origem']){

      User::aproveSolicitation($dadosUser[0]);
      header("Location: /user/solicitations");
      exit;

    }else{
        throw new \Exception('Pare de tentar burlar a desgraça',89);
    }

      
});

$app->get('/user/solicitations-info/:iduser', function($iduser) {  
                          
      User::verifyLoginUser();
      $user = User::getCadastro($iduser);
      
      if($user[0]['origem'] == $_SESSION['origem']){

        $page = new PageUser();   
        $page->setTpl("solicitationsinfo", array("user"=>$user[0])); 

      }else{
         throw new Exception('Tentativa de acesso recusada', 8);
      }

      
});












$app->get('/admin/edit-profile', function() {  
                          
      User::verifyLoginAdmin();
      $user = User::loadById($_SESSION['idFuncionario']);                         
      $page = new PageAdmin();   
      $page->setTpl("edit-profile", array("user"=>$user[0]));
});





$app->post('/admin/edit-profile', function() {  
                          
      User::verifyLoginAdmin();
      var_dump($_POST);
      User::editProfile($_POST, $_SESSION['idFuncionario']);
    
});


$app->get('/user/edit-profile', function() {  
                          
      User::verifyLoginUser();
      $user = User::loadById($_SESSION['idFuncionario']);                         
      $page = new PageUser();   
      $page->setTpl("edit-profile", array("user"=>$user[0]));
});





$app->post('/user/edit-profile', function() {  
                          
      User::verifyLoginUser();
      User::editProfile($_POST, $_SESSION['idFuncionario']);
    
});

$app->get('/user2/edit-profile', function() {  
                          
      User::verifyLoginUser2();
      $user = User::loadById($_SESSION['idFuncionario']);                         
      $page = new PageUser2();   
      $page->setTpl("edit-profile", array("user"=>$user[0]));
});





$app->post('/user2/edit-profile', function() {  
                          
      User::verifyLoginUser2();
      var_dump($_POST);
      User::editProfile($_POST, $_SESSION['idFuncionario']);
    
});







$app->get('/admin/sindicatos', function() {  
                          
      User::verifyLoginAdmin();                         
      $sindicatos = User::listSindicatos();

      $page = new PageAdmin();   
      $page->setTpl("sindicatos2", array("sindicatos"=>$sindicatos));
});


$app->get('/admin/sindicato/:idsindicato/remove', function($idsindicato) {  
                          
      User::verifyLoginAdmin();                         
      User::removeSindicato($idsindicato);
      header("Location: /admin/sindicatos");
      exit;
});



$app->get('/admin/sindicato-edit/:idsindicato', function($idsindicato) {  
                          
      User::verifyLoginAdmin();                         
      $sindicato = User::getSindicato($idsindicato);

      $page = new PageAdmin();   
      $page->setTpl("sindicato-edit", array("sindicato"=>$sindicato[0]));
});

$app->post('/admin/sindicato-edit/:idsindicato', function($idsindicato) {  
                          
      User::verifyLoginAdmin();                         
     // $sindicato = User::getSindicato($idsindicato);
      User::UpdateSindicato($idsindicato, $_POST);
      header("Location: /admin/sindicatos");
      exit;
});






$app->get('/admin/sindicatos-create', function() {  
                          
      User::verifyLoginAdmin();                         
      //$sindicatos = User::listSindicatos();

      $page = new PageAdmin();   
      $page->setTpl("sindicatos-create");
});

$app->post('/admin/sindicatos-create', function() {  
                          
      User::verifyLoginAdmin();                         
      User::saveSindicato($_POST);

      header("Location: /admin/sindicatos");
      exit;

});



$app->get('/admin/ciclos', function() {  
                          
      User::verifyLoginAdmin();

      $ciclos = User::listCiclos();                         

      $page = new PageAdmin();   
      $page->setTpl("ciclos", array("ciclos"=>$ciclos));
});

$app->get('/admin/ciclos/:idciclo', function($idciclo) {  
                          
      User::verifyLoginAdmin();

      $ciclo = User::getCiclo($idciclo);                         

      $page = new PageAdmin();   
      $page->setTpl("ciclos-edit", array("ciclo"=>$ciclo[0]));
});

$app->post('/admin/ciclos/:idciclo', function($idciclo) {  
                          
      User::verifyLoginAdmin();
      User::updateCiclo($idciclo, $_POST);
      header("Location: /admin/ciclos");
      exit;
});

$app->get('/admin/ciclos/:idciclo/remove', function($idciclo) {  
                          
      User::verifyLoginAdmin();                        
      User::deleteCiclo($idciclo);
      header("Location: /admin/ciclos");
      exit;
});


$app->get('/admin/ciclo-create', function() {  
                          
      User::verifyLoginAdmin();                       

      $page = new PageAdmin();   
      $page->setTpl("ciclo-create");
});

$app->post('/admin/ciclo-create', function() {  
                          
      User::verifyLoginAdmin();
      User::createCiclo($_POST);
      header("Location: /admin/ciclos");
      exit;
});


                                                  //Cadastro e Exclusão de empresas






















$app->run();

 ?>
