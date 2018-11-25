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
     try{ 
          User::alterPassword($_SESSION['idFuncionario'], $_POST);
         }catch(Exception $e){

          $error ['error'] = $e->getMessage();

          $page = new PageUser2();   
          $page->setTpl("alter-password", array("error"=>$error, "dados"=>$_POST));

          exit;


         }
         echo "<script> alert('Senha alterada com sucesso'); javascript:history.back(); </script>";
              exit; 
     // header("Location:/user");
                            
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

      try{                       
            Empresa::saveEmpresa($_POST);
        }catch(Exception $e){

          $error ['error'] = $e->getMessage();

          $cidades = Empresa::listCidades();
          $sindicatos = User::listSindicatos();                        
          $page = new PageUser2();   
          $page->setTpl("empresa-create-new", array("cidades"=>$cidades, "sindicatos"=>$sindicatos, "error"=>$error, "dados"=>$_POST));
          exit;
        }

      header("Location: /user2/empresas/origem");
      exit;

});










/*$app->get("/user2/empresas", function(){

    User::verifyLoginUser2();
    $empresas = Empresa::listAll();
    $page = new PageUser2();   
    $page->setTpl("list-empresas", array("empresas"=>$empresas));

});*/

$app->get("/user2/empresas", function(){

    User::verifyLoginUser2();

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
        'href'=>'/user2/empresas?'.http_build_query([
          'page'=>$x+1,
          'search'=>$search
        ]),
        'text'=>$x+1
      ]);
    }

    $page = new PageUser2();   
    $page->setTpl("list-empresas", 
                array("empresas"=>$pagination['data'],
                      "search"=>$search,
                      "pages"=>$pages));

});



/*$app->get("/user2/empresas/origem", function(){

    $origem = $_SESSION['origem'];

    User::verifyLoginUser2();
    $empresas = Empresa::listAllOrigem($origem);

    $page = new PageUser2();   
    $page->setTpl("list-empresas-search", array("empresas"=>$empresas, "search"=>'',
                      "pages"=>[]));
    

});*/


$app->get("/user2/empresas/origem", function(){

    User::verifyLoginUser2();

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
        'href'=>'/user2/empresas/origem?'.http_build_query([
          'page'=>$x+1,
          'search'=>$search
        ]),
        'text'=>$x+1
      ]);
    }

    $page = new PageUser2();   
    $page->setTpl("list-empresas-search", 
                array("empresas"=>$pagination['data'],
                      "search"=>$search,
                      "pages"=>$pages,
                      "origemS"=>$_SESSION['origem']));

});






$app->get("/user2/empresas/:idempresa", function($idempresa){

    User::verifyLoginUser2();
    $empresa = Empresa::getFuncEmpresaSind($idempresa);
    $page = new PageUser2();   
    $page->setTpl("empresa-info-new", array("empresa"=>$empresa[0],"origem"=>$_SESSION));

});

$app->get("/user2/empresa-edit/:idempresa", function($idempresa){

  User::verifyLoginUser2();
  $empresa = Empresa::getFuncEmpresaSind($idempresa);
  $sindicatos = User::listSindicatos();
  $cidades = Empresa::listCidades();
  $page = new PageUser2();   
  $page->setTpl("empresa-edit-new", array("empresa"=>$empresa[0],"origem"=>$_SESSION, "sindicatos"=>$sindicatos, "cidades"=>$cidades));


});

$app->post("/user2/empresa-edit/:idempresa", function($idempresa){

  User::verifyLoginUser2();
  $dadosEmpresa = Empresa::getEmpresa($idempresa);
try{
  if($dadosEmpresa[0]['origem_cadastro'] == $_SESSION['origem']){
        Empresa::editar($_POST, $idempresa);

        header("Location: /user2/empresas/$idempresa");
        exit;

      }else{
        throw new \Exception('Não foi possível alterar os dados da empresa.',58995);
      }
    }catch(\Exception $e){

         $error ['error'] = $e->getMessage();

         $empresa = Empresa::getEmpresa($idempresa);
         $sindicatos = User::listSindicatos();
         $cidades = Empresa::listCidades();

         $page = new PageUser2();
         $page->setTpl("empresa-edit-new", array("sindicatos"=>$sindicatos, "cidades"=>$cidades,"origem"=>$_SESSION, "error"=>$error, "dados"=>$_POST));
         exit;

    } 



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

  try{
      Visita::SaveVisitaEmp($_POST);
  }catch(Exception $e){
  
    $error ['error'] = $e->getMessage();

    $empresa = Empresa::getFuncEmpresaSind($idempresa);
    $sindicatos = User::listSindicatos();
    $cidades = Empresa::listCidades();
    $page = new PageUser2();   
    $page->setTpl("agendavisita-create", array("empresa"=>$empresa[0], "sindicatos"=>$sindicatos, "cidades"=>$cidades,"origem"=>$_SESSION, "error"=>$error, "dados"=>$_POST));
    exit;

  }



    header("Location: /user2/origem/visitas");
    exit;

});







/*$app->get("/user2/visitas", function(){

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


});*/

$app->get("/user2/visitas", function(){

  User::verifyLoginUser2();

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
    'href'=>'/user2/visitas?'.http_build_query([
      'page'=>$x+1,
      'search'=>$search
    ]),
    'text'=>$x+1
  ]);
}

$page = new PageUser2();
$page->setTpl("list-visitas", array("visitas"=>$pagination['data'], "search"=>$search, "pages"=>$pages, "origem"=>$_SESSION['origem']));

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
    try{
        Visita::SaveVisitaEmp2($_POST);
    }catch(Exception $e){

         $error ['error'] = $e->getMessage();

         $sindicatos = User::listSindicatos();
         $cidades = Empresa::listCidades();

         $page = new PageUser2();
         $page->setTpl("visita-create", array("sindicatos"=>$sindicatos, "cidades"=>$cidades,"origem"=>$_SESSION, "error"=>$error, "dados"=>$_POST));
         exit;
    }


      header("Location: /user/origem/visitas");
      exit;

});








$app->get("/user2/visitas-info/:idvisita", function($idvisita){

      User::verifyLoginUser2();

      $visita = Visita::getVisita($idvisita);


      $page = new PageUser2();
      $page->setTpl("visita-info", array("visita"=>$visita[0],"origem"=>$_SESSION));

});


$app->get("/user2/edit-visita/:idvisita", function($idvisita){

      User::verifyLoginUser2();
      $visita = Visita::getVisita($idvisita);
      $sindicatos = User::listSindicatos();


      $page = new PageUser2();
      $page->setTpl("visita-edit", array("visita"=>$visita[0],"origem"=>$_SESSION, "sindicatos"=>$sindicatos));

});


$app->post("/user2/edit-visita/:idvisita", function($idvisita){

     User::verifyLoginUser2();
     if(Visita::atualizaVisita($_POST)){
       $idvisita = $_POST['idVisita'];
      
      echo "<script> alert('Visita Alterada com Sucesso'); javascript:history.back(); </script>";
      
      exit;

     };
  });


 $app->get("/user2/finalize-visita/:idvisita", function($idvisita){

      User::verifyLoginUser2();
      $visita = Visita::getVisita($idvisita);
      $sindicatos = User::listSindicatos();

      $page = new PageUser2();
      $page->setTpl("finalize-visita01", array("visita"=>$visita[0],"origem"=>$_SESSION, "sindicatos"=>$sindicatos));
    

});


 $app->post("/user2/finalize-visita/:idvisita", function($idvisita){

      User::verifyLoginUser2();
      $visita = Visita::getVisita($idvisita);
      $sindicatos = User::listSindicatos();
      Visita::finalizeVisita($_POST);
      header("Location: /user2/visitas-info/$idvisita");
      exit;
      
    

});

 $app->get("/user2/relatorio-sindicato/", function(){

      User::verifyLoginUser2();
     $nome = $_SESSION['origem']; //Sindicato::getNomeSindicato($idSindicato);

     $dadosSindicato = ['nome_sindicato'=>$nome];

     $dadosEmpresas = Sindicato::contEmpresas($nome);
     $dadosVisitas = Sindicato::contVisitas($nome);



      
      $page = new PageUser2();
      $page->setTpl("sind-relat1", array("dadosSindicato"=>$dadosSindicato,
                                         "dadosEmpresas"=>$dadosEmpresas[0],
                                         "dadosVisitas"=>$dadosVisitas[0]));

      

});


   $app->get("/user2/relatorio-casa/", function(){

      User::verifyLoginUser2();
      $nome =  $_SESSION['origem'];
      
      $dadosCasa = ['nome_casa'=>$nome];
      

      $dadosEmpresas = Casa::contEmpresas($nome);
      $dadosVisitas = Casa::contVisitas($nome);

   
      $page = new PageUser2();
      $page->setTpl("casa-relat", array("dadosCasa"=>$dadosCasa, 
                                        "dadosEmpresas"=>$dadosEmpresas[0],
                                        "dadosVisitas"=>$dadosVisitas[0]));
    

});



















/*$app->get("/user2/origem/visitas", function(){

  $origem = $_SESSION['origem'];

    User::verifyLoginUser2();
    $visitas = Visita::listAllOrigem($origem);

    $page = new PageUser2();
    $page->setTpl("list-visitas", array("visitas"=>$visitas));

});

*/

$app->get("/user2/origem/visitas", function(){

  User::verifyLoginUser2();

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
    'href'=>'/user2/origem/visitas?'.http_build_query([
      'page'=>$x+1,
      'search'=>$search
    ]),
    'text'=>$x+1
  ]);
}

$page = new PageUser2();
$page->setTpl("list-visitas-origem", array("visitas"=>$pagination['data'], "search"=>$search, "pages"=>$pages, "origem"=>$_SESSION['origem']));

});



$app->get('/user2/ciclos-relat/', function() {  
                          
      User::verifyLoginUser2();

      $ciclos = User::listCiclos();                         

      $page = new PageUser2();   
      $page->setTpl("ciclos-relat", array("ciclos"=>$ciclos));
});


$app->get('/user2/ciclo-relat-sind/:idciclo', function($idciclo) {  
                          
       User::verifyLoginUser2();
       $nome = $_SESSION['origem']; //Sindicato::getNomeSindicato($idSindicato);

       $ciclo = User::getCiclo($idciclo);

       $dadosSindicato = ['nome_sindicato'=>$nome];

       // $dadosEmpresas = Sindicato::contEmpresas($nome);
       // $dadosVisitas = Sindicato::contVisitas($nome);

       $dadosEmpresas = Sindicato::contEmpresasCiclo($nome, $idciclo, $ciclo);
       $dadosVisitas = Sindicato::contVisitasCiclo($nome, $idciclo, $ciclo);



        
        $page = new PageUser2();
        $page->setTpl("sind-relat1-ciclo", array("dadosSindicato"=>$dadosSindicato,
                                           "dadosEmpresas"=>$dadosEmpresas[0],
                                           "dadosVisitas"=>$dadosVisitas[0],
                                           "ciclo"=>$ciclo[0]));
});


$app->get('/user2/ciclo-relat-casa/:idciclo', function($idciclo) {  
                          
      User::verifyLoginUser2();
      $nome =  $_SESSION['origem'];

      $ciclo = User::getCiclo($idciclo);
      
      $dadosCasa = ['nome_casa'=>$nome];
      

      // $dadosEmpresas = Casa::contEmpresas($nome);
      // $dadosVisitas = Casa::contVisitas($nome);

      $dadosEmpresas = Casa::contEmpresasCiclo($nome, $idciclo, $ciclo);
      $dadosVisitas = Casa::contVisitasCiclo($nome, $idciclo, $ciclo);

   
      $page = new PageUser2();
      $page->setTpl("casa-relat-ciclo", array("dadosCasa"=>$dadosCasa, 
                                        "dadosEmpresas"=>$dadosEmpresas[0],
                                        "dadosVisitas"=>$dadosVisitas[0],
                                        "ciclo"=>$ciclo[0]));
});


$app->get("/user2/contatos", function(){

  User::verifyLoginUser2();
  $contatos = User::listContatos();
  $contatos2 = User::listContatos2();

  $page = new PageUser2();
  $page->setTpl('contatos', array("contatos"=>$contatos, "contatos2"=>$contatos2, "session"=>$_SESSION));

});

$app->get("/:idcontato/user2/contatos", function($idcontato){

  User::verifyLoginUser2();
  $dadosContato = User::getContato((int)$idcontato);

  $page = new PageUser2();
  $page->setTpl('contato-info', array("dadosContato"=>$dadosContato[0]));

});


$app->get("/user2/contatos-create", function(){

  User::verifyLoginUser2();

  $page = new PageUser2();
  $page->setTpl('contato-create');

});

$app->get("/user2/contatos/:idcontato/remove", function($idcontato){

  User::verifyLoginUser2();

  $dadosContato = User::getContato((int)$idcontato);

  if($dadosContato[0]['id_funcionario'] == $_SESSION['idFuncionario']){

      User::removeContato($idcontato);

  }else{
    throw new \Exception('Falha ao remover contato', 8899996);
  }

  header("Location: /user2/contatos");
  exit;

});


$app->post("/user2/contatos-create", function(){

  User::verifyLoginUser2();
  User::saveContato($_POST);

  header("Location: /user2/contatos");
  exit;

});

$app->get("/user2/empresas-ciclo-atual", function(){

  User::verifyLoginUser2();
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
        'href'=>'/user2/empresas-ciclo-atual?'.http_build_query([
          'page'=>$x+1,
          'search'=>$search
        ]),
        'text'=>$x+1
      ]);
    }

    $page = new PageUser2();   
    $page->setTpl("list-empresas-ciclo", 
                array("empresas"=>$pagination['data'],
                      "search"=>$search,
                      "pages"=>$pages,
                      "origemS"=>$_SESSION['origem']));



});

$app->get('/user2/export-visitas-geral', function(){

    User::verifyLoginUser2();
    $visitas = Visita::listAll();
    Visita::exportVisitasGeral($visitas);

    header("Location: /user2/visitas");
    exit;

});


$app->get('/user2/export-visitas-origem', function(){

    $origem = $_SESSION['origem'];

    User::verifyLoginUser2();
    $visitas = Visita::listAllOrigem($origem);
    Visita::exportVisitasOrigem($visitas);

    header("Location: /user2/origem/visitas");
    exit;

});


$app->get('/user2/export-empresas-geral', function(){

    User::verifyLoginUser2();
    $empresas = Empresa::listAll();
    
    Empresa::exportEmpresasGeral($empresas);
    exit;

    header("Location: /user2/empresas");
    exit;

});


$app->get('/user2/export-empresas-origem-cicloAtual', function(){

    $origem = $_SESSION['origem'];

    User::verifyLoginUser2();

    $cicloAtual = User::getCicloAtual();
    $empresas = Empresa::listAllCicloAtualOrigem($cicloAtual, $origem);

    Empresa::exportEmpresasCicloAtualOrigem($empresas);
    

    header("Location: /user2/empresas-ciclo-atual");
    exit;

});

$app->get('/user2/exportempresas-origem', function(){

    $origem = $_SESSION['origem'];

    User::verifyLoginUser2();

    $empresas = Empresa::listAllOrigem($origem);
    Empresa::exportEmpresasOrigem($empresas);
    exit;
    //Empresa::exportEmpresasCicloAtualOrigem($empresas);
    

    header("Location: /user2/empresas-ciclo-atual");
    exit;

});