<?php 

use \Slim\Slim;
use \Hcode\Page;
use \Hcode\PageAdmin;
use \Hcode\PageUser;
use \Hcode\PageUser2;
use Hcode\Model\User;
use Hcode\Model\Empresa;







$app->get('/user', function() {  
     
    User::verifyLoginUser();

    $page = new PageUser();
    $page->setTpl("index");

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


$app->get('/user/solicitations/:iduser/recuse', function($iduser) {  
                          
      User::verifyLoginUser();
      $dadosUser = User::getCadastro($iduser);

    if($dadosUser[0]['origem'] == $_SESSION['origem']){

      User::recuseSolicitation($dadosUser[0]);
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



$app->get('/user/alter-password', function() {  
                          
      User::verifyLoginUser();                       
      $page = new PageUser();   
      $page->setTpl("alter-password");
});

$app->post('/user/alter-password', function() {  
                          
      User::verifyLoginUser();
      User::alterPassword($_SESSION['idFuncionario'], $_POST);
      header("Location:/user");
      exit;                       
});

$app->get('/user/empresa-create', function() {  
                          
      User::verifyLoginUser(); 
    $cidades = Empresa::listCidades();
    $sindicatos = User::listSindicatos(); 

      $page = new PageUser();   
      $page->setTpl("empresa-create-new", array("cidades"=>$cidades, "sindicatos"=>$sindicatos));
});

$app->post('/user/empresa-create', function() {  
                          
      User::verifyLoginUser();                       
      Empresa::saveEmpresa($_POST);
      header("Location: /user/empresas");
      exit;

});

$app->get("/user/empresas", function(){

    User::verifyLoginUser();
    $empresas = Empresa::listAll();
    $page = new PageUser();   
    $page->setTpl("list-empresas", array("empresas"=>$empresas));

});

$app->get("/user/empresas/:idempresa", function($idempresa){

    User::verifyLoginUser();
    $empresa = Empresa::getFuncEmpresaSind($idempresa);
    $page = new PageUser();   
    $page->setTpl("empresa-info-new", array("empresa"=>$empresa[0]));

});

$app->get("/user2/empresas/:idempresa", function($idempresa){

    User::verifyLoginUser2();
    $empresa = Empresa::getFuncEmpresaSind($idempresa);
    $page = new PageUser2();   
    $page->setTpl("empresa-info-new", array("empresa"=>$empresa[0]));

});
