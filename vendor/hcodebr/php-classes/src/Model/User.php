<?php 



namespace Hcode\Model;
use \Hcode\DB\Sql;
use \Hcode\Model;
use \Hcode\Mailer;

class User extends Model{

  const SECRET = "Hcodephp7_Secret";
  const URLPROJETO = "http://www.projetofieb.com";

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

      throw new \Exception('Usuário inexistente ou senha inválida!');
        //echo "<script> alert('Usuário inexistente ou senha inválida'); javascript:history.back();</script>";
        //exit;
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
       $_SESSION['tp'] = $data['tp'];



       return $user;

    }else{
      throw new \Exception('Usuário inexistente ou senha inválida!');

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

public static function getSindicato($idsindicato){
    $newId = (int)$idsindicato;

    $sql = new Sql();
    $result = $sql->select("SELECT * FROM sindicato WHERE idSindicato=:ID", array(":ID"=>$newId));

    if(!$result){
      throw new \Exception('Pare de bugar essa desgraça aí fdp do sindicato', 10);
    }


    return $result;
}


public static function updateSindicato($idsindicato, $post){

  $idSindicato = (int) $idsindicato;
  $nome_sindicato = $_POST['nomeSindicato'];
  $descricao_sindicato = $_POST['descricaoSindicato'];

  $nome_executivo = $_POST['nomeExecutivo'];
  $email_executivo = $_POST['emailExecutivo'];
  $telefone_executivo = $_POST['telefone'];

  //echo $idSindicato. " nome: ".$nome_sindicato." descricao: ".$descricao_sindicato;


    $sql = new Sql();
    $result = $sql->query("UPDATE sindicato SET nome_sindicato=:ns, descricao_sindicato=:descs, nome_executivo=:nome_executivo, email_executivo=:email_executivo, telefone_executivo=:telefone_executivo WHERE idSindicato=:ids", 
      array(":ns"=>$nome_sindicato,
            ":descs"=>$descricao_sindicato,
            ":ids"=>$idSindicato,
            ":nome_executivo"=>$nome_executivo,
            ":email_executivo"=>$email_executivo,
            ":telefone_executivo"=>$telefone_executivo));

    if($result->rowCount()==0){
      throw new \Exception('Erro ao atualizar informação de Sindicato',77);
    }
    


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
  return $sql->select("SELECT * FROM sindicato ORDER BY nome_sindicato");
}

public static function listCasas(){
  $sql = new Sql();
  return $sql->select("SELECT * FROM casas order by nome_casa desc");

}

public static function listFocais(){
  $nv = 2;
  $sql = new Sql();
  return $sql->select("SELECT * FROM funcionario WHERE nivel_acesso=:NV ORDER BY nome_func", array(":NV"=>$nv));
}

public static function listAllSolicitations(){

  $sql = new Sql();
  return  $sql->select("SELECT * FROM cadastros ORDER BY idCadastro DESC");
}

public static function listAllSolicitationsUser($origem){

 $orig = $origem;

  $sql = new Sql();
  return  $sql->select("SELECT * FROM cadastros WHERE origem=:orig ORDER BY idCadastro desc", array(":orig"=>$orig));
}


public static function listAllDemandas($origem){

  $orig = $origem;
  $iel = 'IEL'; 
   $sql = new Sql();
  return $sql->select("SELECT* FROM visita JOIN visita_has_funcionario JOIN demandas ON visita.idVisita=visita_has_funcionario.Visita_idVisita AND visita_has_funcionario.Visita_idVisita=demandas.idVisita_demandas WHERE demandas.demanda=:orig",
   array(":orig"=>$orig));

}

public static function deleteDemanda($idDemanda){

$id = (int)$idDemanda;

  $sql = new Sql();
  $query = $sql->query("DELETE FROM demandas WHERE idDemanda=:id", array(":id"=>$id));

}


public static function listCiclos(){

  $sql = new Sql();
  return $sql->select("SELECT * FROM ciclo order by data_inicio");
}

public static function getCiclo($idciclo){
 
$id = (int) $idciclo; 

  $sql = new Sql();

   $result = $sql->select("SELECT * FROM ciclo WHERE idCiclo=:id", array(":id"=>$id));
   if(count($result) == 0 ){
     throw new \Exception('Falha na busca do ciclo', 599);
   }

   return $result;

}

public static function getCicloAtual(){

  $sql = new Sql();
  $result = $sql->select("SELECT * FROM ciclo WHERE now()>data_inicio and now()<data_termino;");

  if(count($result) == 0 ){
     throw new \Exception('Falha na busca do ciclo. Nenhum ciclo encontrado', 699);
   }

  return $result[0];
}

public static function updateCiclo($idciclo, $dados){

 $id = (int)$idciclo;
 $nomeciclo = $dados['nomeCiclo'];
 $dataInicio = $dados['dataInicio'];
 $dataTermino = $dados['dataTermino'];

 $sql = new Sql();
 $query = $sql->query("UPDATE ciclo SET nome_ciclo=:nomeciclo, data_inicio=:datainicio, data_termino=:datatermino WHERE idCiclo=:id",
 array(":nomeciclo"=>$nomeciclo,
       ":datainicio"=>$dataInicio,
       ":datatermino"=>$dataTermino,
       ":id"=>$id));

 if($query->rowCount() == 0){

    var_dump($query->errorInfo());
    throw new \Exception('Falha na edição do ciclo', 598);
 }


}

public function deleteCiclo($idciclo){

  $sql = new Sql();
  $query = $sql->query("DELETE FROM ciclo where idCiclo=:id limit 1", array(":id"=>$idciclo));

  if($query->rowCount() == 0 ){
    throw new \Exception('Falha na exclusão do ciclo', 597);
  }

}



public static function createCiclo($datas){

 $nomeCiclo = ucfirst($datas['nomeCiclo']);
 $dataInicio = $datas['dataInicio'];
 $dataTermino = $datas['dataTermino'];


 $sql = new Sql();
 $result = $sql->select("SELECT * FROM ciclo WHERE data_termino>:datainicio", array(":datainicio"=>$dataInicio));

 if(count($result)==0 and $dataInicio<$dataTermino){ 

    
      $sql2 = new Sql();
      $query = $sql2->query("INSERT INTO ciclo (nome_ciclo, data_inicio, data_termino) VALUES (:nomeCiclo, :dataInicio, :dataTermino)",
      array(":nomeCiclo"=>$nomeCiclo,
            ":dataInicio"=>$dataInicio,
            ":dataTermino"=>$dataTermino));

      if($query->rowCount() == 0){
            throw new \Exception('Ciclo não pode ser criado. Nome de ciclo já existente', 602);
    }

    }else{ 
              throw new \Exception('Ciclo não pode ser criado. Ciclo já existente na data digitada ou datas inválidas.', 601);

              //echo "<script> alert('Ciclo não pode ser criado, ciclo já existente na data digitada ou datas inválidas'); history.back();</script>";
              exit;
          }

  
}

public static function aproveSolicitation($dados){

  $idcadastro = $dados['idCadastro'];

  $nome = $dados['nome_func'];
  $cpf = $dados['cpf_func'];
  $cargo = $dados['cargo'];
  $nivel_acesso = (int)$dados['nivel_acesso'];
  $origem = $dados['origem'];
  $telefone = $dados['telefone'];
  $email = $dados['email_func'];
  $senha = $dados['senha'];

  if($origem == "IEL" || $origem == "SESI" || $origem == "SENAI" || $origem == "CIEB"){

    $tp = "CASA";
  }else{
    $tp = "SINDICATO";
  }



  $sql = new Sql();

  $result = $sql->query("INSERT INTO funcionario (nome_func, cpf_func, email, telefone, senha, nivel_acesso, origem, tp, cargo) 
  VALUES(:nome, :cpf, :email, :telefone, :senha, :nivel_acesso, :origem, :tp, :cargo)", 
  array(
    ":nome"=>$nome,
    ":cpf"=>$cpf,
    ":email"=>$email,
    ":telefone"=>$telefone,
    ":senha"=>$senha,
    ":nivel_acesso"=>$nivel_acesso,
    ":origem"=>$origem,
    ":tp"=>$tp,
    ":cargo"=>$cargo
));

  if($result->rowCount() == 0){
    throw new \Exception('<h2>Erro ao aprovar solicitação. CPF já cadastrado ou dados inválidos</h2>', 1);
  };


    $sql2 = new Sql();
   $result2 = $sql->query("DELETE FROM cadastros WHERE idCadastro=:idcadastro", array(":idcadastro"=>$idcadastro));

   if($result2->rowCount() == 0){
    throw new \Exception('Erro ao deletar o usuário depois de aprovar', 1);
   }


   $mailer = new Mailer($email, $nome, "SGA - Solicitacao de Acesso Aprovada", "aprove", 
           array("name"=>$nome,
                 "link"=>User::URLPROJETO));

          $mailer->send();


}

public static function recuseSolicitation($dados){

$idcadastro = $dados['idCadastro'];
$email = $dados['email_func'];
$nome = $dados['nome_func'];

$mailer = new Mailer($email, $nome, "SGA - Solicitacao de Acesso Recusada", "recuse", 
           array("name"=>$nome));

          $mailer->send(); 



  $sql = new Sql();
  $query = $sql->query("DELETE FROM cadastros WHERE idCadastro=:idcadastro", array(":idcadastro"=>$idcadastro));

  if($query->rowCount() == 0){

    throw new Exception('Falha ao recusar solicitação de usuário', 700);
  }



}





public function saveUser($dados){


  $nome = trim(ucwords(mb_strtolower($dados['nome_func'])));
  $cpf = $dados['cpf_func'];
  $cargo = ucfirst($dados['cargo']);
  $nivel_acesso = (int)$dados['nivel_acesso'];
  $origem = $dados['origem'];
  $telefone = $dados['telefone'];
  $telefone2 = $dados['telefone2'];
  $email = $dados['email'];

  if($dados['senha1'] !== $dados['senha2']){
    throw new \Exception("As senhas digitadas não coincidem", 65598);
    
  }

  $senha = password_hash($dados['senha1'], PASSWORD_DEFAULT);
  //$senha = $_POST['senha1'];

  if($origem == "IEL" || $origem == "SESI" || $origem == "SENAI" || $origem == "CIEB"){

    $tp = "CASA";
  }else{

    $tp = "SINDICATO";

  }

 $sql = new Sql();

 $result = $sql->query("INSERT INTO funcionario (nome_func, cpf_func, email, telefone, telefone2, senha, nivel_acesso, origem, tp, cargo) 
  VALUES(:nome, :cpf, :email, :telefone, :telefone2, :senha, :nivel_acesso, :origem, :tp, :cargo)", 
  array(
    ":nome"=>$nome,
    ":cpf"=>$cpf,
    ":email"=>$email,
    ":telefone"=>$telefone,
    ":telefone2"=>$telefone2,
    ":senha"=>$senha,
    ":nivel_acesso"=>$nivel_acesso,
    ":origem"=>$origem,
    ":cargo"=>$cargo,
    ":tp"=>$tp
));

  if($result->rowCount() == 0){
    throw new \Exception('Erro ao cadastrar usuário. Usuário com CPF já cadastrado ou dados inválidos', 1);
  };


     
}

public static function editProfile($dados, $iduser){

  $id = (int)$iduser;
  $nome = trim(ucwords($_POST['cNome']));
  $cargo = trim(ucfirst($_POST['cCargo']));
  $email = $_POST['cEmail'];
  $telefone = $_POST['cTelefone'];
  $telefone2 = $_POST['cTelefone2'];


try{

  $sql = new Sql();
 $result = $sql->query("UPDATE funcionario SET nome_func=:nome, email=:email, telefone=:tel, telefone2=:tel2, cargo=:cargo WHERE idFuncionario=:id", 
  array(":nome"=>$nome,
        ":email"=>$email,
        ":tel"=>$telefone,
        ":tel2"=>$telefone2,
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

public static function alterPassword($iduser, $dados){

 $id = (int)$iduser;
 $senhaAtual = $dados['senhaAtual'];
 $senha1 = $dados['senha1'];
 $senha2 = $dados['senha2'];

  $sql = new Sql();
  $result = $sql->select("SELECT * FROM funcionario WHERE idFuncionario=:id", array(":id"=>$id));
  $data = $result[0];

  if(password_verify($senhaAtual, $data['senha']) && $senha1 === $senha2){

     
    $newSenha = password_hash($senha2, PASSWORD_DEFAULT);

      // Senha válida
    $sql2 = new Sql();
    $query = $sql2->query("UPDATE funcionario SET senha=:newsenha WHERE idFuncionario=:id LIMIT 1", 
      array(":newsenha"=>$newSenha,
            ":id"=>$id));




    if($query->rowCount() == 0){

        throw new \Exception('Falha ao atualizar senha', 5069);
    }
    


  }else{
    throw new \Exception('Não foi possível alterar a senha, verifique os dados digitados e tente novamente.', 5068);
  }



}





public static function saveSindicato($dados){
   
   $nome_sindicato = trim($dados['nomeSindicato']);
   $descricao = $dados['descricaoSindicato'];

   $nome_executivo = $dados['nomeExecutivo'];
   $email_executivo = $dados['emailExecutivo'];
   $telefone_executivo = $dados['telefone'];

  $sql = new Sql();
  $result = $sql->query("INSERT INTO sindicato (nome_sindicato, descricao_sindicato, nome_executivo, email_executivo, telefone_executivo) 
        VALUES (:nomeSindicato, :descricao, :nome_executivo, :email_executivo, :telefone_executivo)",
  array(":nomeSindicato"=>$nome_sindicato,
        ":descricao"=>$descricao,
        ":nome_executivo"=>$nome_executivo,
        ":email_executivo"=>$email_executivo,
        ":telefone_executivo"=>$telefone_executivo));

  if($result->rowCount() == 0){
    throw new \Exception('Erro ao cadastrar sindicato, verifique os dados e tente novamente', 55);
  }

}


public static function removeSindicato($id){
   
   $newId = (int)$id;

   $sql2 = new Sql();
   $result2 = $sql2->select("SELECT * FROM sindicato WHERE idSindicato=:id", array(":id"=>$newId));



   $orig = $result2[0]['nome_sindicato'];

  $sql3 = new Sql();
  $sql3->query("DELETE FROM funcionario WHERE origem=:orig", array(":orig"=>$orig));


  $sql = new Sql();
  $result = $sql->query("DELETE FROM sindicato where idSindicato=:ids",
  array(":ids"=>$newId));

  if($result->rowCount() == 0){
    throw new \Exception('Erro ao remover sindicato, verifique os dados e tente novamente', 55);
  }


  
}



public static function getForgot($email){

 $sql = new Sql();
 $results = $sql->select("SELECT * FROM funcionario WHERE email=:email", array(":email"=>$email));

 if(count($results) === 0){
  throw new \Exception('Não foi possível recuperar a senha', 500);

 }else{

      $data = $results[0];
      $desip = $_SERVER['REMOTE_ADDR'];

      $sql3 = new Sql();
      $sql2 = new Sql();
      $sql1 = new Sql();
      $resultSql2 = $sql2->query("INSERT INTO funcionario_recoveries (Funcionario_idFuncionario, desip)
       VALUES (:iduser, :desip)", 
      array(":iduser"=>$data['idFuncionario'],
            ":desip"=>$_SERVER['REMOTE_ADDR']));

      if($resultSql2->rowCount() === 0){ throw new \Exception('Falha no insert', 501);  }

      $resultSql1 = $sql1->select("SELECT max(idrecoverie) FROM funcionario_recoveries");
      $lastid = $resultSql1[0]["max(idrecoverie)"];


      $results2 = $sql3->select("SELECT * FROM funcionario_recoveries WHERE idrecoverie=:lastid", array(":lastid"=>$lastid));

      if(count($results2) === 0){ 
        throw new \Exception('Falha na recuperação da senha', 502);

      }else{

          $dataRecovery = $results2[0];

          $iv = random_bytes(openssl_cipher_iv_length('aes-256-cbc'));
          $code = openssl_encrypt($dataRecovery['idrecoverie'], 'aes-256-cbc', User::SECRET, 0, $iv);
          $result = base64_encode($iv.$code);

          $link = User::URLPROJETO."/forgot/reset?code=$result";
          
           echo $data['email']." - ".$data['nome_func'];

          $mailer = new Mailer($data['email'], $data['nome_func'], "Redefinir senha SGA", "forgot", 
           array("name"=>$data['nome_func'],
                 "link"=>$link));

          $mailer->send();

          return $data;


      }



 }


}


public static function validForgotDecrypt($result){

    $result = base64_decode($result);
    $code = mb_substr($result, openssl_cipher_iv_length('aes-256-cbc'), null, '8bit');
    $iv = mb_substr($result, 0, openssl_cipher_iv_length('aes-256-cbc'), '8bit');;
    $idrecovery = openssl_decrypt($code, 'aes-256-cbc', User::SECRET, 0, $iv);

    $sql = new Sql();
    $results = $sql->select("SELECT* FROM funcionario_recoveries a JOIN funcionario b ON a.Funcionario_idFuncionario=b.idFuncionario
WHERE idrecoverie=:idrecovery AND a.dtrecovery IS NULL AND DATE_ADD(a.dtregister, INTERVAL 1 HOUR)>= NOW();", 
array(":idrecovery"=>$idrecovery));


if(count($results) === 0){

    throw new \Exception('Não foi possível recuperar a senha', 507);

}else{

  return $results[0];

}





}


public static function setForgotUsed($idrecoverie){

$sql = new Sql();
$sql->query("UPDATE funcionario_recoveries SET dtrecovery= NOW() WHERE idrecoverie=:idreco", array(":idreco"=>$idrecoverie));


}


public static function setPassword($password, $iduser){

   $newPassword = password_hash($password, PASSWORD_DEFAULT);
 
   $sql = new Sql();
   $sql->query("UPDATE funcionario SET senha=:newSenha WHERE idFuncionario=:iduser", array(
    ":newSenha"=>$newPassword,
    ":iduser"=>$iduser
   ));


}


public static function registerUser($dados){

  $nome_func = trim($dados['campoNome']);
  $cpf_func = $dados['campoCPF'];
  /*if(is_numeric($dados['campoRG'])){
    $rg_func = $dados['campoRG'];
  }else{
    throw new \Exception('RG inválido',5068);
  }*/

  $email_func = $dados['campoEmail'];

  if($dados['senha1'] === $dados['senha2']){
    $senha = password_hash($dados['senha2'], PASSWORD_DEFAULT);
  }else{
    throw new \Exception('As senhas não coincidem', 8990);
  }

 

  if($dados['campoOrigem'] !== ""){

    $origem = $dados['campoOrigem'];
  }else{
    throw new \Exception('Selecione a sua origem', 9645);
  }

  $cargo = $dados['campoCargo'];
  $nivel_acesso = 3;

  User::verificaCPF($cpf_func);
  User::verificaEmail($email_func);

  $sql = new Sql();
  $query = $sql->query("INSERT INTO cadastros (nome_func, cpf_func, email_func, senha, nivel_acesso, origem, cargo) VALUES
      (:nome, :cpf_func, :email_func, :senha, :nivel_acesso, :origem, :cargo)", array(
        ":nome"=>$nome_func,
        ":cpf_func"=>$cpf_func,
        ":email_func"=>$email_func,
        ":senha"=>$senha,
        ":nivel_acesso"=>$nivel_acesso,
        ":origem"=>$origem,
        ":cargo"=>$cargo));

  if($query->rowCount()==0){ throw new \Exception('Falha ao cadastrar as informações no banco de dados', 850222);}


}



public static function verificaCPF($cpf){
  $sql = new Sql();
  $result = $sql->select("SELECT * FROM funcionario WHERE cpf_func=:cpf", array(":cpf"=>$cpf));

  if(count($result)>0){
    throw new \Exception('CPF já cadastrado', 00365);
  }

  $sql2 = new Sql();
  $result2 = $sql2->select("SELECT * FROM cadastros WHERE cpf_func=:cpf", array(":cpf"=>$cpf));

  if(count($result2)>0){ throw new \Exception('CPF já cadastrado', 9856);}
}




public static function verificaEmail($email){
  $sql = new Sql();
  $result = $sql->select("SELECT * FROM funcionario WHERE email=:email", array(":email"=>$email));

  if(count($result)>0){ throw new \Exception('Email já cadastrado', 6933);}

  $sql2 = new Sql();
  $result2 = $sql2->select("SELECT * FROM cadastros WHERE email_func=:email", array(":email"=>$email));

  if(count($result2)>0){ throw new \Exception('Email já cadastrado', 6933);}

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
     header("Location: /admin/visitas");
      exit;
  }elseif($_SESSION['nivel_acesso'] == 2){
    header("Location: /user/origem/visitas");
      exit;
  }elseif($_SESSION['nivel_acesso'] == 3){
    header("Location: /user2/origem/visitas");
      exit;
  }
    }
}


public static function reportError($dados){

  $descricao = $dados['campoDescricao'];
  $nome = $_SESSION['nome'];

  $mailer = new Mailer("pedrosophbc@gmail.com", $_SESSION['nome'], "SGA - ERROR REPORT", "error", 
           array("name"=>$nome,
                 "link"=>User::URLPROJETO,
                 "descricao"=>$descricao));

          $mailer->send();




}


public static function getPage($page = 1, $itemsPerPage = 15){

  $start = ($page-1)*$itemsPerPage;


  $sql = new Sql();
  
  $results = $sql->select("SELECT SQL_CALC_FOUND_ROWS * 
                FROM funcionario ORDER BY nome_func
                limit $start, $itemsPerPage;

                ");


    $resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");

    return [
      'data'=>$results,
      'total'=>(int)$resultTotal[0]['nrtotal'],
      'pages'=>ceil($resultTotal[0]['nrtotal']/$itemsPerPage)
    ];

}

public static function getPageSearch($search, $page = 1, $itemsPerPage = 10){

  $start = ($page-1)*$itemsPerPage;


  $sql = new Sql();
  
  $results = $sql->select("SELECT SQL_CALC_FOUND_ROWS * 
                FROM funcionario 
                WHERE nome_func LIKE :search OR cargo LIKE :search OR origem LIKE :search OR email LIKE :search
                ORDER BY nome_func
                limit $start, $itemsPerPage;

                ", array(":search"=>'%'.$search.'%'));


    $resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");

    return [
      'data'=>$results,
      'total'=>(int)$resultTotal[0]['nrtotal'],
      'pages'=>ceil($resultTotal[0]['nrtotal']/$itemsPerPage)
    ];

}


public static function getPageFocais($page = 1, $itemsPerPage = 10){

  $start = ($page-1)*$itemsPerPage;


  $sql = new Sql();
  
  $results = $sql->select("SELECT SQL_CALC_FOUND_ROWS * 
                FROM funcionario 
                WHERE nivel_acesso= 2 ORDER BY nome_func
                limit $start, $itemsPerPage;

                ");


    $resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");

    return [
      'data'=>$results,
      'total'=>(int)$resultTotal[0]['nrtotal'],
      'pages'=>ceil($resultTotal[0]['nrtotal']/$itemsPerPage)
    ];

}

public static function getPageSearchFocais($search, $page = 1, $itemsPerPage = 10){

  $start = ($page-1)*$itemsPerPage;


  $sql = new Sql();
  
  $results = $sql->select("SELECT SQL_CALC_FOUND_ROWS * 
                FROM funcionario 
                WHERE nivel_acesso = 2  AND nome_func LIKE :search OR origem LIKE :search
                ORDER BY nome_func
                limit $start, $itemsPerPage;

                ", array(":search"=>'%'.$search.'%'));


    $resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");

    return [
      'data'=>$results,
      'total'=>(int)$resultTotal[0]['nrtotal'],
      'pages'=>ceil($resultTotal[0]['nrtotal']/$itemsPerPage)
    ];

}


public static function saveContato($dados){

  $id_funcionario = $_SESSION['idFuncionario'];
  $nome = $dados['nome'];
  $entidade = $dados['entidade'];
  $telefone = $dados['telefone'];
  $telefone2 = $dados['telefone2'];
  $email = $dados['email'];
  $observacao = $dados['observacao'];

  $sql = new Sql();
  $result = $sql->query("INSERT INTO contatos (id_funcionario, nome, entidade, telefone, telefone2, email, observacao) 
    VALUES (:idFuncionario, :nome, :entidade, :telefone, :telefone2, :email, :observacao)", 
    array(":idFuncionario"=>$id_funcionario,
          ":nome"=>$nome,
          ":entidade"=>$entidade,
          ":telefone"=>$telefone,
          ":telefone2"=>$telefone2,
          ":email"=>$email,
          ":observacao"=>$observacao));

  
  if(!$result){
    throw new Exception('Falha ao cadastrar contato', 5687);
  }


}

public static function listContatos(){

  $sql = new Sql();
  return $sql->select("SELECT * FROM contatos");

}

public static function listContatos2(){

  $sql = new Sql();
  return $sql->select("SELECT nome_func, origem, telefone, email FROM funcionario ORDER BY nome_func;");
}

public static function getContato($idcontato){

  $sql = new Sql();

  return $sql->select("SELECT * FROM contatos WHERE id_contatos =:id_contato", array(":id_contato"=>$idcontato));

}

public static function removeContato($idcontato){

  $sql = new Sql();
  $query = $sql->query("DELETE FROM contatos WHERE id_contatos=:idcontato", array(":idcontato"=>$idcontato));
  
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
