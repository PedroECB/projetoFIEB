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

    $sql = new Sql();
    $query = $sql->query("INSERT INTO empresas 
      (idFuncionario, Sindicato_idSindicato, cnpj, razao_social, nome_fantasia, situacao_associacao, municipio, regiao_estado, bairro, endereco, email, telefone, telefone2, origem_cadastro)
      VALUES(:idFuncionario, :associadaA, :cnpj, :razaoSocial, :nome_fantasia, :situacaoAssociacao, :municipio, :regiao, :bairro, :endereco, :email, :telefone, :telefone2, :origem_cadastro)",
      array(":idFuncionario"=>$idFuncionario,
            ":associadaA"=>$associadaA,
            ":cnpj"=>$cnpj,
            ":razaoSocial"=>$razaoSocial,
            ":nome_fantasia"=>$nomeFantasia,
            ":situacaoAssociacao"=>$situacaoAssociacao,
            ":municipio"=>$cidade,
            ":regiao"=>$regiao,
            ":bairro"=>$bairro,
            ":endereco"=>$endereco,
            ":email"=>$email,
            ":telefone"=>$telefone,
            ":telefone2"=>$telefone2,
            ":origem_cadastro"=>$origem_func));

    if($query->rowCount() == 0){
      
          $error = $query->errorInfo();

     if($error[1] === 1062){
        throw new \Exception('CNPJ já cadastrado', 7800);
     }else{
      throw new \Exception('Erro ao cadastrar empresa, verifique os dados digitados e tente novamente', 7801);
     }

    }




  }











}       // FIM DA CLASSE
