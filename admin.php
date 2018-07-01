<?php 

use \Slim\Slim;
use \Hcode\Page;
use \Hcode\PageAdmin;
use \Hcode\PageUser;
use \Hcode\PageUser2;
use Hcode\Model\User;
use Hcode\Model\Empresa;
use Hcode\Model\Visita;




$app->get('/admin', function() {
      
      User::verifyLoginAdmin(); 

      $page = new PageAdmin();   
      $page->setTpl("index");
});




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


$app->get('/admin/solicitations/:iduser/recuse', function($iduser) {  
                          
      User::verifyLoginAdmin();
     $dadosUser = User::getCadastro($iduser);
     
      User::recuseSolicitation($dadosUser[0]);
      header("Location: /admin/solicitations");
      exit;

      
});


$app->get('/admin/solicitations-info/:iduser', function($iduser) {  
                          
      User::verifyLoginAdmin();
      $user = User::getCadastro($iduser);
      

      $page = new PageAdmin();   
      $page->setTpl("solicitations-info1", array("user"=>$user[0])); 

      
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

$app->get('/admin/alter-password', function() {  
                          
      User::verifyLoginAdmin();                       
      $page = new PageAdmin();   
      $page->setTpl("alter-password");
});

$app->post('/admin/alter-password', function() {  
                          
      User::verifyLoginAdmin();
      User::alterPassword($_SESSION['idFuncionario'], $_POST);
      header("Location:/admin");
      exit;                       
});


$app->get('/admin/empresa-create', function() {  
                          
      User::verifyLoginAdmin();
     $cidades = Empresa::listCidades();
     $sindicatos = User::listSindicatos();                        
      $page = new PageAdmin();   
      $page->setTpl("empresa-create-new", array("cidades"=>$cidades, "sindicatos"=>$sindicatos));
});

$app->post('/admin/empresa-create', function() {  
                          
      User::verifyLoginAdmin();                       
      Empresa::saveEmpresa($_POST);
      header("Location: /admin/empresas");
      exit;

});

$app->get("/admin/empresas", function(){

    User::verifyLoginAdmin();
    $empresas = Empresa::listAll();
    $page = new PageAdmin();   
    $page->setTpl("list-empresas", array("empresas"=>$empresas));

});

$app->get("/admin/empresas/:idempresa", function($idempresa){

    User::verifyLoginAdmin();
    $empresa = Empresa::getFuncEmpresaSind($idempresa);
    $page = new PageAdmin();   
    $page->setTpl("empresa-info-new", array("empresa"=>$empresa[0],"origem"=>$_SESSION));

});


$app->get("/admin/agendarvisita/:idempresa", function($idempresa){

    User::verifyLoginAdmin();
    $empresa = Empresa::getFuncEmpresaSind($idempresa);
    $sindicatos = User::listSindicatos();
    $cidades = Empresa::listCidades();
    $page = new PageAdmin();   
    $page->setTpl("agendavisita-create", array("empresa"=>$empresa[0], "sindicatos"=>$sindicatos, "cidades"=>$cidades,"origem"=>$_SESSION));

});


$app->post("/admin/agendarvisita/:idempresa", function($idempresa){

    User::verifyLoginAdmin();
    Visita::SaveVisitaEmp($_POST);
    header("Location: /admin/visitas");
    exit;

});


$app->get("/admin/visitas", function(){

User::verifyLoginAdmin();
$visitas = Visita::listAll();

$page = new PageAdmin();
$page->setTpl("list-visitas", array("visitas"=>$visitas));

});


$app->get("/admin/empresa/:idempresa/delete", function($idempresa){

      User::verifyLoginAdmin();
      
     if(Empresa::removeEmpresa($idempresa)){
      header("Location: /admin/empresas");
      exit;
     };


});


$app->get("/admin/visita/create", function(){

      User::verifyLoginAdmin();
      $sindicatos = User::listSindicatos();
      $cidades = Empresa::listCidades();

      $page = new PageAdmin();
      $page->setTpl("visita-create", array("sindicatos"=>$sindicatos, "cidades"=>$cidades,"origem"=>$_SESSION));



});


$app->post("/admin/visita/create", function(){

      User::verifyLoginAdmin();
      Visita::SaveVisitaEmp2($_POST);
      header("Location: /admin/visitas");
      exit;




});
