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

$app->get('/user/demandas', function() {  
                          
      User::verifyLoginUser();
      $demandas = User::listAllDemandas($_SESSION['origem']);

      $page = new PageUser();   
      $page->setTpl("list-demandas", array("demandas"=>$demandas));
});

$app->get('/user/demanda/:idDemanda/delete', function($idDemanda) {  
                          
      User::verifyLoginUser();
      User::deleteDemanda($idDemanda);
      header("Location: /user/demandas");
      exit;
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
     try{ 
          User::alterPassword($_SESSION['idFuncionario'], $_POST);
         }catch(Exception $e){

          $error ['error'] = $e->getMessage();

          $page = new PageUser();   
          $page->setTpl("alter-password", array("error"=>$error, "dados"=>$_POST));

          exit;


         }
         echo "<script> alert('Senha alterada com sucesso'); javascript:history.back(); </script>";
              exit; 
     // header("Location:/user");
                            
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

      try{                       
            Empresa::saveEmpresa($_POST);
        }catch(Exception $e){

          $error ['error'] = $e->getMessage();

          $cidades = Empresa::listCidades();
          $sindicatos = User::listSindicatos();                        
          $page = new PageUser();   
          $page->setTpl("empresa-create-new", array("cidades"=>$cidades, "sindicatos"=>$sindicatos, "error"=>$error, "dados"=>$_POST));
          exit;
        }

      header("Location: /user/empresas/origem");
      exit;

});







/*$app->get("/user/empresas", function(){

    User::verifyLoginUser();
    $empresas = Empresa::listAll();
    $page = new PageUser();   
    $page->setTpl("list-empresas", array("empresas"=>$empresas));

});
*/



$app->get("/user/empresas", function(){

    User::verifyLoginUser();

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
        'href'=>'/user/empresas?'.http_build_query([
          'page'=>$x+1,
          'search'=>$search
        ]),
        'text'=>$x+1
      ]);
    }

    $page = new PageUser();   
    $page->setTpl("list-empresas", 
                array("empresas"=>$pagination['data'],
                      "search"=>$search,
                      "pages"=>$pages));

});


/*

$app->get("/user/empresas/origem", function(){

    $origem = $_SESSION['origem'];

    User::verifyLoginUser();
    $empresas = Empresa::listAllOrigem($origem);
    $page = new PageUser();   
    $page->setTpl("list-empresas-search", array("empresas"=>$empresas, "search"=>'',
                      "pages"=>[]));
    

});*/

$app->get("/user/empresas/origem", function(){

    User::verifyLoginUser();

    $origem = $_SESSION['origem'];

    

    $search = (isset($_GET['search'])) ? $_GET['search']:"";
    $page = (isset($_GET['page'])) ? (int) $_GET['page']: 1;

    if($search != ''){

      $pagination = Empresa::getPageSearchOrigem($origem ,$search, $page);


    }else{

       $pagination = Empresa::getPageOrigem($origem, $page);

    }

   
    $pages = [];

    for($x=0; $x < $pagination['pages']; $x++){

      array_push($pages, [
        'href'=>'/user/empresas/origem?'.http_build_query([
          'page'=>$x+1,
          'search'=>$search
        ]),
        'text'=>$x+1
      ]);
    }

    $page = new PageUser();   
    $page->setTpl("list-empresas-search", 
                array("empresas"=>$pagination['data'],
                      "search"=>$search,
                      "pages"=>$pages,
                      "origemS"=>$_SESSION['origem']));

});









$app->get("/user/empresas/:idempresa", function($idempresa){

    User::verifyLoginUser();

    $empresa = Empresa::getFuncEmpresaSind($idempresa);
    $page = new PageUser();   
    $page->setTpl("empresa-info-new", array("empresa"=>$empresa[0],"origem"=>$_SESSION));

});

$app->get("/user/empresa-edit/:idempresa", function($idempresa){

  User::verifyLoginUser();
  $empresa = Empresa::getFuncEmpresaSind($idempresa);
  $sindicatos = User::listSindicatos();
  $cidades = Empresa::listCidades();
  $page = new PageUser();   
  $page->setTpl("empresa-edit-new", array("empresa"=>$empresa[0],"origem"=>$_SESSION, "sindicatos"=>$sindicatos, "cidades"=>$cidades));


});

$app->post("/user/empresa-edit/:idempresa", function($idempresa){

  User::verifyLoginUser();
  $dadosEmpresa = Empresa::getEmpresa($idempresa);
try{
  if($dadosEmpresa[0]['origem_cadastro'] == $_SESSION['origem']){
        Empresa::editar($_POST, $idempresa);

        header("Location: /user/empresas/$idempresa");
        exit;

      }else{
        throw new \Exception('Não foi possível alterar os dados da empresa.',58995);
      }
    }catch(\Exception $e){

         $error ['error'] = $e->getMessage();

         $empresa = Empresa::getEmpresa($idempresa);
         $sindicatos = User::listSindicatos();
         $cidades = Empresa::listCidades();

         $page = new PageUser();
         $page->setTpl("empresa-edit-new", array("sindicatos"=>$sindicatos, "cidades"=>$cidades,"origem"=>$_SESSION, "error"=>$error, "dados"=>$_POST));
         exit;

    } 



});




$app->get("/user/agendarvisita/:idempresa", function($idempresa){

    User::verifyLoginUser();
    $empresa = Empresa::getFuncEmpresaSind($idempresa);
    $sindicatos = User::listSindicatos();
    $cidades = Empresa::listCidades();
    $page = new PageUser();   
    $page->setTpl("agendavisita-create", array("empresa"=>$empresa[0], "sindicatos"=>$sindicatos, "cidades"=>$cidades,"origem"=>$_SESSION));

});


$app->post("/user/agendarvisita/:idempresa", function($idempresa){

    User::verifyLoginUser();

  try{
      Visita::SaveVisitaEmp($_POST);
  }catch(Exception $e){
  
    $error ['error'] = $e->getMessage();

    $empresa = Empresa::getFuncEmpresaSind($idempresa);
    $sindicatos = User::listSindicatos();
    $cidades = Empresa::listCidades();
    $page = new PageUser();   
    $page->setTpl("agendavisita-create", array("empresa"=>$empresa[0], "sindicatos"=>$sindicatos, "cidades"=>$cidades,"origem"=>$_SESSION, "error"=>$error, "dados"=>$_POST));
    exit;

  }



    header("Location: /user/origem/visitas");
    exit;

});

/*$app->get("/user/visitas", function(){

User::verifyLoginUser();
$visitas = Visita::listAll();

$page = new PageUser();
$page->setTpl("list-visitas", array("visitas"=>$visitas));

});

$app->get("/user/empresa/:idempresa/delete", function($idempresa){

      User::verifyLoginUser();
      
     if(Empresa::removeEmpresa($idempresa)){
      header("Location: /user/empresas/origem");
      exit;
     };


});*/

$app->get("/user/visitas", function(){

  User::verifyLoginUser();

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
    'href'=>'/user/visitas?'.http_build_query([
      'page'=>$x+1,
      'search'=>$search
    ]),
    'text'=>$x+1
  ]);
}

$page = new PageUser();
$page->setTpl("list-visitas", array("visitas"=>$pagination['data'], "search"=>$search, "pages"=>$pages, "origem"=>$_SESSION['origem']));

});




$app->get("/user/visita/create", function(){

      User::verifyLoginUser();
      $sindicatos = User::listSindicatos();
      $cidades = Empresa::listCidades();

      $page = new PageUser();
      $page->setTpl("visita-create", array("sindicatos"=>$sindicatos, "cidades"=>$cidades,"origem"=>$_SESSION));



});

$app->post("/user/visita/create", function(){

      User::verifyLoginUser();
    try{
        Visita::SaveVisitaEmp2($_POST);
    }catch(Exception $e){

         $error ['error'] = $e->getMessage();

         $sindicatos = User::listSindicatos();
         $cidades = Empresa::listCidades();

         $page = new PageUser();
         $page->setTpl("visita-create", array("sindicatos"=>$sindicatos, "cidades"=>$cidades,"origem"=>$_SESSION, "error"=>$error, "dados"=>$_POST));
         exit;
    }


      header("Location: /user/origem/visitas");
      exit;

});


$app->get("/user/visitas-info/:idvisita", function($idvisita){

      User::verifyLoginUser();

      $visita = Visita::getVisita($idvisita);


      $page = new PageUser();
      $page->setTpl("visita-info", array("visita"=>$visita[0],"origem"=>$_SESSION));

});

$app->get("/user/edit-visita/:idvisita", function($idvisita){

      User::verifyLoginUser();
      $visita = Visita::getVisita($idvisita);
      $sindicatos = User::listSindicatos();


      $page = new PageUser();
      $page->setTpl("visita-edit", array("visita"=>$visita[0],"origem"=>$_SESSION, "sindicatos"=>$sindicatos));

});

$app->post("/user/edit-visita/:idvisita", function($idvisita){

     User::verifyLoginUser();
     if(Visita::atualizaVisita($_POST)){
       $idvisita = $_POST['idVisita'];
      
      echo "<script> alert('Visita Alterada com Sucesso'); javascript:history.back(); </script>";
      
      exit;

     };
  });


 $app->get("/user/finalize-visita/:idvisita", function($idvisita){

      User::verifyLoginUser();
      $visita = Visita::getVisita($idvisita);
      $sindicatos = User::listSindicatos();

      $page = new PageUser();
      $page->setTpl("finalize-visita01", array("visita"=>$visita[0],"origem"=>$_SESSION, "sindicatos"=>$sindicatos));
    

});


 $app->post("/user/finalize-visita/:idvisita", function($idvisita){

      User::verifyLoginUser();
      $visita = Visita::getVisita($idvisita);
      $sindicatos = User::listSindicatos();
      Visita::finalizeVisita($_POST);
      header("Location: /user/visitas-info/$idvisita");
      exit;
      
    

});



/*$app->get("/user/origem/visitas", function(){

  $origem = $_SESSION['origem'];

    User::verifyLoginUser();
    $visitas = Visita::listAllOrigem($origem);

    $page = new PageUser();
    $page->setTpl("list-visitas", array("visitas"=>$visitas));

});*/

$app->get("/user/origem/visitas", function(){

  User::verifyLoginUser();

  $origem = $_SESSION['origem'];

$search = (isset($_GET['search']))? $_GET['search']:'';
$page = (isset($_GET['page'])) ? (int)$_GET['page']: 1;

if($search != ''){

  $pagination = Visita::getPageSearchOrigem($origem, $search, $page);

}else{

  $pagination = Visita::getPageOrigem($origem, $page);  
}




$pages = [];

for($x=0;$x < $pagination['pages']; $x++){

  array_push($pages, [
    'href'=>'/user/origem/visitas?'.http_build_query([
      'page'=>$x+1,
      'search'=>$search
    ]),
    'text'=>$x+1
  ]);
}

$page = new PageUser();
$page->setTpl("list-visitas-origem", array("visitas"=>$pagination['data'], "search"=>$search, "pages"=>$pages, "origem"=>$_SESSION['origem']));

});







 $app->get("/user/relatorio-sindicato/", function(){

      User::verifyLoginUser();
     $nome = $_SESSION['origem']; //Sindicato::getNomeSindicato($idSindicato);

     $dadosSindicato = ['nome_sindicato'=>$nome];

     $dadosEmpresas = Sindicato::contEmpresas($nome);
     $dadosVisitas = Sindicato::contVisitas($nome);



      
      $page = new PageUser();
      $page->setTpl("sind-relat1", array("dadosSindicato"=>$dadosSindicato,
                                         "dadosEmpresas"=>$dadosEmpresas[0],
                                         "dadosVisitas"=>$dadosVisitas[0]));

      

});

 

  $app->get("/user/relatorio-casa/", function(){

      User::verifyLoginUser();
      $nome =  $_SESSION['origem'];
      
      $dadosCasa = ['nome_casa'=>$nome];
      

      $dadosEmpresas = Casa::contEmpresas($nome);
      $dadosVisitas = Casa::contVisitas($nome);

   
      $page = new PageUser();
      $page->setTpl("casa-relat", array("dadosCasa"=>$dadosCasa, 
                                        "dadosEmpresas"=>$dadosEmpresas[0],
                                        "dadosVisitas"=>$dadosVisitas[0]));
    

}); 


$app->get('/user/ciclos-relat/', function() {  
                          
      User::verifyLoginUser();

      $ciclos = User::listCiclos();                         

      $page = new PageUser();   
      $page->setTpl("ciclos-relat", array("ciclos"=>$ciclos));
});


$app->get('/user/ciclo-relat-sind/:idciclo', function($idciclo) {  
                          
       User::verifyLoginUser();
       $nome = $_SESSION['origem']; //Sindicato::getNomeSindicato($idSindicato);

       $ciclo = User::getCiclo($idciclo);

       $dadosSindicato = ['nome_sindicato'=>$nome];

       // $dadosEmpresas = Sindicato::contEmpresas($nome);
       // $dadosVisitas = Sindicato::contVisitas($nome);

       $dadosEmpresas = Sindicato::contEmpresasCiclo($nome, $idciclo, $ciclo);
       $dadosVisitas = Sindicato::contVisitasCiclo($nome, $idciclo, $ciclo);



        
        $page = new PageUser();
        $page->setTpl("sind-relat1-ciclo", array("dadosSindicato"=>$dadosSindicato,
                                           "dadosEmpresas"=>$dadosEmpresas[0],
                                           "dadosVisitas"=>$dadosVisitas[0],
                                           "ciclo"=>$ciclo[0]));
});


$app->get('/user/ciclo-relat-casa/:idciclo', function($idciclo) {  
                          
      User::verifyLoginUser();
      $nome =  $_SESSION['origem'];

      $ciclo = User::getCiclo($idciclo);
      
      $dadosCasa = ['nome_casa'=>$nome];
      

      // $dadosEmpresas = Casa::contEmpresas($nome);
      // $dadosVisitas = Casa::contVisitas($nome);

      $dadosEmpresas = Casa::contEmpresasCiclo($nome, $idciclo, $ciclo);
      $dadosVisitas = Casa::contVisitasCiclo($nome, $idciclo, $ciclo);

   
      $page = new PageUser();
      $page->setTpl("casa-relat-ciclo", array("dadosCasa"=>$dadosCasa, 
                                        "dadosEmpresas"=>$dadosEmpresas[0],
                                        "dadosVisitas"=>$dadosVisitas[0],
                                        "ciclo"=>$ciclo[0]));
});


$app->get("/user/contatos", function(){

  User::verifyLoginUser();
  $contatos = User::listContatos();
  $contatos2 = User::listContatos2();

  $page = new PageUser();
  $page->setTpl('contatos', array("contatos"=>$contatos, "contatos2"=>$contatos2, "session"=>$_SESSION));

});


$app->get("/user/contatos-create", function(){

  User::verifyLoginUser();

  $page = new PageUser();
  $page->setTpl('contato-create');

});

$app->get("/user/contatos/:idcontato/remove", function($idcontato){

   User::verifyLoginUser();

  $dadosContato = User::getContato((int)$idcontato);

  if($dadosContato[0]['id_funcionario'] == $_SESSION['idFuncionario']){

      User::removeContato($idcontato);

  }else{
    throw new \Exception('Falha ao remover contato', 8899996);
  }

  header("Location: /user/contatos");
  exit;

});


$app->post("/user/contatos-create", function(){

  User::verifyLoginUser();
  User::saveContato($_POST);

  header("Location: /user/contatos");
  exit;

});

$app->get("/:idcontato/user/contatos", function($idcontato){

  User::verifyLoginUser();
  $dadosContato = User::getContato((int)$idcontato);

  $page = new PageUser();
  $page->setTpl('contato-info', array("dadosContato"=>$dadosContato[0]));

});


$app->get("/user/empresas-ciclo-atual", function(){

  User::verifyLoginUser();
  $cicloAtual = User::getCicloAtual();

  $origem = $_SESSION['origem'];

    

    $search = (isset($_GET['search'])) ? $_GET['search']:"";
    $page = (isset($_GET['page'])) ? (int) $_GET['page']: 1;

    if($search != ''){

      $pagination = Empresa::getPageSearchOrigemCiclo($cicloAtual, $origem ,$search, $page);


    }else{

       $pagination = Empresa::getPageOrigemCiclo($cicloAtual, $origem, $page);

    }

   
    $pages = [];

    for($x=0; $x < $pagination['pages']; $x++){

      array_push($pages, [
        'href'=>'/user/empresas-ciclo-atual?'.http_build_query([
          'page'=>$x+1,
          'search'=>$search
        ]),
        'text'=>$x+1
      ]);
    }

    $page = new PageUser();   
    $page->setTpl("list-empresas-ciclo", 
                array("empresas"=>$pagination['data'],
                      "search"=>$search,
                      "pages"=>$pages,
                      "origemS"=>$_SESSION['origem']));



});

$app->get('/user/users/create', function() {
       
      User::verifyLoginUser();          
                       
                                                    #Admin Cadastrando usuários GET
      $sindicatos = User::listSindicatos();
      $page = new PageUser();   
      $page->setTpl("users-create", array("sindicatos"=>$sindicatos));
});


$app->post('/user/users/create', function() {
       
  User::verifyLoginUser();
                                                   #Admin Cadastrando usuários POST
  $user = new User();
  $user->setData($_POST);

  try{
      $user->saveUser($_POST);
  }catch(Exception $e){

      $error['error'] = $e->getMessage();

      $sindicatos = User::listSindicatos();
      $page = new PageUser();   
      $page->setTpl("users-create", array("sindicatos"=>$sindicatos, "error"=>$error, "dados"=>$_POST));
      exit;

  }
      $sucesso['sucesso'] = 'Usuário cadastrado com sucesso!';
      $sindicatos = User::listSindicatos();
      $page = new PageUser();   
      $page->setTpl("users-create", array("sindicatos"=>$sindicatos, "sucesso"=>$sucesso));
      exit;
  
  // header("Location: /user/users/create");
  // exit;



});


$app->get('/user/export-visitas-geral', function(){

    User::verifyLoginUser();
    $visitas = Visita::listAll();
    Visita::exportVisitasGeral($visitas);

    header("Location: /user/visitas");
    exit;

});

$app->get('/user/export-visitas-origem', function(){

    $origem = $_SESSION['origem'];

    User::verifyLoginUser();
    $visitas = Visita::listAllOrigem($origem);
    Visita::exportVisitasOrigem($visitas);

    header("Location: /user/origem/visitas");
    exit;

});


$app->get('/user/export-empresas-geral', function(){

    User::verifyLoginUser();
    $empresas = Empresa::listAll();
    
    Empresa::exportEmpresasGeral($empresas);
    exit;

    header("Location: /user/empresas");
    exit;

});



$app->get('/user/export-empresas-origem-cicloAtual', function(){

    $origem = $_SESSION['origem'];

    User::verifyLoginUser();

    $cicloAtual = User::getCicloAtual();
    $empresas = Empresa::listAllCicloAtualOrigem($cicloAtual, $origem);

    Empresa::exportEmpresasCicloAtualOrigem($empresas);
    

    header("Location: /user/empresas-ciclo-atual");
    exit;

});


$app->get('/user/exportempresas-origem', function(){

    $origem = $_SESSION['origem'];

    User::verifyLoginUser();

    $empresas = Empresa::listAllOrigem($origem);
    Empresa::exportEmpresasOrigem($empresas);
    exit;
    //Empresa::exportEmpresasCicloAtualOrigem($empresas);
    

    header("Location: /user/empresas-ciclo-atual");
    exit;

});