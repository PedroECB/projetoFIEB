<?php 


use \Slim\Slim;
use \Hcode\Page;
use \Hcode\PageAdmin;
use \Hcode\PageUser;
use \Hcode\PageUser2;
use Hcode\Model\User;
use Hcode\Model\Empresa;
use Hcode\Model\Visita;









$app->get('/user2', function() {  
     
     User::verifyLoginUser2();

    $page = new PageUser2(); 
    $page->setTpl("index");

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




$app->get('/user2/alter-password', function() {  
                          
      User::verifyLoginUser2();                       
      $page = new PageUser2();   
      $page->setTpl("alter-password");
});

$app->post('/user2/alter-password', function() {  
                          
      User::verifyLoginUser2();
      User::alterPassword($_SESSION['idFuncionario'], $_POST);
      header("Location:/user2");
      exit;                       
});


$app->get('/user2/empresa-create', function() {  
                          
      User::verifyLoginUser2();
     $cidades = Empresa::listCidades();
     $sindicatos = User::listSindicatos();                        
      $page = new PageUser2();   
      $page->setTpl("empresa-create-new", array("cidades"=>$cidades, "sindicatos"=>$sindicatos));
});

$app->post('/user2/empresa-create', function() {  
                          
      User::verifyLoginUser2();                       
      Empresa::saveEmpresa($_POST);
      header("Location: /user2/empresas/origem");
      exit;

});

$app->get("/user2/empresas", function(){

    User::verifyLoginUser2();
    $empresas = Empresa::listAll();
    $page = new PageUser2();   
    $page->setTpl("list-empresas", array("empresas"=>$empresas));

});

$app->get("/user2/empresas/origem", function(){

    $origem = $_SESSION['origem'];

    User::verifyLoginUser2();
    $empresas = Empresa::listAllOrigem($origem);
    $page = new PageUser2();   
    $page->setTpl("list-empresas", array("empresas"=>$empresas));
    

});


$app->get("/user2/empresas/:idempresa", function($idempresa){

    User::verifyLoginUser2();
    $empresa = Empresa::getFuncEmpresaSind($idempresa);
    $page = new PageUser2();   
    $page->setTpl("empresa-info-new", array("empresa"=>$empresa[0],"origem"=>$_SESSION));

});

$app->get("/user2/agendarvisita/:idempresa", function($idempresa){

    User::verifyLoginUser2();
    $empresa = Empresa::getFuncEmpresaSind($idempresa);
    $sindicatos = User::listSindicatos();
    $cidades = Empresa::listCidades();
    $page = new PageUser2();   
    $page->setTpl("agendavisita-create", array("empresa"=>$empresa[0], "sindicatos"=>$sindicatos, "cidades"=>$cidades,"origem"=>$_SESSION));

});

$app->post("/user2/agendarvisita/:idempresa", function($idempresa){

    User::verifyLoginUser2();
    Visita::SaveVisitaEmp($_POST);
    header("Location: /user2/visitas");
    exit;

});

$app->get("/user2/visitas", function(){

User::verifyLoginUser2();
$visitas = Visita::listAll();

$page = new PageUser2();
$page->setTpl("list-visitas", array("visitas"=>$visitas));

});

$app->get("/user2/empresa/:idempresa/delete", function($idempresa){

      User::verifyLoginUser2();
      
     if(Empresa::removeEmpresa($idempresa)){
      header("Location: /user2/empresas");
      exit;
     };


});



$app->get("/user2/visita/create", function(){

      User::verifyLoginUser2();
      $sindicatos = User::listSindicatos();
      $cidades = Empresa::listCidades();

      $page = new PageUser2();
      $page->setTpl("visita-create", array("sindicatos"=>$sindicatos, "cidades"=>$cidades,"origem"=>$_SESSION));



});


$app->post("/user2/visita/create", function(){

      User::verifyLoginUser2();
      Visita::SaveVisitaEmp2($_POST);
      header("Location: /user2/visitas");
      exit;




});
