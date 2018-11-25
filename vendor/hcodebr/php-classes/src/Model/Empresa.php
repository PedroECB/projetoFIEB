<?php 

namespace Hcode\Model;
use \Hcode\DB\Sql;
use \Hcode\Model;

class Empresa extends Model{

  private $idEmpresas;
  private $sindicato_idSindicato;
  private $cnpj;
  private $razao_social;
  private $nome_fantasia;
  private $situacao_associacao;
  private $municipio;
  private $regiao_estado;
  private $bairro;
  private $endereco;
  private $email;
  private $telefone;



  public static function listCidades(){

    $sql = new Sql();

    return $sql->select("SELECT (cidade) FROM cidades");

  }


  public static function listAll(){
    $sql = new Sql();
    return $sql->select("SELECT * FROM empresas ORDER BY idEmpresas desc;");
  }

  public static function listAllOrigem($origem){

    $orig = $origem;

    $sql = new Sql();
    return $sql->select("SELECT * FROM empresas WHERE origem_cadastro=:orig ORDER BY idEmpresas desc;", array(":orig"=>$orig));

  }

  public static function getEmpresa($id){

    $newId = (int) $id;

    $sql = new Sql();
    return $sql->select("SELECT * FROM empresas WHERE idEmpresas=:idempresa", array(":idempresa"=>$newId));

  }

  public static function removeEmpresa($id){
    
    $newId = $id;

    $sql = new Sql();

    $result = $sql->query("DELETE FROM empresas where idEmpresas=:id", array(":id"=>$newId));

    if($result->rowCount() == 0){
      echo "<script> alert('Não foi possível remover a empresa, empresa com visitas ativas.'); javascript:history.back();</script>";
      return false;
      exit;
    };

    return true;

  }


  public static function getFuncEmpresaSind($idempresa){
 
  $idEmpresa = (int) $idempresa;

    $sql1 = new Sql();

    $result = $sql1->select("SELECT * FROM empresas WHERE idEmpresas=:idempresa", array(":idempresa"=>$idEmpresa));
    $data = $result[0];

    if(!isset($result[0]['idFuncionario']) && !isset($result[0]['Sindicato_idSindicato'])){

      return $result;

    }
    
    if(!$data['Sindicato_idSindicato']){

            $sql2 = new Sql();

             return $sql2->select("SELECT * FROM funcionario JOIN empresas ON 
                                    empresas.idFuncionario= funcionario.idFuncionario AND 
                                    empresas.idEmpresas =:idempresa", array(":idempresa"=>$idEmpresa));
      
      }else{ 

        $sql2 = new Sql();

          return $sql2->select("SELECT * FROM sindicato JOIN funcionario 
                                JOIN empresas ON empresas.idFuncionario= funcionario.idFuncionario 
                                AND sindicato.idSindicato=empresas.Sindicato_idSindicato
                              AND empresas.idEmpresas =:idempresa", array(":idempresa"=>$idEmpresa));

        }

  }



  public static function saveEmpresa($dados){

      $idFuncionario = $_SESSION['idFuncionario'];
      $origem_func = $_SESSION['origem'];
      $cnpj = $dados['cnpj'];
      $razaoSocial = $dados['razaoSocial'];
      $nomeFantasia = $dados['nomeFantasia'];
      $situacaoAssociacao = $dados['sitAssoc'];
      $associadaA = isset($dados['Assoc'])?(int)$dados['Assoc']:NULL;
      $cidade = $dados['campoCidade'];
      $regiao = $dados['CampoRegiao'];
      $bairro = $dados['campoBairro'];
      $endereco = $dados['campoEndereco'];
      $email = $dados['email'];
      $telefone = $dados['campoTelefone'];
      $telefone2 = $dados['campoTelefone2'];
      $posAssoc = $dados['posAssoc'] = isset($dados['posAssoc'])?$dados['posAssoc']:"";
      $nomeContato =  isset($dados['nomeContato'])?$dados['nomeContato']:"";
      $identificacao = isset($dados['identificacao'])?$dados['identificacao']:"";

    $sql = new Sql();
    $query = $sql->query("INSERT INTO empresas 
      (idFuncionario, Sindicato_idSindicato, identificacao,cnpj, razao_social, nome_fantasia, situacao_associacao, municipio, regiao_estado, bairro, endereco, email, nomeContato, telefone, telefone2, origem_cadastro, possAssoc)
      VALUES(:idFuncionario, :associadaA, :identificacao, :cnpj, :razaoSocial, :nome_fantasia, :situacaoAssociacao, :municipio, :regiao, :bairro, :endereco, :email, :nomeContato,:telefone, :telefone2, :origem_cadastro, :posAssoc)",
      array(":idFuncionario"=>$idFuncionario,
            ":associadaA"=>$associadaA,
            ":identificacao"=>$identificacao,
            ":cnpj"=>$cnpj,
            ":razaoSocial"=>$razaoSocial,
            ":nome_fantasia"=>$nomeFantasia,
            ":situacaoAssociacao"=>$situacaoAssociacao,
            ":municipio"=>$cidade,
            ":regiao"=>$regiao,
            ":bairro"=>$bairro,
            ":endereco"=>$endereco,
            ":email"=>$email,
            ":nomeContato"=>$nomeContato,
            ":telefone"=>$telefone,
            ":telefone2"=>$telefone2,
            ":origem_cadastro"=>$origem_func,
            ":posAssoc"=>$posAssoc));

    if($query->rowCount() == 0){
      
          $error = $query->errorInfo();

     if($error[1] === 1062){
        throw new \Exception('CNPJ já cadastrado', 7800);
     }else{
      throw new \Exception('Erro ao cadastrar empresa, verifique os dados digitados e tente novamente', 7801);
     }

    }




  }



  public static function getPage($page = 1, $itemsPerPage = 10){

  $start = ($page-1)*$itemsPerPage;


  $sql = new Sql();
  
  $results = $sql->select("SELECT SQL_CALC_FOUND_ROWS * 
                      FROM empresas ORDER BY idEmpresas desc
                      limit $start, $itemsPerPage;

                ");


    $resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");

    return [
      'data'=>$results,
      'total'=>(int)$resultTotal[0]['nrtotal'],
      'pages'=>ceil($resultTotal[0]['nrtotal']/$itemsPerPage)
    ];

}


public static function getPageSearch($search, $page = 1, $itemsPerPage = 15){

  $start = ($page-1)*$itemsPerPage;


  $sql = new Sql();
  
  $results = $sql->select("SELECT SQL_CALC_FOUND_ROWS * 
                FROM empresas  WHERE razao_social LIKE :search OR nome_fantasia LIKE :search OR municipio LIKE :search OR cnpj LIKE :search OR situacao_associacao LIKE :search OR origem_cadastro LIKE :search
                ORDER BY idEmpresas desc
                limit $start, $itemsPerPage;

                ", array(":search"=>$search.'%'));


    $resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");

    return [
      'data'=>$results,
      'total'=>(int)$resultTotal[0]['nrtotal'],
      'pages'=>ceil($resultTotal[0]['nrtotal']/$itemsPerPage)
    ];

}

public static function getPageSearchOrigem($origem, $search, $page = 1, $itemsPerPage = 15){

  $start = ($page-1)*$itemsPerPage;


  $sql = new Sql();
  
  $results = $sql->select("SELECT SQL_CALC_FOUND_ROWS * 
                FROM empresas WHERE origem_cadastro=:orig OR identificacao=:orig AND razao_social LIKE :search 
                OR origem_cadastro=:orig OR identificacao=:orig AND nome_fantasia LIKE :search
                OR origem_cadastro=:orig OR identificacao=:orig AND cnpj LIKE :search
                OR origem_cadastro=:orig OR identificacao=:orig AND municipio LIKE :search
                OR origem_cadastro=:orig OR identificacao=:orig AND regiao_estado LIKE :search
                OR origem_cadastro=:orig OR identificacao=:orig AND situacao_associacao LIKE :search
                ORDER BY idEmpresas desc
                limit $start, $itemsPerPage;

                ", array(":search"=>$search.'%', ":orig"=>$origem));


    $resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");

    return [
      'data'=>$results,
      'total'=>(int)$resultTotal[0]['nrtotal'],
      'pages'=>ceil($resultTotal[0]['nrtotal']/$itemsPerPage)
    ];

}


  public static function getPageOrigem($origem, $page = 1, $itemsPerPage = 10){

  $start = ($page-1)*$itemsPerPage;


  $sql = new Sql();
  
  $results = $sql->select("SELECT SQL_CALC_FOUND_ROWS * 
                      FROM empresas WHERE origem_cadastro=:orig OR identificacao=:orig ORDER BY idEmpresas desc
                      limit $start, $itemsPerPage;

                ", array(":orig"=>$origem));


    $resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");

    return [
      'data'=>$results,
      'total'=>(int)$resultTotal[0]['nrtotal'],
      'pages'=>ceil($resultTotal[0]['nrtotal']/$itemsPerPage)
    ];

}


 public static function getPageCicloAtual($cicloAtual, $page = 1, $itemsPerPage = 10){

  $data_inicio = $cicloAtual['data_inicio'];
  $data_termino = $cicloAtual['data_termino'];

  $start = ($page-1)*$itemsPerPage;
 

  $sql = new Sql();
  
  $results = $sql->select("SELECT SQL_CALC_FOUND_ROWS * 
                      FROM empresas WHERE dtcadastro_empresa>=:data_inicio and dtcadastro_empresa<=:data_termino ORDER BY idEmpresas desc
                      limit $start, $itemsPerPage;

                ", array(":data_inicio"=>$data_inicio,
                         "data_termino"=>$data_termino));


    $resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");

    return [
      'data'=>$results,
      'total'=>(int)$resultTotal[0]['nrtotal'],
      'pages'=>ceil($resultTotal[0]['nrtotal']/$itemsPerPage)
    ];

}

public static function getPageSearchCicloAtual($cicloAtual, $search, $page = 1, $itemsPerPage = 15){

  $data_inicio = $cicloAtual['data_inicio'];
  $data_termino = $cicloAtual['data_termino'];

  $start = ($page-1)*$itemsPerPage;


  $sql = new Sql();
  
  $results = $sql->select("SELECT SQL_CALC_FOUND_ROWS * 
                FROM empresas  WHERE razao_social LIKE :search AND dtcadastro_empresa>=:data_inicio AND dtcadastro_empresa<=:data_termino  
                OR nome_fantasia LIKE :search AND dtcadastro_empresa>=:data_inicio AND dtcadastro_empresa<=:data_termino 
                OR municipio LIKE :search AND dtcadastro_empresa>=:data_inicio AND dtcadastro_empresa<=:data_termino 
                OR cnpj LIKE :search AND dtcadastro_empresa>=:data_inicio AND dtcadastro_empresa<=:data_termino
                OR situacao_associacao LIKE :search AND dtcadastro_empresa>=:data_inicio AND dtcadastro_empresa<=:data_termino
                OR origem_cadastro LIKE :search AND dtcadastro_empresa>=:data_inicio AND dtcadastro_empresa<=:data_termino
                ORDER BY idEmpresas desc
                limit $start, $itemsPerPage;

                ", array(":search"=>$search.'%', 
                         ":data_inicio"=>$data_inicio, 
                         ":data_termino"=>$data_termino));


    $resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");

    return [
      'data'=>$results,
      'total'=>(int)$resultTotal[0]['nrtotal'],
      'pages'=>ceil($resultTotal[0]['nrtotal']/$itemsPerPage)
    ];

}


 public static function getPageOrigemCiclo($cicloAtual, $origem, $page = 1, $itemsPerPage = 10){

  $data_inicio = $cicloAtual['data_inicio'];
  $data_termino = $cicloAtual['data_termino'];

  $start = ($page-1)*$itemsPerPage;


  $sql = new Sql();
  
  $results = $sql->select("SELECT SQL_CALC_FOUND_ROWS * 
                      FROM empresas WHERE origem_cadastro=:orig OR identificacao=:orig AND dtcadastro_empresa>=:data_inicio AND dtcadastro_empresa<=:data_termino
                      ORDER BY idEmpresas desc
                      limit $start, $itemsPerPage;

                ", array(":orig"=>$origem,
                         ":data_inicio"=>$data_inicio,
                         ":data_termino"=>$data_termino));


    $resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");

    return [
      'data'=>$results,
      'total'=>(int)$resultTotal[0]['nrtotal'],
      'pages'=>ceil($resultTotal[0]['nrtotal']/$itemsPerPage)
    ];

}

public static function getPageSearchOrigemCiclo($cicloAtual, $origem, $search, $page = 1, $itemsPerPage = 15){

  $data_inicio = $cicloAtual['data_inicio'];
  $data_termino = $cicloAtual['data_termino'];

  $start = ($page-1)*$itemsPerPage;


  $sql = new Sql();
  
  $results = $sql->select("SELECT SQL_CALC_FOUND_ROWS * 
                FROM empresas WHERE origem_cadastro=:orig OR identificacao=:orig AND razao_social LIKE :search AND dtcadastro_empresa>=:data_inicio AND dtcadastro_empresa<=:data_termino 
                OR origem_cadastro=:orig OR identificacao=:orig AND nome_fantasia LIKE :search AND dtcadastro_empresa>=:data_inicio AND dtcadastro_empresa<=:data_termino
                OR origem_cadastro=:orig OR identificacao=:orig AND cnpj LIKE :search AND dtcadastro_empresa>=:data_inicio AND dtcadastro_empresa<=:data_termino
                OR origem_cadastro=:orig OR identificacao=:orig AND municipio LIKE :search AND dtcadastro_empresa>=:data_inicio AND dtcadastro_empresa<=:data_termino
                OR origem_cadastro=:orig OR identificacao=:orig AND regiao_estado LIKE :search AND dtcadastro_empresa>=:data_inicio AND dtcadastro_empresa<=:data_termino
                OR origem_cadastro=:orig OR identificacao=:orig AND situacao_associacao LIKE :search AND dtcadastro_empresa>=:data_inicio AND dtcadastro_empresa<=:data_termino
                ORDER BY idEmpresas desc
                limit $start, $itemsPerPage;

                ", array(":search"=>$search.'%', 
                         ":orig"=>$origem,
                         ":data_inicio"=>$data_inicio,
                         ":data_termino"=>$data_termino));


    $resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");

    return [
      'data'=>$results,
      'total'=>(int)$resultTotal[0]['nrtotal'],
      'pages'=>ceil($resultTotal[0]['nrtotal']/$itemsPerPage)
    ];

}


public static function editar($dados, $idempresa){

  $cnpj = $dados['cnpj'];
  $razao_social = $dados['razaoSocial'];
  $nomeFantasia = $dados['nomeFantasia'];
  $sitAssoc = $dados['sitAssoc'];
  $municipio = $dados['campoCidade'];
  $regiao = $dados['CampoRegiao'];
  $bairro = $dados['campoBairro'];
  $endereco = $dados['campoEndereco'];
  $email = $dados['email'];
  $telefone = $dados['campoTelefone'];
  $telefone2 = $dados['campoTelefone2'];
  $nomeContato = $dados['nomeContato'];

  $sql = new Sql();
  $result = $sql->query("UPDATE empresas set cnpj=:cnpj, razao_social=:razao_social, nome_fantasia=:nomeFantasia, situacao_associacao=:sitAssoc,
                        municipio=:municipio, regiao_estado=:regiao, bairro=:bairro, endereco=:endereco, email=:email, nomeContato=:nomeContato, telefone=:telefone, telefone2=:telefone2 WHERE idEmpresas=:idempresa",
                        array(":cnpj"=>$cnpj,
                              ":razao_social"=>$razao_social,
                              ":nomeFantasia"=>$nomeFantasia,
                              ":sitAssoc"=>$sitAssoc,
                              ":municipio"=>$municipio,
                              ":regiao"=>$regiao,
                              ":bairro"=>$bairro,
                              ":endereco"=>$endereco,
                              ":email"=>$email,
                              ":nomeContato"=>$nomeContato,
                              ":telefone"=>$telefone,
                              ":telefone2"=>$telefone2,
                              ":idempresa"=>$idempresa));

  if(!$result){
    throw new Exception('Falha ao editar os dados da empresa, verifique o CNPJ e os outros dados digitados e tente novamente.', 5789);
  }

}






}       // FIM DA CLASSE
