<?php 



namespace Hcode\Model;
use \Hcode\DB\Sql;
use \Hcode\Model;
use \Hcode\Mailer;

class Casa extends Model{



  private $nome_sindicato;
  private $idSindicato;
  

 

 public static function getNomeCasa($idCasas){


  $sql = new Sql();
  $result = $sql->select("SELECT (nome_casa) FROM casas WHERE idCasas=:idCasas", array(":idCasas"=>$idCasas));
 
  $nomeCasa = $result[0]['nome_casa'];
  
  return $nomeCasa; 


 }


 public static function contEmpresas($origem){

    $sql = new Sql();
    $result = $sql->select("SELECT count(cnpj) from empresas where origem_cadastro=:origem", array(":origem"=>$origem));

    $dados [0]['empresas_selecionadas'] = $result[0]['count(cnpj)'];

    $sql2 = new Sql();
    $result2 = $sql->select("SELECT count(cnpj) from empresas where origem_cadastro=:origem and situacao_associacao='Associada'", array(":origem"=>$origem));

    $dados [0]['empresas_associadas'] = $result2[0]['count(cnpj)'];

    $sql3 = new Sql();
    $result3 = $sql3->select("SELECT count(cnpj) from empresas where origem_cadastro=:origem and situacao_associacao='Não Associada';",array(":origem"=>$origem));

    $dados[0]['nao_associadas'] = $result3[0]['count(cnpj)'];

    $sql4 = new Sql();
    $result4 = $sql4->select("SELECT count(cnpj) from empresas where origem_cadastro=:origem and situacao_associacao='Associação em Negociação';",array(":origem"=>$origem));

    $dados[0]['associacao_em_negociacao'] = $result4[0]['count(cnpj)'];
    
    $sql5 = new Sql();
    $result5 = $sql5->select("SELECT count(cnpj) from empresas where origem_cadastro=:origem and situacao_associacao='Associação Efetivada';",array(":origem"=>$origem));

    $dados[0]['associacaoEfetivada'] = $result5[0]['count(cnpj)'];

    return $dados;
 }

  public static function contEmpresasCiclo($origem, $idciclo, $ciclo){

    $data_inicio = $ciclo[0]['data_inicio'];
    $data_termino = $ciclo[0]['data_termino'];


    $sql = new Sql();
    $result = $sql->select("SELECT count(cnpj) from empresas where origem_cadastro=:origem and dtcadastro_empresa >=:data_inicio and dtcadastro_empresa<=:data_termino", 
      array(":origem"=>$origem,
            ":data_inicio"=>$data_inicio,
            ":data_termino"=>$data_termino));

    $dados [0]['empresas_selecionadas'] = $result[0]['count(cnpj)'];



    $sql2 = new Sql();
    $result2 = $sql->select("SELECT count(cnpj) from empresas where origem_cadastro=:origem and situacao_associacao='Associada' and dtcadastro_empresa >=:data_inicio and dtcadastro_empresa<=:data_termino", 
       array(":origem"=>$origem,
             ":data_inicio"=>$data_inicio,
             ":data_termino"=>$data_termino));

     $dados [0]['empresas_associadas'] = $result2[0]['count(cnpj)'];



     $sql3 = new Sql();
     $result3 = $sql3->select("SELECT count(cnpj) from empresas where origem_cadastro=:origem and situacao_associacao='Não Associada' and dtcadastro_empresa >=:data_inicio and dtcadastro_empresa<=:data_termino;",
       array(":origem"=>$origem,
             ":data_inicio"=>$data_inicio,
             ":data_termino"=>$data_termino));

     $dados[0]['nao_associadas'] = $result3[0]['count(cnpj)'];



     $sql4 = new Sql();
     $result4 = $sql4->select("SELECT count(cnpj) from empresas where origem_cadastro=:origem and situacao_associacao='Associação em Negociação' and dtcadastro_empresa >=:data_inicio and dtcadastro_empresa<=:data_termino;",
        array(":origem"=>$origem,
              ":data_inicio"=>$data_inicio,
              ":data_termino"=>$data_termino));

     $dados[0]['associacao_em_negociacao'] = $result4[0]['count(cnpj)'];
    


     $sql5 = new Sql();
     $result5 = $sql5->select("SELECT count(cnpj) from empresas where origem_cadastro=:origem and situacao_associacao='Associação Efetivada' and dtcadastro_empresa >=:data_inicio and dtcadastro_empresa<=:data_termino;",
      array(":origem"=>$origem,
            ":data_inicio"=>$data_inicio,
            ":data_termino"=>$data_termino));

     $dados[0]['associacaoEfetivada'] = $result5[0]['count(cnpj)'];


     return $dados;
 }



public static function contVisitas($origem){

  $sql = new Sql();
  $result = $sql->select("SELECT count(idVisita) from funcionario join visita on funcionario.idFuncionario=visita.idFuncionario where visita.status_visita='Visita Agendada' and funcionario.origem=:origem", array(":origem"=>$origem));
  $dados [0]['visitas_agendadas'] = $result[0]['count(idVisita)'];

  $sql2 = new Sql();
  $result2 = $sql2->select("SELECT count(idVisita) from funcionario join visita on funcionario.idFuncionario=visita.idFuncionario where visita.status_visita='Sem Ação' and funcionario.origem=:origem", array(":origem"=>$origem));
  $dados [0]['visitas_sem_acao'] = $result2[0]['count(idVisita)'];

  $sql3 = new Sql();
  $result3 = $sql3->select("SELECT count(idVisita) from funcionario join visita on funcionario.idFuncionario=visita.idFuncionario where visita.status_visita='Sem Sucesso no Agendamento' and funcionario.origem=:origem", array(":origem"=>$origem));
  $dados [0]['visitas_sem_sucesso_no_agendamento'] = $result3[0]['count(idVisita)'];

  $sql4 = new Sql();
  $result4 = $sql4->select("SELECT count(idVisita) from funcionario join visita on funcionario.idFuncionario=visita.idFuncionario where visita.status_visita='Visita Realizada' and funcionario.origem=:origem", array(":origem"=>$origem));
  $dados [0]['visitas_realizadas'] = $result4[0]['count(idVisita)'];

  $sql4 = new Sql();
  $result4 = $sql4->select("SELECT count(idVisita) from funcionario join visita on funcionario.idFuncionario=visita.idFuncionario where visita.status_visita='Empresa Desativada' and funcionario.origem=:origem", array(":origem"=>$origem));
  $dados [0]['empresa_desativada'] = $result4[0]['count(idVisita)'];

  $sql5 = new Sql();
  $result5 = $sql5->select("SELECT count(idVisita) from funcionario join visita  join visita_has_funcionario on funcionario.idFuncionario = visita.idFuncionario and visita.idVisita=visita_has_funcionario.Visita_idVisita where funcionario.origem =:origem and visita_has_funcionario.status_negociacao='Negociada';", array(":origem"=>$origem));
  $dados [0]['negociadas'] = $result5[0]['count(idVisita)'];

  $sql6 = new Sql();
  $result6 = $sql6->select("SELECT count(idVisita) from funcionario join visita  join visita_has_funcionario on funcionario.idFuncionario = visita.idFuncionario and visita.idVisita=visita_has_funcionario.Visita_idVisita where funcionario.origem =:origem and visita_has_funcionario.status_negociacao='Não Negociada';", array(":origem"=>$origem));
  $dados [0]['nao_negociadas'] = $result6[0]['count(idVisita)'];

  return $dados;
}

public static function contVisitasCiclo($origem, $idciclo, $ciclo){

  $data_inicio = $ciclo[0]['data_inicio'];
  $data_termino = $ciclo[0]['data_termino'];

  $sql = new Sql();
  $result = $sql->select("SELECT count(idVisita) from funcionario join visita on funcionario.idFuncionario=visita.idFuncionario where visita.status_visita='Visita Agendada' and funcionario.origem=:origem and data_prevista>=:data_inicio and data_prevista<=:data_termino", 
    array(":origem"=>$origem,
          ":data_inicio"=>$data_inicio,
          ":data_termino"=>$data_termino));

  $dados [0]['visitas_agendadas'] = $result[0]['count(idVisita)'];

  $sql2 = new Sql();
  $result2 = $sql2->select("SELECT count(idVisita) from funcionario join visita on funcionario.idFuncionario=visita.idFuncionario where visita.status_visita='Sem Ação' and funcionario.origem=:origem and data_prevista>=:data_inicio and data_prevista<=:data_termino", 
    array(":origem"=>$origem,
          ":data_inicio"=>$data_inicio,
          ":data_termino"=>$data_termino));

  $dados [0]['visitas_sem_acao'] = $result2[0]['count(idVisita)'];

  $sql3 = new Sql();
  $result3 = $sql3->select("SELECT count(idVisita) from funcionario join visita on funcionario.idFuncionario=visita.idFuncionario where visita.status_visita='Sem Sucesso no Agendamento' and funcionario.origem=:origem and data_prevista>=:data_inicio and data_prevista<=:data_termino",
    array(":origem"=>$origem,
          ":data_inicio"=>$data_inicio,
          ":data_termino"=>$data_termino));

  $dados [0]['visitas_sem_sucesso_no_agendamento'] = $result3[0]['count(idVisita)'];

  $sql4 = new Sql();
  $result4 = $sql4->select("SELECT count(idVisita) from funcionario join visita on funcionario.idFuncionario=visita.idFuncionario where visita.status_visita='Visita Realizada' and funcionario.origem=:origem and data_prevista>=:data_inicio and data_prevista<=:data_termino", 
    array(":origem"=>$origem,
          ":data_inicio"=>$data_inicio,
          ":data_termino"=>$data_termino));

  $dados [0]['visitas_realizadas'] = $result4[0]['count(idVisita)'];

  $sql4 = new Sql();
  $result4 = $sql4->select("SELECT count(idVisita) from funcionario join visita on funcionario.idFuncionario=visita.idFuncionario where visita.status_visita='Empresa Desativada' and funcionario.origem=:origem and data_prevista>=:data_inicio and data_prevista<=:data_termino", 
    array(":origem"=>$origem,
          ":data_inicio"=>$data_inicio,
          ":data_termino"=>$data_termino));

  $dados [0]['empresa_desativada'] = $result4[0]['count(idVisita)'];



   $sql5 = new Sql();
   $result5 = $sql5->select("SELECT count(idVisita) from funcionario join visita  join visita_has_funcionario on funcionario.idFuncionario = visita.idFuncionario and visita.idVisita=visita_has_funcionario.Visita_idVisita where funcionario.origem =:origem and visita_has_funcionario.status_negociacao='Negociada' and visita_has_funcionario.data_realizacao >=:data_inicio and visita_has_funcionario.data_realizacao<=:data_termino;", 
     array(":origem"=>$origem,
           ":data_inicio"=>$data_inicio,
           ":data_termino"=>$data_termino));

   $dados [0]['negociadas'] = $result5[0]['count(idVisita)'];

   

   $sql6 = new Sql();
   $result6 = $sql6->select("SELECT count(idVisita) from funcionario join visita  join visita_has_funcionario on funcionario.idFuncionario = visita.idFuncionario and visita.idVisita=visita_has_funcionario.Visita_idVisita where funcionario.origem =:origem and visita_has_funcionario.status_negociacao='Não Negociada' and visita_has_funcionario.data_realizacao >=:data_inicio and visita_has_funcionario.data_realizacao<=:data_termino", 
     array(":origem"=>$origem,
           ":data_inicio"=>$data_inicio,
           ":data_termino"=>$data_termino));

    $dados [0]['nao_negociadas'] = $result6[0]['count(idVisita)'];

     return $dados;
}

public static function relatorioGeral($casas = array()){

  $cont = 0;
  $dados = array();



  foreach ($casas as $casa) {
      
    $origem = $casa['nome_casa'];
                                        // Retorna a quantidade de empresas selecionadas por uma casa
    $sql = new Sql();
    $result = $sql->select("SELECT count(cnpj) from empresas where origem_cadastro=:origem", array(":origem"=>$origem));

    $dados [$cont]['nome_casa'] = $origem;
    $dados [$cont]['empresas_selecionadas'] = $result[0]['count(cnpj)'];

    
    $sql2 = new Sql();
    $result2 = $sql2->select("SELECT count(idVisita) from funcionario join visita on funcionario.idFuncionario=visita.idFuncionario where visita.status_visita='Visita Realizada' and funcionario.origem=:origem", array(":origem"=>$origem));
    $dados [$cont]['visitas_realizadas'] = $result2[0]['count(idVisita)'];


    $sql3 = new Sql();
    $result3 = $sql3->select("SELECT count(idVisita) from funcionario join visita on funcionario.idFuncionario=visita.idFuncionario where visita.status_visita='Visita Agendada' and funcionario.origem=:origem", array(":origem"=>$origem));
    
    $dados[$cont]['visitas_agendadas'] = $result3[0]['count(idVisita)'];


    $sql4 = new Sql();
    $result4 = $sql4->select("SELECT count(idVisita) from funcionario join visita  join visita_has_funcionario on funcionario.idFuncionario = visita.idFuncionario and visita.idVisita=visita_has_funcionario.Visita_idVisita where funcionario.origem =:origem and visita_has_funcionario.status_negociacao='Negociada';", array(":origem"=>$origem));
    
    $dados[$cont]['negociadas'] = $result4[0]['count(idVisita)'];


    $sql5 = new Sql();
    $result5 = $sql5->select("SELECT count(idVisita) from funcionario join visita  join visita_has_funcionario on funcionario.idFuncionario = visita.idFuncionario and visita.idVisita=visita_has_funcionario.Visita_idVisita where funcionario.origem =:origem and visita_has_funcionario.status_negociacao='Negociação em Andamento';", array(":origem"=>$origem));
    
    $dados[$cont]['negociacoes_em_andamento'] = $result5[0]['count(idVisita)'];


    $sql6 = new Sql();
    $result6 = $sql6->select("SELECT count(idVisita) from funcionario join visita on funcionario.idFuncionario=visita.idFuncionario where funcionario.origem=:origem", array(":origem"=>$origem));

    $dados[$cont]['totalVisitas'] = $result6[0]['count(idVisita)'];




    $cont++;
  }


    return $dados;

}


public function getTotaisCasas($dadosCasas){

  $totais = array();

  $total_empresas_selecionadas = 0;
  $total_visitas_realizadas = 0;
  $total_visitas_agendadas = 0;
  $total_negociadas = 0;
  $total_negociacao_em_andamento = 0;
  $total_total_visitas = 0;
  $total_total_visitas = 0; 



  foreach ($dadosCasas as $dadosCasa) {
      
      $total_empresas_selecionadas += $dadosCasa['empresas_selecionadas'];
      $total_visitas_realizadas += $dadosCasa['visitas_realizadas'];
      $total_visitas_agendadas += $dadosCasa['visitas_agendadas'];
      $total_negociadas += $dadosCasa['negociadas'];
      $total_negociacao_em_andamento += $dadosCasa['negociacoes_em_andamento'];
      $total_total_visitas += $dadosCasa['totalVisitas'];

      
  }

  $totais['total_empresas_selecionadas'] = $total_empresas_selecionadas;
  $totais['total_visitas_realizadas'] = $total_visitas_realizadas;
  $totais['total_visitas_agendadas'] = $total_visitas_agendadas;
  $totais['total_negociadas'] = $total_negociadas;
  $totais['total_negociacao_em_andamento'] = $total_negociacao_em_andamento;
  $totais['total_total_visitas'] = $total_total_visitas;



  return $totais;
}



public static function somaTotal($dadosTotaisCasas, $dadosTotaisSindicatos){

  $somaTotal = array();

$somaTotal['soma_empresas_selecionadas'] = $dadosTotaisCasas['total_empresas_selecionadas'] + $dadosTotaisSindicatos['total_empresas_selecionadas'];

$somaTotal['soma_visitas_realizadas'] = $dadosTotaisCasas['total_visitas_realizadas'] + $dadosTotaisSindicatos['total_visitas_realizadas'];

$somaTotal['soma_visitas_agendadas'] = $dadosTotaisCasas['total_visitas_agendadas'] + $dadosTotaisSindicatos['total_visitas_agendadas'];

$somaTotal['negociadas'] = $dadosTotaisCasas['total_negociadas'];

$somaTotal['negociacoes_em_andamento'] = $dadosTotaisCasas['total_negociacao_em_andamento'];

$somaTotal['associacao_em_negociacao'] = $dadosTotaisSindicatos['total_associacao_em_negociacao'];

$somaTotal['associacaoEfetivada'] = $dadosTotaisSindicatos['total_associacaoEfetivada'];
 
  var_dump($dadosTotaisCasas);
  echo "<hr>";
  var_dump($dadosTotaisSindicatos);
  echo "<hr>";
  var_dump($somaTotal);


return $somaTotal;

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
