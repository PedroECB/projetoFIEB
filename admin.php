<?php 

use \Slim\Slim;
use \Hcode\Page;
use \Hcode\PageAdmin;
use \Hcode\PageUser;
use \Hcode\PageUser2;
use Hcode\Model\User;
use Hcode\Model\Empresa;
use Hcode\Model\Visita;
use Hcode\Model\Sindicato;
use Hcode\Model\Casa;




$app->get('/admin', function() {
      
      User::verifyLoginAdmin(); 

      $page = new PageAdmin();   
      $page->setTpl("index");
});




$app->get('/admin/users', function() {  
                          
      User::verifyLoginAdmin();                     
                                          # Admin Listando usuários 

      $search = (isset($_GET['search'])) ? $_GET['search']: "";
      $page = (isset($_GET['page'])) ? (int) $_GET['page']: 1;

      if($search != ''){

          $pagination = User::getPageSearch($search, $page);

      }else{

          $pagination = User::getPage($page);
      }

    

      $pages = [];

      for($x = 0; $x < $pagination['pages']; $x++){

        array_push($pages, [
          'href'=>'/admin/users?'.http_build_query([
            'page'=>$x+1,
            'search'=>$search
          ]),
          'text'=>$x+1
        ]);

      }      

      $page = new PageAdmin();   
      $page->setTpl("users", array(
        "users"=>$pagination['data'],
        "search"=>$search,
        "pages"=>$pages
      ));
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

  try{
      $user->saveUser($_POST);
  }catch(Exception $e){

      $error['error'] = $e->getMessage();

      $sindicatos = User::listSindicatos();
      $page = new PageAdmin();   
      $page->setTpl("users-create", array("sindicatos"=>$sindicatos, "error"=>$error, "dados"=>$_POST));
      exit;

  }


  header("Location: /admin/users");
  exit;


});




$app->get('/admin/users-focais', function() {  
                          
      User::verifyLoginAdmin();                     
                                          # Admin Listando Pontos focais
       $search = (isset($_GET['search'])) ? $_GET['search']: "";
      $page = (isset($_GET['page'])) ? (int) $_GET['page']: 1;

      if($search != ''){

          $pagination = User::getPageSearchFocais($search, $page);

      }else{

          $pagination = User::getPageFocais($page);
      }

    

      $pages = [];

      for($x = 0; $x < $pagination['pages']; $x++){

        array_push($pages, [
          'href'=>'/admin/users-focais?'.http_build_query([
            'page'=>$x+1,
            'search'=>$search
          ]),
          'text'=>$x+1
        ]);

      }



      //$users = User::listFocais();      

      $page = new PageAdmin();   
      $page->setTpl("users-focais", array(
        "users"=>$pagination['data'],
        "search"=>$search,
        "pages"=>$pages
      ));
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
      $solicitations = User::listAllSolicitations();
   
   try{
        User::aproveSolicitation($dadosUser[0]);    
    }catch(Exception $e){

      echo $e->getMessage();
      exit;      

    }
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
     try{ 
          User::alterPassword($_SESSION['idFuncionario'], $_POST);
         }catch(Exception $e){

          $error ['error'] = $e->getMessage();

          $page = new PageAdmin();   
          $page->setTpl("alter-password", array("error"=>$error, "dados"=>$_POST));

          exit;


         }
          
      echo "<script> alert('Senha alterada com sucesso'); javascript:history.back(); </script>";
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

      try{                       
            Empresa::saveEmpresa($_POST);
        }catch(Exception $e){

          $error ['error'] = $e->getMessage();

          $cidades = Empresa::listCidades();
          $sindicatos = User::listSindicatos();                        
          $page = new PageAdmin();   
          $page->setTpl("empresa-create-new", array("cidades"=>$cidades, "sindicatos"=>$sindicatos, "error"=>$error, "dados"=>$_POST));
          exit;
        }

      header("Location: /admin/empresas");
      exit;

});


$app->get('/admin/report-error', function() {  
                          
      User::verifyLoginAdmin();

      $page = new PageAdmin();   
      $page->setTpl("report");
});

$app->post('/admin/report-error', function() {  
                          
      User::verifyLoginAdmin();
      User::reportError($_POST);

      echo "<script> alert('Erro reportado com sucesso, em breve solucionaremos o problema. Obrigado pela contribuição!'); javascript:history.back();</script>";
      exit;
});







$app->get("/admin/empresas", function(){

    User::verifyLoginAdmin();

    $search = (isset($_GET['search'])) ? $_GET['search']:"";
    $page = (isset($_GET['page'])) ? (int) $_GET['page']: 1;

    if($search != ''){

      $pagination = Empresa::getPageSearch($search, $page);


    }else{

       $pagination = Empresa::getPage($page);

    }

   
    $pages = [];

    for($x=0; $x < $pagination['pages']; $x++){

      array_push($pages, [
        'href'=>'/admin/empresas?'.http_build_query([
          'page'=>$x+1,
          'search'=>$search
        ]),
        'text'=>$x+1
      ]);
    }

    $page = new PageAdmin();   
    $page->setTpl("list-empresas", 
                array("empresas"=>$pagination['data'],
                      "search"=>$search,
                      "pages"=>$pages));

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

  try{
      Visita::SaveVisitaEmp($_POST);
  }catch(Exception $e){
  
    $error ['error'] = $e->getMessage();

    $empresa = Empresa::getFuncEmpresaSind($idempresa);
    $sindicatos = User::listSindicatos();
    $cidades = Empresa::listCidades();
    $page = new PageAdmin();   
    $page->setTpl("agendavisita-create", array("empresa"=>$empresa[0], "sindicatos"=>$sindicatos, "cidades"=>$cidades,"origem"=>$_SESSION, "error"=>$error, "dados"=>$_POST));
    exit;

  }



    header("Location: /admin/visitas");
    exit;

});




$app->get("/admin/visitas", function(){

  User::verifyLoginAdmin();

$search = (isset($_GET['search']))? $_GET['search']:'';
$page = (isset($_GET['page'])) ? (int)$_GET['page']: 1;

if($search != ''){

  $pagination = Visita::getPageSearch($search, $page);

}else{

  $pagination = Visita::getPage($page);  
}




$pages = [];

for($x=0;$x < $pagination['pages']; $x++){

  array_push($pages, [
    'href'=>'/admin/visitas?'.http_build_query([
      'page'=>$x+1,
      'search'=>$search
    ]),
    'text'=>$x+1
  ]);
}

$page = new PageAdmin();
$page->setTpl("list-visitas", array("visitas"=>$pagination['data'], "search"=>$search, "pages"=>$pages));

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
    try{
        Visita::SaveVisitaEmp2($_POST);
    }catch(Exception $e){

         $error ['error'] = $e->getMessage();

         $sindicatos = User::listSindicatos();
         $cidades = Empresa::listCidades();

         $page = new PageAdmin();
         $page->setTpl("visita-create", array("sindicatos"=>$sindicatos, "cidades"=>$cidades,"origem"=>$_SESSION, "error"=>$error, "dados"=>$_POST));
         exit;
    }


      header("Location: /admin/visitas");
      exit;

});



$app->get("/admin/visitas-info/:idvisita", function($idvisita){

      User::verifyLoginAdmin();

      $visita = Visita::getVisita($idvisita);


      $page = new PageAdmin();
      $page->setTpl("visita-info", array("visita"=>$visita[0],"origem"=>$_SESSION));

});

$app->get("/admin/edit-visita/:idvisita", function($idvisita){

      User::verifyLoginAdmin();
      $visita = Visita::getVisita($idvisita);
      $sindicatos = User::listSindicatos();


      $page = new PageAdmin();
      $page->setTpl("visita-edit", array("visita"=>$visita[0],"origem"=>$_SESSION, "sindicatos"=>$sindicatos));

});


$app->post("/admin/edit-visita/:idvisita", function($idvisita){

     User::verifyLoginAdmin();
     if(Visita::atualizaVisita($_POST)){
       $idvisita = $_POST['idVisita'];
      
      echo "<script> alert('Visita Alterada com Sucesso'); javascript:history.back(); </script>";
      
      exit;

     };
  });




 $app->get("/admin/finalize-visita/:idvisita", function($idvisita){

      User::verifyLoginAdmin();
      $visita = Visita::getVisita($idvisita);
      $sindicatos = User::listSindicatos();

      $page = new PageAdmin();
      $page->setTpl("finalize-visita01", array("visita"=>$visita[0],"origem"=>$_SESSION, "sindicatos"=>$sindicatos));
    

});



$app->post("/admin/finalize-visita/:idvisita", function($idvisita){

      User::verifyLoginAdmin();
      $visita = Visita::getVisita($idvisita);
      $sindicatos = User::listSindicatos();
      Visita::finalizeVisita($_POST);
      header("Location: /admin/visitas-info/$idvisita");
      exit;
      
    

}); 



 $app->get("/admin/relatorios/sindicatos", function(){

      User::verifyLoginAdmin();
      $sindicatos = User::listSindicatos();

      $page = new PageAdmin();
      $page->setTpl("list-sindicatos-relat", array("origem"=>$_SESSION, "sindicatos"=>$sindicatos));
    

});   
     

 $app->get("/admin/relatorio-sindicato/:idSindicato", function($idSindicato){

      User::verifyLoginAdmin();
     $nome = Sindicato::getNomeSindicato($idSindicato);

     $dadosSindicato = ['nome_sindicato'=>$nome];

     $dadosEmpresas = Sindicato::contEmpresas($nome);
     $dadosVisitas = Sindicato::contVisitas($nome);



      
      $page = new PageAdmin();
      $page->setTpl("sind-relat1", array("dadosSindicato"=>$dadosSindicato,
                                         "dadosEmpresas"=>$dadosEmpresas[0],
                                         "dadosVisitas"=>$dadosVisitas[0]));

    
    

});



  $app->get("/admin/relatorio-casa/", function(){

      User::verifyLoginAdmin();
      $casas = User::listCasas();

      $page = new PageAdmin();
      $page->setTpl("list-casas-relat", array("casas"=>$casas));
    

});


  $app->get("/admin/relatorio-casa/:idcasa", function($idcasa){

      User::verifyLoginAdmin();
      $nome = Casa::getNomeCasa($idcasa);
      
      $dadosCasa = ['nome_casa'=>$nome];
      

      $dadosEmpresas = Casa::contEmpresas($nome);
      $dadosVisitas = Casa::contVisitas($nome);

   
      $page = new PageAdmin();
      $page->setTpl("casa-relat", array("dadosCasa"=>$dadosCasa, 
                                        "dadosEmpresas"=>$dadosEmpresas[0],
                                        "dadosVisitas"=>$dadosVisitas[0]));
    

});
  





