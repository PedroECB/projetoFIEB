<?php 

namespace Hcode\Model;
use \Hcode\DB\Sql;
use \Hcode\Model;

class Visita extends Model{

  private $idVisita;




 public static function SaveVisitaEmp($dados){
 

    $idFuncionario = (int) $_SESSION['idFuncionario'];
    $origem = $_SESSION['origem'];
    $nome_func = $_SESSION['nome'];

    $idEmpresa = (int)$dados['idEmpresa'];
    $dataPrevista = $dados['dataPrevista'];
    $demandaInicial = $dados['campoDemanda'];
    $familia_prod = $dados['campoFamilia'];
    $observacao = $dados['campoObservacao'];

    $cnpj = $dados['cnpj'];
    $razaoSocial = $dados['razaoSocial'];
    $nomeFantasia = $dados['nomeFantasia'];
    $regiao_estado = $dados['campoRegiao'];
    $bairro = $dados['campoBairro'];
    $endereco = $dados['campoEndereco'];
    $email = $dados['email'];
    $telefone = $dados['campoTelefone'];
    $telefone2 = $dados['campoTelefone2'];

    $sql = new Sql();
    $result = $sql->select("SELECT * FROM ciclo WHERE data_inicio<=:dataPrevista and data_termino>=:dataPrevista", array(":dataPrevista"=>$dataPrevista));

    if(count($result)==0){
      throw new \Exception('Nenhum ciclo iniciado para data prevista da visita', 600);
    }

        $idCiclo = (int)$result[0]['idCiclo'];
        

     $sql2 = new Sql();
     $query2 = $sql2->query("INSERT INTO visita (idCiclo, Empresas_idEmpresas, idFuncionario, data_prevista, familia_prod, demanda_inicial, observacao)
       VALUES (:idCiclo, :idEmpresa, :idFuncionario, :dataPrevista, :familia_prod, :demanda_inicial, :observacao)", array(
        ":idCiclo"=>$idCiclo,
        ":idEmpresa"=>$idEmpresa,
        ":idFuncionario"=>$idFuncionario,
        ":dataPrevista"=>$dataPrevista,
        ":familia_prod"=>$familia_prod,
        ":demanda_inicial"=>$demandaInicial,
        ":observacao"=>$observacao));

       if($query2->rowCount() == 0){
        throw new \Exception('Falha ao cadastrar Visita ', 6001);
       } 

        
    



    

    






 }


 public static function SaveVisitaEmp2($dados){

    $dataPrevista = $dados['dataPrevista'];
    $demandaInicial = $dados['campoDemanda'];
    $familia_prod = $dados['campoFamilia'];
    $observacao = $dados['campoObservacao'];


    $idFuncionario = $_SESSION['idFuncionario'];
    $Sindicato_idSindicato = isset($dados['Assoc'])?$dados['Assoc']:NULL;
    $cnpj = $dados['cnpj'];
    $razaoSocial = $dados['razaoSocial'];
    $nomeFantasia = $dados['nomeFantasia'];
    $situacao_associacao = $dados['sitAssoc'];
    $municipio = $dados['campoCidade'];
    $regiao = $dados['campoRegiao'];
    $bairro = $dados['campoBairro'];
    $endereco = $dados['campoEndereco'];
    $email = $dados['email'];
    $telefone = $dados['campoTelefone'];
    $telefone2 = $dados['campoTelefone2'];

    $sql = new Sql();
    $result = $sql->select("SELECT * FROM empresas WHERE cnpj=:cnpj", array(":cnpj"=>$cnpj));

    if(count($result)>0){
        throw new \Exception('CNPJ já cadastrado', 705);
    }else{

        $sql2 = new Sql();
        $query = $sql2->query("INSERT INTO empresas 
      (idFuncionario, Sindicato_idSindicato, cnpj, razao_social, nome_fantasia, situacao_associacao, municipio, regiao_estado, bairro, endereco, email, telefone, telefone2)
      VALUES(:idFuncionario, :associadaA, :cnpj, :razaoSocial, :nome_fantasia, :situacaoAssociacao, :municipio, :regiao, :bairro, :endereco, :email, :telefone, :telefone2)",
      array(":idFuncionario"=>$idFuncionario,
            ":associadaA"=>$Sindicato_idSindicato,
            ":cnpj"=>$cnpj,
            ":razaoSocial"=>$razaoSocial,
            ":nome_fantasia"=>$nomeFantasia,
            ":situacaoAssociacao"=>$situacao_associacao,
            ":municipio"=>$municipio,
            ":regiao"=>$regiao,
            ":bairro"=>$bairro,
            ":endereco"=>$endereco,
            ":email"=>$email,
            ":telefone"=>$telefone,
            ":telefone2"=>$telefone2));

        if($query->rowCount()==0){
            throw new \Exception('Falha ao cadastrar Empresa para visita', 700);
        }

    $sql3 = new Sql();
    $result3 = $sql3->select("SELECT * FROM empresas WHERE cnpj=:cnpj", array(":cnpj"=>$cnpj));

    $idEmpresa = $result3[0]['idEmpresas'];


    $sql4 = new Sql();
    $result4 = $sql4->select("SELECT * FROM ciclo WHERE data_inicio<=:dataPrevista and data_termino>=:dataPrevista", array(":dataPrevista"=>$dataPrevista));

    if(count($result4)==0){
      throw new \Exception('Nenhum ciclo iniciado para data prevista da visita', 600);
    }

    $idCiclo = (int)$result4[0]['idCiclo'];


    $sql5 = new Sql();
    $query = $sql5->query("INSERT INTO visita (idCiclo, Empresas_idEmpresas, idFuncionario, data_prevista, familia_prod, demanda_inicial, observacao)
       VALUES (:idCiclo, :idEmpresa, :idFuncionario, :dataPrevista, :familia_prod, :demanda_inicial, :observacao)", array(
        ":idCiclo"=>$idCiclo,
        ":idEmpresa"=>$idEmpresa,
        ":idFuncionario"=>$idFuncionario,
        ":dataPrevista"=>$dataPrevista,
        ":familia_prod"=>$familia_prod,
        ":demanda_inicial"=>$demandaInicial,
        ":observacao"=>$observacao));


    }



 }



public static function listAll(){

    $sql = new Sql();
    return $sql->select("SELECT * FROM funcionario a JOIN visita b JOIN empresas c ON a.idFuncionario=b.idFuncionario AND c.idEmpresas=b.Empresas_idEmpresas");
}






}       // FIM DA CLASSE
