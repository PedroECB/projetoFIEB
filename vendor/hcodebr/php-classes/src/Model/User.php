<?php 

namespace Hcode\Model;
use \Hcode\DB\Sql;
use \Hcode\Model;

class User extends Model{

  private $idFuncionario;
  private $nome_func;
  private $email;
  private $senha;
  private $nivel_acesso;
  private $origem;
  private $cargo;



                                                     #Login 2




  public static function login2($login, $senha){

      $sql = new Sql();
      $results = $sql->select("SELECT * FROM funcionario WHERE email =:LOGIN", array(
      ":LOGIN"=>$login
    ));

      if(count($results) === 0){

      throw new \Exception('Usuário inexistente ou senha inválida');

    }

    $data = $results[0];

    if(password_verify($senha, $data['senha'])){
       
      $_SESSION['timeSession'] = time()+120;

       $user = new User();
       $user->setIdFuncionario($data['idFuncionario']);
       $user->setNomeFuncionario($data["nome_func"]);
       $user->setEmail($data["email"]);
       $user->setSenha($data["senha"]);
       $user->setNivelAcesso($data["nivel_acesso"]);
       $user->setOrigem($data["origem"]);
       $user->setCargo($data["cargo"]);

       $_SESSION['nivel_acesso'] = $data['nivel_acesso'];
       $_SESSION['nome'] = $data['nome_func'];
       $_SESSION['cargo'] = $data['cargo'];
       $_SESSION['origem'] = $data['origem'];



       return $user;

    }else{
      throw new \Exception('Usuário inexistente ou senha incorreta 2');
    }


  }



public static function loadById($iduser){
    $newId = (int)$iduser;

    $sql = new Sql();
    $result = $sql->select("SELECT * FROM funcionario WHERE idFuncionario=:ID", array(":ID"=>$newId));

    return $result;
}



public static function logout(){
  session_destroy();
  header("Location: /login");
  exit;
}

public static function listUsers(){

  $sql = new Sql();
  return $sql->select("SELECT * FROM funcionario ORDER BY idFuncionario DESC");
}

public static function listSindicatos(){
  
  $sql = new Sql();
  return $sql->select("SELECT * FROM sindicato");
}



public function saveUser($dados){


  $nome = $dados['nome_func'];
  $rg = $dados['rg_func'];
  $cargo = $dados['cargo'];
  $nivel_acesso = (int)$dados['nivel_acesso'];
  $origem = $dados['origem'];
  $telefone = $dados['telefone'];
  $email = $dados['email'];
  $senha = password_hash($dados['senha1'], PASSWORD_DEFAULT);
  //$senha = $_POST['senha1'];

 $sql = new Sql();

 $result = $sql->query("INSERT INTO funcionario (nome_func, rg_func, email, telefone, senha, nivel_acesso, origem, cargo) 
  VALUES(:nome, :rg, :email, :telefone, :senha, :nivel_acesso, :origem, :cargo)", 
  array(
    ":nome"=>$nome,
    ":rg"=>$rg,
    ":email"=>$email,
    ":telefone"=>$telefone,
    ":senha"=>$senha,
    ":nivel_acesso"=>$nivel_acesso,
    ":origem"=>$origem,
    ":cargo"=>$cargo
));

  if($result->rowCount() == 0){
    throw new \Exception('Erro ao cadastrar usuário', 1);
  };

  //header("Location: /admin/users");
}




                                    //VERIFICAÇÕES DE SESSÕES




public static function verifyLoginAdmin(){
  if(!isset($_SESSION['nivel_acesso']) || $_SESSION['nivel_acesso']!== "1"){
              header("Location: /login");
              exit;
            }
} 


public static function verifyLoginUser(){
  if(!isset($_SESSION['nivel_acesso']) || $_SESSION['nivel_acesso']!=="2"){
      header("Location: /login");
      exit;
     }
}


public static function verifyLoginUser2(){
  if(!isset($_SESSION['nivel_acesso']) || $_SESSION['nivel_acesso']!=="3"){
      header("Location: /login");
      exit;
     }
}

public static function verifyLoginAll(){
  
   if(isset($_SESSION['nivel_acesso'])){
       if($_SESSION['nivel_acesso'] == 1){
     header("Location: /admin");
      exit;
  }elseif($_SESSION['nivel_acesso'] == 2){
    header("Location: /user");
      exit;
  }elseif($_SESSION['nivel_acesso'] == 3){
    header("Location: /user2");
      exit;
  }
    }
}




public function getIdFuncionario(){
  return $this->idFuncionario;
}
public function setIdFuncionario($id){
  $this->idFuncionario = $id;
}

public function getNomeFuncionario(){
  return $this->nomeFuncionario;
}
public function setNomeFuncionario($n){
  $this->nomeFuncionario= $n;
}

public function getEmail(){
  return $this->email;
}
public function setEmail($e){
  $this->email = $e;
}

public function getSenha(){
  return $this->senha;
}
public function setSenha($s){
  $this->senha = $s;
}

public function getNivelAcesso(){
  return $this->nivel_acesso;
}
public function setNivelAcesso($n){
  $this->nivel_acesso = $n;
}

public function getOrigem(){
  return $this->origem;
}
public function setOrigem($o){
  $this->origem = $o;
}

public function getCargo(){
  return $this->cargo;
}
public function setCargo($c){
  $this->cargo = $c;
}








}
