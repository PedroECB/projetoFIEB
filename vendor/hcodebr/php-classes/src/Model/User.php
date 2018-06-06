<?php 

namespace Hcode\Model;
use \Hcode\DB\Sql;
use \Hcode\Model;

class User extends Model{

  private $idFuncionario;
  private $nomeFuncionario;
  private $email;
  private $senha;
  private $nivel_acesso;
  private $origem;
  private $cargo;


                      # Login 1
/*
  public static function login($login, $senha){
    $sql = new Sql();
    $results = $sql->select("SELECT * FROM Funcionario WHERE email =:LOGIN ", array(
      ":LOGIN"=>$login
    ));

    if(count($results) === 0){

      throw new \Exception('Usuário inexistente ou senha inválida');

    }

    $data = $results[0];

    if(password_verify($senha, $data['senha'])){

       $user = new User();
       $this->setIdFuncionario($data["idFuncionario"]);
       $this->setNomeFuncionario($data["nome_func"]);
       $this->setEmail($data["email"]);
       $this->setSenha($data["senha"]);
       $this->setNivelAcesso($data["nivel_acesso"]);
       $this->setOrigem($data["origem"]);
       $this->setCargo($data["cargo"]);

       header("Location: index.php");

       return $user;

       

       
    }else{
      throw new Exception('Usuário inexistente ou senha incorreta 2', 1);
    }


  }

  */





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

  /*public static function verifyAdmin(){
      if(){}
  }
*/



public static function logout(){
  session_destroy();
  header("Location: /login");
  exit;
}

public static function listUsers(){

  $sql = new Sql();
  return $sql->select("SELECT * FROM funcionario");
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
