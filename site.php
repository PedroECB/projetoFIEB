<?php 


use \Slim\Slim;
use \Hcode\Page;
use \Hcode\PageAdmin;
use \Hcode\PageUser;
use \Hcode\PageUser2;
use Hcode\Model\User;




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

try{
    $user = User::getForgot($_POST['email']);
}catch(Exception $e){

    $error ['error'] = $e->getMessage();

       $page = new Page([
      "header"=>false,
      "footer"=>false,
    ]);
    
    $page->setTpl("forgot", array("error"=>$error, "post"=>$_POST));
    exit;

}

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



$app->get('/login', function() {

    User::verifyLoginAll();
    
    $page = new Page([
      "header"=>false,
      "footer"=>false,
    ]);
    
    $page->setTpl("pagelogin");

});




$app->post('/login', function() {
  
  try{
       User::login2($_POST['login'], $_POST['senha']);
      
      }catch(Exception $e){

        /*$dados [0]['email'] = $_POST['email'];*/
        $erro ['error'] = $e->getMessage();
        $page = new Page([
          "header"=>false,
          "footer"=>false,
        ]);
        $page->setTpl("pagelogin", array("error"=>$erro,"dados"=>$_POST));
        exit;

      }

  User::verifyLoginAll();

});



$app->get('/logout', function() {
    
  User::logout();                                         #Função de logout
  exit;
});



$app->get('/register', function() {

    User::verifyLoginAll();
    $sindicatos = User::listSindicatos();
    
    $page = new Page([
      "header"=>false,
      "footer"=>false,
    ]);
    
    $page->setTpl("register", array("sindicatos"=>$sindicatos));

});


$app->post('/register', function() {

  try{
      User::verifyLoginAll();
      User::registerUser($_POST);
    }catch(Exception $e){

        $erro ['error'] = $e->getMessage();
        $sindicatos = User::listSindicatos();
        $page = new Page([
          "header"=>false,
          "footer"=>false,
        ]);
        $page->setTpl("register", array("error"=>$erro,"dados"=>$_POST, "sindicatos"=>$sindicatos));
        exit;

      }

    header("Location: /register/completed");
    exit;

});


$app->get('/register/completed', function() {

    User::verifyLoginAll();
    
    $page = new Page([
      "header"=>false,
      "footer"=>false,
    ]);
    
    $page->setTpl("completed");

});

