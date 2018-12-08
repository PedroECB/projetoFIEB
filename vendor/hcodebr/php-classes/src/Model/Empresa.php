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


public static function exportEmpresasGeral($empresas){

    $arquivo = 'Planilha_Empresas_Geral.xls';

    $html = '';
    $html = "<meta charset='utf-8'>";
    $html .= '<table>';
    $html .= '<tr>';
    $html .= '<td>CNPJ</td> <td>RAZAO SOCIAL</td> <td>NOME FANTASIA</td> <td>SITUACAO ASSOCIACAO</td> <td>MUNICIPIO</td> <td>REGIAO</td> <td>BAIRRO</td> <td> ENDERECO</td> <td>EMAIL</td> <td> NOME CONTATO</td> <td> TELEFONE</td> <td> TELEFONE ALTERNATIVO</td> <td> ENTIDADE RESPONSAVEL</td></tr>';
    


  foreach ($empresas as $empresa){

    $html .= '<tr><td>'.$empresa['cnpj'].'</td><td>'.utf8_decode($empresa['razao_social']).'</td><td>'.
              utf8_decode($empresa['nome_fantasia']).'</td><td>'.utf8_decode($empresa['situacao_associacao'])."</td><td>".
              utf8_decode($empresa['municipio']).'</td><td>'.utf8_decode($empresa['regiao_estado']).'</td><td>'.
              utf8_decode($empresa['bairro']).'</td><td>'.
              utf8_decode($empresa['endereco']).'</td><td>'.
              utf8_decode($empresa['email']).'</td><td>'.
              utf8_decode($empresa['nomeContato']).'</td><td>'.$empresa['telefone'].'</td><td>'.$empresa['telefone2'].'</td><td>'.utf8_decode($empresa['origem_cadastro']).'</td></tr>';

    // echo $empresa['cnpj']." ".$empresa['razao_social']." ".$empresa['nome_fantasia']." ".$empresa['situacao_associacao']." ".$empresa['municipio']." ".$empresa['regiao_estado']." ".$empresa['bairro']." ".$empresa['endereco']." ".$empresa['email']." ".$empresa['nomeContato']." ".$empresa['telefone']." ".$empresa['telefone2']." ".$empresa['origem_cadastro'];    
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



public static function listAllCicloAtual($cicloAtual){

  $data_inicio = $cicloAtual['data_inicio'];
  $data_termino = $cicloAtual['data_termino'];

  $sql = new Sql();
  
  $results = $sql->select("SELECT * FROM empresas WHERE dtcadastro_empresa>=:data_inicio and dtcadastro_empresa<=:data_termino ORDER BY idEmpresas desc",
                   array(":data_inicio"=>$data_inicio,
                         "data_termino"=>$data_termino));


  return $results;
}


public static function exportEmpresasCicloAtual($empresas){

    $arquivo = 'Planilha_Empresas_Geral_Ciclo_Atual.xls';

    $html = '';
    $html = "<meta charset='utf-8'>";
    $html .= '<table>';
    $html .= '<tr>';
    $html .= '<td>CNPJ</td> <td>RAZAO SOCIAL</td> <td>NOME FANTASIA</td> <td>SITUACAO ASSOCIACAO</td> <td>MUNICIPIO</td> <td>REGIAO</td> <td>BAIRRO</td> <td> ENDERECO</td> <td>EMAIL</td> <td> NOME CONTATO</td> <td> TELEFONE</td> <td> TELEFONE ALTERNATIVO</td> <td> ENTIDADE RESPONSAVEL</td></tr>';
    


  foreach ($empresas as $empresa){

    $html .= '<tr><td>'.$empresa['cnpj'].'</td><td>'.utf8_decode($empresa['razao_social']).'</td><td>'.
              utf8_decode($empresa['nome_fantasia']).'</td><td>'.utf8_decode($empresa['situacao_associacao'])."</td><td>".
              utf8_decode($empresa['municipio']).'</td><td>'.utf8_decode($empresa['regiao_estado']).'</td><td>'.
              utf8_decode($empresa['bairro']).'</td><td>'.
              utf8_decode($empresa['endereco']).'</td><td>'.
              utf8_decode($empresa['email']).'</td><td>'.
              utf8_decode($empresa['nomeContato']).'</td><td>'.$empresa['telefone'].'</td><td>'.$empresa['telefone2'].'</td><td>'.utf8_decode($empresa['origem_cadastro']).'</td></tr>';

    // echo $empresa['cnpj']." ".$empresa['razao_social']." ".$empresa['nome_fantasia']." ".$empresa['situacao_associacao']." ".$empresa['municipio']." ".$empresa['regiao_estado']." ".$empresa['bairro']." ".$empresa['endereco']." ".$empresa['email']." ".$empresa['nomeContato']." ".$empresa['telefone']." ".$empresa['telefone2']." ".$empresa['origem_cadastro'];    
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

public static function exportEmpresasCicloAtualOrigem($empresas){


    $origem = $_SESSION['origem'];

    $arquivo = 'Planilha_Empresas_'.$origem.'_Ciclo_Atual.xls';

    $html = '';
    $html = "<meta charset='utf-8'>";
    $html .= '<table>';
    $html .= '<tr>';
    $html .= '<td>CNPJ</td> <td>RAZAO SOCIAL</td> <td>NOME FANTASIA</td> <td>SITUACAO ASSOCIACAO</td> <td>MUNICIPIO</td> <td>REGIAO</td> <td>BAIRRO</td> <td> ENDERECO</td> <td>EMAIL</td> <td> NOME CONTATO</td> <td> TELEFONE</td> <td> TELEFONE ALTERNATIVO</td> <td> ENTIDADE RESPONSAVEL</td></tr>';
    


  foreach ($empresas as $empresa){

    $html .= '<tr><td>'.$empresa['cnpj'].'</td><td>'.utf8_decode($empresa['razao_social']).'</td><td>'.
              utf8_decode($empresa['nome_fantasia']).'</td><td>'.utf8_decode($empresa['situacao_associacao'])."</td><td>".
              utf8_decode($empresa['municipio']).'</td><td>'.utf8_decode($empresa['regiao_estado']).'</td><td>'.
              utf8_decode($empresa['bairro']).'</td><td>'.
              utf8_decode($empresa['endereco']).'</td><td>'.
              utf8_decode($empresa['email']).'</td><td>'.
              utf8_decode($empresa['nomeContato']).'</td><td>'.$empresa['telefone'].'</td><td>'.$empresa['telefone2'].'</td><td>'.utf8_decode($empresa['origem_cadastro']).'</td></tr>';

    // echo $empresa['cnpj']." ".$empresa['razao_social']." ".$empresa['nome_fantasia']." ".$empresa['situacao_associacao']." ".$empresa['municipio']." ".$empresa['regiao_estado']." ".$empresa['bairro']." ".$empresa['endereco']." ".$empresa['email']." ".$empresa['nomeContato']." ".$empresa['telefone']." ".$empresa['telefone2']." ".$empresa['origem_cadastro'];    
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


public static function exportEmpresasOrigem($empresas){


    $origem = $_SESSION['origem'];

    $arquivo = 'Planilha_Empresas_'.$origem.'.xls';

    $html = '';
    $html = "<meta charset='utf-8'>";
    $html .= '<table>';
    $html .= '<tr>';
    $html .= '<td>CNPJ</td> <td>RAZAO SOCIAL</td> <td>NOME FANTASIA</td> <td>SITUACAO ASSOCIACAO</td> <td>MUNICIPIO</td> <td>REGIAO</td> <td>BAIRRO</td> <td> ENDERECO</td> <td>EMAIL</td> <td> NOME CONTATO</td> <td> TELEFONE</td> <td> TELEFONE ALTERNATIVO</td> <td> ENTIDADE RESPONSAVEL</td></tr>';
    


  foreach ($empresas as $empresa){

    $html .= '<tr><td>'.$empresa['cnpj'].'</td><td>'.utf8_decode($empresa['razao_social']).'</td><td>'.
              utf8_decode($empresa['nome_fantasia']).'</td><td>'.utf8_decode($empresa['situacao_associacao'])."</td><td>".
              utf8_decode($empresa['municipio']).'</td><td>'.utf8_decode($empresa['regiao_estado']).'</td><td>'.
              utf8_decode($empresa['bairro']).'</td><td>'.
              utf8_decode($empresa['endereco']).'</td><td>'.
              utf8_decode($empresa['email']).'</td><td>'.
              utf8_decode($empresa['nomeContato']).'</td><td>'.$empresa['telefone'].'</td><td>'.$empresa['telefone2'].'</td><td>'.utf8_decode($empresa['origem_cadastro']).'</td></tr>';

    // echo $empresa['cnpj']." ".$empresa['razao_social']." ".$empresa['nome_fantasia']." ".$empresa['situacao_associacao']." ".$empresa['municipio']." ".$empresa['regiao_estado']." ".$empresa['bairro']." ".$empresa['endereco']." ".$empresa['email']." ".$empresa['nomeContato']." ".$empresa['telefone']." ".$empresa['telefone2']." ".$empresa['origem_cadastro'];    
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


public static function listAllCicloAtualOrigem($cicloAtual, $origem){

  $data_inicio = $cicloAtual['data_inicio'];
  $data_termino = $cicloAtual['data_termino'];

  $sql = new Sql();
  return $sql->select("SELECT * FROM empresas WHERE origem_cadastro=:orig AND dtcadastro_empresa>=:data_inicio AND dtcadastro_empresa<=:data_termino ORDER BY idEmpresas DESC;", 
        array(":orig"=>$origem,
              ":data_inicio"=>$data_inicio,
              ":data_termino"=>$data_termino)); 

}


public static function getDadosRegiao(){

  //SELECT regiao_estado, count(idEmpresas) FROM empresas GROUP BY regiao_estado

  // select empresas.regiao_estado, empresas.razao_social, count(idVisita) from visita join empresas WHERE visita.Empresas_idEmpresas=empresas.idEmpresas GROUP BY empresas.regiao_estado;

  //select empresas.regiao_estado, Count(DISTINCT(empresas.cnpj)) FROM empresas JOIN visita WHERE empresas.idEmpresas=visita.Empresas_idEmpresas and visita.status_visita='Visita Realizada' GROUP by empresas.regiao_estado


  //select empresas.regiao_estado, COUNT(visita.idVisita) FROM empresas JOIN visita WHERE empresas.idEmpresas=visita.Empresas_idEmpresas GROUP by empresas.regiao_estado

  //select empresas.regiao_estado, COUNT(visita.idVisita) FROM empresas JOIN visita WHERE empresas.idEmpresas=visita.Empresas_idEmpresas and visita.status_visita='Visita Realizada' GROUP by empresas.regiao_estado

  $dadosRegioes = array();
  $cont = 0;

  $sql = new Sql();
  $regioes = $sql->select("SELECT regiao_estado, count(idEmpresas) FROM empresas GROUP BY regiao_estado");

  foreach ($regioes as $regiao) {

        // $regiao['regiao_estado'] = 'Norte';
      
     // echo $regiao['regiao_estado']." - ".$regiao['count(idEmpresas)']."<br>";


      $sql2 = new Sql();
      $regioes2 = $sql2->select("SELECT empresas.regiao_estado, Count(DISTINCT(empresas.cnpj)) FROM empresas JOIN visita WHERE empresas.idEmpresas=visita.Empresas_idEmpresas and empresas.regiao_estado=:regiao and visita.status_visita='Visita Realizada' GROUP by empresas.regiao_estado
", array(":regiao"=>$regiao['regiao_estado']));

      
      $dadosRegioes[$cont]['regiao_estado'] = $regiao['regiao_estado'];
      $dadosRegioes[$cont]['empresas_totais'] = $regiao['count(idEmpresas)'];
      $dadosRegioes[$cont]['empresas_visitadas'] = isset($regioes2[0]['Count(DISTINCT(empresas.cnpj))']) ? $regioes2[0]['Count(DISTINCT(empresas.cnpj))']:0;

      $cont++;
  }

  return $dadosRegioes;


}



public static function getDadosRegiaoCiclo($ciclo){

  $data_inicio = $ciclo[0]['data_inicio'];
  $data_termino = $ciclo[0]['data_termino'];

  //SELECT regiao_estado, count(idEmpresas) FROM empresas GROUP BY regiao_estado

  // select empresas.regiao_estado, empresas.razao_social, count(idVisita) from visita join empresas WHERE visita.Empresas_idEmpresas=empresas.idEmpresas GROUP BY empresas.regiao_estado;

  //select empresas.regiao_estado, Count(DISTINCT(empresas.cnpj)) FROM empresas JOIN visita WHERE empresas.idEmpresas=visita.Empresas_idEmpresas and visita.status_visita='Visita Realizada' GROUP by empresas.regiao_estado


  //select empresas.regiao_estado, COUNT(visita.idVisita) FROM empresas JOIN visita WHERE empresas.idEmpresas=visita.Empresas_idEmpresas GROUP by empresas.regiao_estado

  //select empresas.regiao_estado, COUNT(visita.idVisita) FROM empresas JOIN visita WHERE empresas.idEmpresas=visita.Empresas_idEmpresas and visita.status_visita='Visita Realizada' GROUP by empresas.regiao_estado

  $dadosRegioes = array();
  $cont = 0;

  $sql = new Sql();
  $regioes = $sql->select("SELECT regiao_estado, count(idEmpresas) FROM empresas WHERE dtcadastro_empresa >=:data_inicio and dtcadastro_empresa<=:data_termino GROUP BY regiao_estado", array(":data_inicio"=>$data_inicio, ":data_termino"=>$data_termino));

  foreach ($regioes as $regiao) {

        // $regiao['regiao_estado'] = 'Norte';
      
     // echo $regiao['regiao_estado']." - ".$regiao['count(idEmpresas)']."<br>";


      $sql2 = new Sql();
      $regioes2 = $sql2->select("SELECT empresas.regiao_estado, Count(DISTINCT(empresas.cnpj)) FROM empresas JOIN visita WHERE empresas.idEmpresas=visita.Empresas_idEmpresas and empresas.regiao_estado=:regiao and visita.status_visita='Visita Realizada' and data_prevista>=:data_inicio and data_prevista<=:data_termino GROUP by empresas.regiao_estado
", array(":regiao"=>$regiao['regiao_estado'],
         ":data_inicio"=>$data_inicio,
         ":data_termino"=>$data_termino));

      
      $dadosRegioes[$cont]['regiao_estado'] = $regiao['regiao_estado'];
      $dadosRegioes[$cont]['empresas_totais'] = $regiao['count(idEmpresas)'];
      $dadosRegioes[$cont]['empresas_visitadas'] = isset($regioes2[0]['Count(DISTINCT(empresas.cnpj))']) ? $regioes2[0]['Count(DISTINCT(empresas.cnpj))']:0;

      $cont++;
  }

  return $dadosRegioes;


}

//SELECT count(*) from visita join visita_has_funcionario join demandas where visita.idVisita=visita_has_funcionario.Visita_idVisita and visita_has_funcionario.Visita_idVisita=demandas.idVisita_demandas and visita_has_funcionario.data_realizacao >=:data_inicio and visita_has_funcionario.data_realizacao<=:data_termino; 


public static function getDadosMetas($ciclo, $dadosTotaisCasas, $dadosTotaisSindicatos, $dadosReceita, $somaTotal){

$data_inicio = $ciclo[0]['data_inicio'];
$data_termino = $ciclo[0]['data_termino'];



$dadosMetas = array();

 $sql1 = new Sql();
 $result1 = $sql1->select("SELECT Count(DISTINCT(empresas.cnpj)) FROM empresas JOIN visita WHERE empresas.idEmpresas=visita.Empresas_idEmpresas and visita.status_visita='Visita Realizada' and data_prevista>=:data_inicio and data_prevista<=:data_termino
", array(":data_inicio"=>$data_inicio,
         ":data_termino"=>$data_termino));


   $dadosMetas['percentual_visitadas'] = $somaTotal['soma_empresas_selecionadas']>0?$result1[0]["Count(DISTINCT(empresas.cnpj))"]*100/$somaTotal['soma_empresas_selecionadas']: 0;
   $dadosMetas['distinct_visitadas'] = $result1[0]["Count(DISTINCT(empresas.cnpj))"];
   $dadosMetas['percentual_associacoes'] = $ciclo[0]['novas_associacoes']>0 ? $dadosTotaisSindicatos['total_associacaoEfetivada']*100/$ciclo[0]['novas_associacoes']:0;



   $sql2 = new Sql();
   $result2 = $sql2->select("SELECT count(*) from visita join visita_has_funcionario join demandas where visita.idVisita=visita_has_funcionario.Visita_idVisita and visita_has_funcionario.Visita_idVisita=demandas.idVisita_demandas and visita_has_funcionario.data_realizacao >=:data_inicio and visita_has_funcionario.data_realizacao<=:data_termino
", array(":data_inicio"=>$data_inicio,
         ":data_termino"=>$data_termino));

   $dadosMetas['percentual_propostas_demandadas'] = $result2[0]["count(*)"];


  $sql3 = new Sql();
  $result3 = $sql3->select("SELECT count(*) from visita join visita_has_funcionario WHERE visita.idVisita=visita_has_funcionario.Visita_idVisita and visita_has_funcionario.status_associacao='Interesse em Associar-se'
 and visita_has_funcionario.data_realizacao >=:data_inicio and visita_has_funcionario.data_realizacao<=:data_termino
", array(":data_inicio"=>$data_inicio,
         ":data_termino"=>$data_termino));

  $dadosMetas['percentual_interesse_em_assoc'] = $ciclo[0]['interesse_em_assoc']> 0 ? $result3[0]['count(*)']*100/$ciclo[0]['interesse_em_assoc']: 0;








return $dadosMetas;




}






}       // FIM DA CLASSE
