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


