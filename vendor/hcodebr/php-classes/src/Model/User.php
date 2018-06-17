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
       

       $user = new User();
       $user->setIdFuncionario($data['idFuncionario']);
       $user->setNomeFuncionario($data["nome_func"]);
       $user->setEmail($data["email"]);
       $user->setSenha($data["senha"]);
       $user->setNivelAcesso($data["nivel_acesso"]);
       $user->setOrigem($data["origem"]);
       $user->setCargo($data["cargo"]);

       $_SESSION['nivel_acesso'] = $data['nivel_acesso'];
       $_SESSION['idFuncionario'] = $data['idFuncionario'];
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

    if(!$result){
      throw new \Exception('Pare de bugar essa desgraça aí fdp', 9);
    }


    return $result;
}

public static function getCadastro($iduser){
    $newId = (int)$iduser;

    $sql = new Sql();
    $result = $sql->select("SELECT * FROM cadastros WHERE idCadastro=:ID", array(":ID"=>$newId));

    if(!$result){
      throw new \Exception('Pare de bugar essa desgraça aí fdp', 10);
    }


    return $result;
}









public static function updateFocal($iduser, $post){

  $nivel_acesso = $_POST['nivel_acesso'];


    $sql = new Sql();
    $result = $sql->query("UPDATE funcionario SET nivel_acesso=:nv WHERE idFuncionario=:iduser", 
      array(":nv"=>$nivel_acesso,
            ":iduser"=>$iduser));

    if($result->rowCount()==0){
      throw new \Exception('Erro ao atualizar nivel de acesso de usuário');
    }
}

public static function deleteUser($iduser2){

$iduser = (int) $iduser2;

if($iduser !== 1){

      $sql = new Sql();
      $sql->query("DELETE FROM funcionario WHERE idFuncionario=:iduser", array(":iduser"=>$iduser));
  }else{
    throw new \Exception('Tentando deletar o desenvolvedor desgraça?');
  }

}


public static function logout(){
  session_destroy();
  header("Location: /login");
  exit;
}

public static function listUsers(){

  $sql = new Sql();
  return $sql->select("SELECT * FROM funcionario ORDER BY nome_func");
}

public static function listSindicatos(){
  
  $sql = new Sql();
  return $sql->select("SELECT * FROM sindicato");
}

public static function listFocais(){
  $nv = 2;
  $sql = new Sql();
  return $sql->select("SELECT * FROM funcionario WHERE nivel_acesso=:NV ORDER BY nome_func", array(":NV"=>$nv));
}

public static function listAllSolicitations(){

  $sql = new Sql();
  return  $sql->select("SELECT * FROM cadastros ORDER BY nome_func");
}

public static function listAllSolicitationsUser($origem){

 $orig = $origem;

  $sql = new Sql();
  return  $sql->select("SELECT * FROM cadastros WHERE origem=:orig ORDER BY nome_func", array(":orig"=>$orig));
}


public static function aproveSolicitation($dados){

  $idcadastro = $dados['idCadastro'];

  $nome = $dados['nome_func'];
  $rg = $dados['rg_func'];
  $cargo = $dados['cargo'];
  $nivel_acesso = (int)$dados['nivel_acesso'];
  $origem = $dados['origem'];
  $telefone = $dados['telefone'];
  $email = $dados['email_func'];
  $senha = $dados['senha'];

 
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
    throw new \Exception('Erro ao aprovar solicitação de usuário verifique os dados e tente novamente', 1);
  };


    $sql2 = new Sql();
   $result2 = $sql->query("DELETE FROM cadastros WHERE idCadastro=:idcadastro", array(":idcadastro"=>$idcadastro));

   if($result2->rowCount() == 0){
    throw new \Exception('Erro ao deletar o usuário depois de aprovar', 1);
   }





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

public static function editProfile($dados, $iduser){

  $id = (int)$iduser;
  $nome = $_POST['cNome'];
  $cargo = $_POST['cCargo'];
  $email = $_POST['cEmail'];
  $telefone = $_POST['cTelefone'];


try{

  $sql = new Sql();
 $result = $sql->query("UPDATE funcionario SET nome_func=:nome, email=:email, telefone=:tel, cargo=:cargo WHERE idFuncionario=:id", 
  array(":nome"=>$nome,
        ":email"=>$email,
        ":tel"=>$telefone,
        ":cargo"=>$cargo,
        ":id"=>$id));

}catch(\PDOException $e){

     echo $e->getMessage();
    echo "<br> Erro caraio"; 
}
    
    $_SESSION['nome'] = $nome;
    $_SESSION['cargo'] = $cargo;

     User::verifyLoginAll();

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
