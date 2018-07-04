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
      throw new \Exception('Nenhum ciclo iniciado na data prevista para visita', 600);
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
    return $sql->select("SELECT * FROM funcionario a JOIN visita b JOIN empresas c ON a.idFuncionario=b.idFuncionario AND c.idEmpresas=b.Empresas_idEmpresas order by idVisita desc");
}

public static function listAllOrigem($origem){

    $orig = $origem;

    $sql = new Sql();
    return $sql->select("SELECT * FROM funcionario a JOIN visita b JOIN empresas c ON a.idFuncionario=b.idFuncionario AND c.idEmpresas=b.Empresas_idEmpresas WHERE a.origem=:orig order by idVisita desc", array(":orig"=>$orig));
}


public static function getVisita($idvisita){

    $idVisita = (int)$idvisita;

    $sql = new Sql();
    $result = $sql->select("SELECT * from funcionario join visita join empresas join visita_has_funcionario
 on funcionario.idFuncionario=visita.idFuncionario and visita.Empresas_idEmpresas=empresas.idEmpresas and visita.idVisita=visita_has_funcionario.Visita_idVisita where visita.idVisita =:idVisita", array(":idVisita"=>$idVisita));

    if(count($result)>0){
        return$result;
    }else{

        $sql2 = new Sql();
        $result2 = $sql2->select("select * from funcionario join visita join empresas on funcionario.idFuncionario=visita.idFuncionario and visita.Empresas_idEmpresas=empresas.idEmpresas where visita.idVisita =:idVisita", array(":idVisita"=>$idVisita));

        

        if(count($result2)==0){
            throw new \Exception('Erro ao obter dados da visita', 6007);
        }

        return $result2;
    }
}



public static function atualizaVisita($dados){

     $idVisita = (int)$dados['idVisita'];
     $dataPrevista = $dados['dataVisita'];
     $status_visita = $dados['campoStatus'];
     $demandaInicial = $dados['campoDemanda'];
     $familia_prod = $dados['campoFamilia'];
     $observacao = $dados['campoObservacao'];


     $sql = new Sql();
     $result = $sql->query("UPDATE visita set familia_prod=:familia_prod, demanda_inicial=:demandaInicial, status_visita=:status_visita, data_prevista=:dataPrevista, observacao=:observacao where idVisita=:idVisita", 
        array(":observacao"=>$observacao,
              ":idVisita"=>$idVisita,
              ":dataPrevista"=>$dataPrevista,
              ":status_visita"=>$status_visita,
              ":demandaInicial"=>$demandaInicial,
              ":familia_prod"=>$familia_prod));

   /*  $sql2 = new Sql();
     $query2 = $sql2->query("UPDATE visita SET observacao=:observ WHERE idVisita=:idVisita", 
      array(":observ"=>$observacao,
            ":idVisita"=>$idVisita));*/

    return true;

}



public static function finalizeVisita($dados){


    $idFuncionario = $_SESSION['idFuncionario'];
    $idVisita = $dados['idVisita'];
    $agente_atend = $dados['campoAgenteAtend'];
    $data_realizacao = $dados['dataRealização'];
    $status_negociacao = $dados['campoNegociacao'];
    $familia_prod = $dados['campoFamilia'];
    $valor_prod = $dados['campoValorProduto'];
    $situacaoAssociacao = $dados['sitAssoc'];
    $preco_prod = $dados['campoValorProduto']!==""?$dados['campoValorProduto']:NULL;
    $demandas  = $dados['campoDemandas']!==""?$dados['campoDemandas']:NULL;
    $observacao = $dados['campoObservacao'];


    $sql = new Sql();
    $query = $sql->query("INSERT INTO visita_has_funcionario (visita_idVisita, Funcionario_idFuncionario, agente_atend, data_realizacao, 
                         demanda_ident, status_negociacao, preco_prod, status_associacao) VALUES (
                        :idVisita, :idFuncionario, :agente_atend, :data_realizacao, :demanda_ident, :status_negociacao,
                        :preco_prod, :status_associacao)", 
                        array(":idVisita"=>$idVisita,
                              ":idFuncionario"=>$idFuncionario,
                              ":agente_atend"=>$agente_atend,
                              ":data_realizacao"=>$data_realizacao,
                              ":demanda_ident"=>$demandas,
                              ":status_negociacao"=>$status_negociacao,
                              ":preco_prod"=>$preco_prod,
                              ":status_associacao"=>$situacaoAssociacao));

    var_dump($dados);
    if($dados['campoDemandas'] !== ""){
        $sql2 = new Sql();
        $query2 = $sql2->query("INSERT INTO demandas (idVisita_demandas, demanda) VALUES (:idVisita, :demanda)", 
                            array(":idVisita"=>$idVisita,
                                  ":demanda"=>$demandas));
    }

    $newStatus = "Visita Realizada";

    $sql3 = new Sql();
    $query = $sql3->query("UPDATE visita SET status_visita=:newStatus, observacao=:observacao WHERE idVisita=:idVisita", 
                    array(":newStatus"=>$newStatus,
                          ":observacao"=>$observacao,
                          ":idVisita"=>$idVisita));

}














}       // FIM DA CLASSE
