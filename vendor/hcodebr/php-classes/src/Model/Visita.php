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
    $status_visita = $dados['campoStatus'];

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
     $query2 = $sql2->query("INSERT INTO visita (idCiclo, Empresas_idEmpresas, idFuncionario, data_prevista, status_visita, familia_prod, demanda_inicial, observacao)
       VALUES (:idCiclo, :idEmpresa, :idFuncionario, :dataPrevista, :status_visita, :familia_prod, :demanda_inicial, :observacao)", array(
        ":idCiclo"=>$idCiclo,
        ":idEmpresa"=>$idEmpresa,
        ":idFuncionario"=>$idFuncionario,
        ":dataPrevista"=>$dataPrevista,
        ":status_visita"=>$status_visita,
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
    $demandas  = $dados['campoDemandas'][0]!=="" ? $dados['campoDemandas']:NULL;
    $observacao = $dados['campoObservacao'];

 

    if($demandas !== NULL){
      foreach($demandas as $demanda){
        
        $sql2 = new Sql();
        $query2 = $sql2->query("INSERT INTO demandas (idVisita_demandas, demanda) VALUES (:idVisita, :demanda)", 
                        array(":idVisita"=>$idVisita,
                              ":demanda"=>$demanda));
        }
    }

    $demandasImplode= implode($demandas, "/");




    $sql = new Sql();
    $query = $sql->query("INSERT INTO visita_has_funcionario (visita_idVisita, Funcionario_idFuncionario, agente_atend, data_realizacao, 
                         demanda_ident, status_negociacao, preco_prod, status_associacao) VALUES (
                        :idVisita, :idFuncionario, :agente_atend, :data_realizacao, :demanda_ident, :status_negociacao,
                        :preco_prod, :status_associacao)", 
                        array(":idVisita"=>$idVisita,
                              ":idFuncionario"=>$idFuncionario,
                              ":agente_atend"=>$agente_atend,
                              ":data_realizacao"=>$data_realizacao,
                              ":demanda_ident"=>$demandasImplode,
                              ":status_negociacao"=>$status_negociacao,
                              ":preco_prod"=>$preco_prod,
                              ":status_associacao"=>$situacaoAssociacao));

    

    $newStatus = "Visita Realizada";

    $sql3 = new Sql();
    $query = $sql3->query("UPDATE visita SET status_visita=:newStatus, observacao=:observacao WHERE idVisita=:idVisita", 
                    array(":newStatus"=>$newStatus,
                          ":observacao"=>$observacao,
                          ":idVisita"=>$idVisita));

}

  public static function getPage($page = 1, $itemsPerPage = 15){

  $start = ($page-1)*$itemsPerPage;


  $sql = new Sql();
  
  $results = $sql->select("SELECT SQL_CALC_FOUND_ROWS * 
                      FROM funcionario a JOIN visita b JOIN empresas c ON a.idFuncionario=b.idFuncionario 
                      AND c.idEmpresas=b.Empresas_idEmpresas order by idVisita desc
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
                FROM funcionario a JOIN visita b JOIN empresas c ON a.idFuncionario=b.idFuncionario 
                AND c.idEmpresas=b.Empresas_idEmpresas
                WHERE a.nome_func LIKE :search 
                OR b.status_visita LIKE :search 
                OR c.razao_social LIKE :search
                OR c.nome_fantasia LIKE :search
                OR a.origem LIKE :search
                OR c.municipio LIKE :search 
                ORDER BY idVisita desc
                limit $start, $itemsPerPage;

                ", array(":search"=>'%'.$search.'%'));


    $resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");

    return [
      'data'=>$results,
      'total'=>(int)$resultTotal[0]['nrtotal'],
      'pages'=>ceil($resultTotal[0]['nrtotal']/$itemsPerPage)
    ];

}



  public static function getPageOrigem($origem, $page = 1, $itemsPerPage = 15){

  $start = ($page-1)*$itemsPerPage;


  $sql = new Sql();
  
  $results = $sql->select("SELECT SQL_CALC_FOUND_ROWS * 
                      FROM funcionario a JOIN visita b JOIN empresas c ON a.idFuncionario=b.idFuncionario 
                      AND c.idEmpresas=b.Empresas_idEmpresas AND a.origem =:origem order by idVisita desc
                      limit $start, $itemsPerPage;

                ", array(":origem"=>$origem));


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
                FROM funcionario a JOIN visita b JOIN empresas c ON a.idFuncionario=b.idFuncionario 
                AND c.idEmpresas=b.Empresas_idEmpresas
                WHERE a.nome_func LIKE :search AND a.origem =:origem
                OR b.status_visita LIKE :search AND a.origem =:origem
                OR c.razao_social LIKE :search AND a.origem =:origem
                OR c.nome_fantasia LIKE :search AND a.origem =:origem
                OR a.origem LIKE :search AND a.origem =:origem
                OR c.municipio LIKE :search AND a.origem =:origem
                ORDER BY idVisita desc
                limit $start, $itemsPerPage;

                ", array(":search"=>'%'.$search.'%', ":origem"=>$origem));


    $resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");

    return [
      'data'=>$results,
      'total'=>(int)$resultTotal[0]['nrtotal'],
      'pages'=>ceil($resultTotal[0]['nrtotal']/$itemsPerPage)
    ];

}


public static function exportVisitasGeral($visitas){
  // echo "<pre>";
  //   var_dump($visitas[0]);
  // echo "</pre>";
    $arquivo = 'planilha_Visitas_Geral.xls';

    $html = '';
    $html = "<meta charset='utf-8'>";
    $html .= '<table>';
    $html .= '<tr>';
    $html .= '<td>RESPONSAVEL</td> <td>ORIGEM</td> <td>CNPJ EMPRESA</td> <td>RAZAO SOCIAL</td> <td>NOME FANTASIA</td> <td>STATUS VISITA</td> <td>DATA DE CADASTRO</td> <td> DATA PREVISTA</td> <td>FAMILIA PRODUTO</td> <td>OBSERVACAO</td></tr>';
    
    //$html .= '<tr><td>ID</td><td>NOME</td></tr>';


  foreach ($visitas as $visita) {

    $html .= '<tr><td>'.utf8_decode($visita['nome_func']).'</td><td>'.$visita['origem'].'</td><td>'.
              $visita['cnpj'].'</td><td>'.utf8_decode($visita['razao_social'])."</td><td>".
              utf8_decode($visita['nome_fantasia']).'</td><td>'.utf8_decode($visita['status_visita']).'</td><td>'.
              date('d-m-Y', strtotime($visita['data_de_agendamento'])).'</td><td>'.
              date('d-m-Y', strtotime($visita['data_prevista'])).'</td><td>'.
              utf8_decode($visita['familia_prod']).'</td><td>'.utf8_decode($visita['observacao']).'</td></tr>';

        // echo $visita['nome_func']." ".$visita['origem']." ".$visita['cnpj']." ".$visita['razao_social']." ".$visita['nome_fantasia']." ".$visita['status_visita']." ".date('d-m-Y', strtotime($visita['data_de_agendamento']))." ".date('d-m-Y', strtotime($visita['data_prevista']))." ".$visita['familia_prod']." ".$visita['observacao'];    
  }

   $html .= '</table>';

   // Configurações header para forçar o download
    header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
    header ("Cache-Control: no-cache, must-revalidate");
    header ("Pragma: no-cache");
    header ("Content-type: application/x-msexcel");
    header ("Content-Disposition: attachment; filename=\"{$arquivo}\"" );
    header ("Content-Description: PHP Generated Data" );
    // Envia o conteúdo do arquivo
    echo $html;
    exit;

}


public static function exportVisitasOrigem($visitas){

  $origem = $_SESSION['origem'];

    $arquivo = 'planilha_Visitas_'.$origem.'.xls';

    $html = '';
    $html = "<meta charset='utf-8'>";
    $html .= '<table>';
    $html .= '<tr>';
    $html .= '<td>RESPONSAVEL</td> <td>ORIGEM</td> <td>CNPJ EMPRESA</td> <td>RAZAO SOCIAL</td> <td>NOME FANTASIA</td> <td>STATUS VISITA</td> <td>DATA DE CADASTRO</td> <td> DATA PREVISTA</td> <td>FAMILIA PRODUTO</td> <td>OBSERVACAO</td></tr>';
    
    //$html .= '<tr><td>ID</td><td>NOME</td></tr>';


  foreach ($visitas as $visita) {

    $html .= '<tr><td>'.utf8_decode($visita['nome_func']).'</td><td>'.$visita['origem'].'</td><td>'.
              $visita['cnpj'].'</td><td>'.utf8_decode($visita['razao_social'])."</td><td>".
              utf8_decode($visita['nome_fantasia']).'</td><td>'.utf8_decode($visita['status_visita']).'</td><td>'.
              date('d-m-Y', strtotime($visita['data_de_agendamento'])).'</td><td>'.
              date('d-m-Y', strtotime($visita['data_prevista'])).'</td><td>'.
              utf8_decode($visita['familia_prod']).'</td><td>'.utf8_decode($visita['observacao']).'</td></tr>';

        // echo $visita['nome_func']." ".$visita['origem']." ".$visita['cnpj']." ".$visita['razao_social']." ".$visita['nome_fantasia']." ".$visita['status_visita']." ".date('d-m-Y', strtotime($visita['data_de_agendamento']))." ".date('d-m-Y', strtotime($visita['data_prevista']))." ".$visita['familia_prod']." ".$visita['observacao'];    
  }

   $html .= '</table>';

   // Configurações header para forçar o download
    header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
    header ("Cache-Control: no-cache, must-revalidate");
    header ("Pragma: no-cache");
    header ("Content-type: application/x-msexcel");
    header ("Content-Disposition: attachment; filename=\"{$arquivo}\"" );
    header ("Content-Description: PHP Generated Data" );
    // Envia o conteúdo do arquivo
    echo $html;
    exit;
}







}       // FIM DA CLASSE
