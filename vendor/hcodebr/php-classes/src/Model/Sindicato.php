<?php 



namespace Hcode\Model;
use \Hcode\DB\Sql;
use \Hcode\Model;
use \Hcode\Mailer;

class Sindicato extends Model{



  private $nome_sindicato;
  private $idSindicato;
  

 

 public static function getNomeSindicato($idSindicato){


  $sql = new Sql();
  $result = $sql->select("SELECT (nome_sindicato) FROM sindicato WHERE idSindicato=:idSindicato", array(":idSindicato"=>$idSindicato));

    $nomeSindicato = $result[0]['nome_sindicato'];

    return $nomeSindicato;


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
    $result5 = $sql5->select("SELECT count(idVisita) from funcionario join visita  join visita_has_funcionario on funcionario.idFuncionario = visita.idFuncionario and visita.idVisita=visita_has_funcionario.Visita_idVisita where funcionario.origem =:origem and visita_has_funcionario.status_associacao='Associação Efetivada';",array(":origem"=>$origem));

    $dados[0]['associacaoEfetivada'] = $result5[0]['count(idVisita)'];

    return $dados;
 }

 public static function contEmpresasCiclo($origem, $idciclo, $ciclo){

    $data_inicio = $ciclo[0]['data_inicio'];
    $data_termino = $ciclo[0]['data_termino'];

    // var_dump($ciclo[0]);
    // var_dump($idciclo);
    // var_dump($data_inicio);


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
     $result3 = $sql3->select("SELECT count(cnpj) from empresas where origem_cadastro=:origem and situacao_associacao='Não Associada' and dtcadastro_empresa >=:data_inicio and dtcadastro_empresa<=:data_termino",
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
       $result5 = $sql5->select("SELECT count(idVisita) from funcionario join visita  join visita_has_funcionario on funcionario.idFuncionario = visita.idFuncionario and visita.idVisita=visita_has_funcionario.Visita_idVisita where funcionario.origem =:origem and visita_has_funcionario.status_associacao='Associação Efetivada' and visita_has_funcionario.data_realizacao >=:data_inicio and visita_has_funcionario.data_realizacao<=:data_termino",
       array(":origem"=>$origem,
             ":data_inicio"=>$data_inicio,
             ":data_termino"=>$data_termino));

      $dados[0]['associacaoEfetivada'] = $result5[0]['count(idVisita)'];


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

  
    return $dados;
}


public static function relatorioGeral($sindicatos = array()){

  $cont = 0;
  $dados = array();

  // for($i=0; $i<count($sindicatos);$i++){

  //   echo $sindicatos[$i]['nome_sindicato'];
  // }

  foreach ($sindicatos as $sindicato) {
      
    $origem = $sindicato['nome_sindicato'];
                                                          // Retorna a quantidade de empresas selecionadas por um sindicato
    $sql = new Sql();
    $result = $sql->select("SELECT count(cnpj) from empresas where origem_cadastro=:origem", array(":origem"=>$origem));

    $dados [$cont]['nomeSindicato'] = $origem;
    $dados [$cont]['empresas_selecionadas'] = $result[0]['count(cnpj)'];


    $sql2 = new Sql();
    $result2 = $sql2->select("SELECT count(idVisita) from funcionario join visita on funcionario.idFuncionario=visita.idFuncionario where visita.status_visita='Visita Realizada' and funcionario.origem=:origem", array(":origem"=>$origem));
    
    $dados [$cont]['visitas_realizadas'] = $result2[0]['count(idVisita)'];


    $sql3 = new Sql();
    $result3 = $sql3->select("SELECT count(idVisita) from funcionario join visita on funcionario.idFuncionario=visita.idFuncionario where visita.status_visita='Visita Agendada' and funcionario.origem=:origem", array(":origem"=>$origem));
    $dados [$cont]['visitas_agendadas'] = $result3[0]['count(idVisita)'];


     $sql4 = new Sql();
     $result4 = $sql4->select("SELECT count(cnpj) from empresas where origem_cadastro=:origem and situacao_associacao='Em Andamento'", array(":origem"=>$origem));

    $dados [$cont]['EmAndamento'] = $result4[0]['count(cnpj)'];


    $sql5 = new Sql();
    $result5 = $sql5->select("SELECT count(cnpj) from empresas where origem_cadastro=:origem and situacao_associacao='Associação em Negociação';",array(":origem"=>$origem));

    $dados[$cont]['associacao_em_negociacao'] = $result5[0]['count(cnpj)'];


    $sql6 = new Sql();
    $result6 = $sql6->select("SELECT count(idVisita) from funcionario join visita  join visita_has_funcionario on funcionario.idFuncionario = visita.idFuncionario and visita.idVisita=visita_has_funcionario.Visita_idVisita where funcionario.origem =:origem and visita_has_funcionario.status_associacao='Associação Efetivada';",array(":origem"=>$origem));

    $dados[$cont]['associacaoEfetivada'] = $result6[0]['count(idVisita)'];

  
    $sql7 = new Sql();
    $result7 = $sql7->select("SELECT count(idVisita) from funcionario join visita on funcionario.idFuncionario=visita.idFuncionario where funcionario.origem=:origem", array(":origem"=>$origem));
    $dados[$cont]['totalVisitas'] = $result7[0]['count(idVisita)'];
 





    $cont++;
  }

    return $dados;

}

public static function relatorioGeralCiclo($sindicatos = array(), $ciclo){

  $data_inicio = $ciclo[0]['data_inicio'];
  $data_termino = $ciclo[0]['data_termino'];

  $cont = 0;
  $dados = array();



  foreach ($sindicatos as $sindicato) {
      
    $origem = $sindicato['nome_sindicato'];
                                                          // Retorna a quantidade de empresas selecionadas por um sindicato
    $sql = new Sql();
    $result = $sql->select("SELECT count(cnpj) from empresas where origem_cadastro=:origem and dtcadastro_empresa >=:data_inicio and dtcadastro_empresa<=:data_termino", 

    array(":origem"=>$origem,
          ":data_inicio"=>$data_inicio,
          ":data_termino"=>$data_termino));

    $dados [$cont]['nomeSindicato'] = $origem;
    $dados [$cont]['empresas_selecionadas'] = $result[0]['count(cnpj)'];


    $sql2 = new Sql();
    $result2 = $sql2->select("SELECT count(idVisita) from funcionario join visita on funcionario.idFuncionario=visita.idFuncionario where visita.status_visita='Visita Realizada' and funcionario.origem=:origem and data_prevista>=:data_inicio and data_prevista<=:data_termino", 
      array(":origem"=>$origem,
            ":data_inicio"=>$data_inicio,
            ":data_termino"=>$data_termino));
    
    $dados [$cont]['visitas_realizadas'] = $result2[0]['count(idVisita)'];


    $sql3 = new Sql();
    $result3 = $sql3->select("SELECT count(idVisita) from funcionario join visita on funcionario.idFuncionario=visita.idFuncionario where visita.status_visita='Visita Agendada' and funcionario.origem=:origem and data_prevista>=:data_inicio and data_prevista<=:data_termino", 
      array(":origem"=>$origem,
            ":data_inicio"=>$data_inicio,
            ":data_termino"=>$data_termino));
    
    $dados [$cont]['visitas_agendadas'] = $result3[0]['count(idVisita)'];


     $sql4 = new Sql();
     $result4 = $sql4->select("SELECT count(cnpj) from empresas where origem_cadastro=:origem and situacao_associacao='Em Andamento' and dtcadastro_empresa >=:data_inicio and dtcadastro_empresa<=:data_termino", 
      array(":origem"=>$origem,
            ":data_inicio"=>$data_inicio,
            ":data_termino"=>$data_termino));

    $dados [$cont]['EmAndamento'] = $result4[0]['count(cnpj)'];


    $sql5 = new Sql();
    $result5 = $sql5->select("SELECT count(cnpj) from empresas where origem_cadastro=:origem and situacao_associacao='Associação em Negociação' and dtcadastro_empresa >=:data_inicio and dtcadastro_empresa<=:data_termino;", 
      array(":origem"=>$origem,
            ":data_inicio"=>$data_inicio,
            ":data_termino"=>$data_termino));

    $dados[$cont]['associacao_em_negociacao'] = $result5[0]['count(cnpj)'];


    $sql6 = new Sql();
    $result6 = $sql6->select("SELECT count(idVisita) from funcionario join visita  join visita_has_funcionario on funcionario.idFuncionario = visita.idFuncionario and visita.idVisita=visita_has_funcionario.Visita_idVisita where funcionario.origem =:origem and visita_has_funcionario.status_associacao='Associação Efetivada' and visita_has_funcionario.data_realizacao >=:data_inicio and visita_has_funcionario.data_realizacao<=:data_termino;", 
      array(":origem"=>$origem,
            ":data_inicio"=>$data_inicio,
            ":data_termino"=>$data_termino));

    $dados[$cont]['associacaoEfetivada'] = $result6[0]['count(idVisita)'];

  
    $sql7 = new Sql();
    $result7 = $sql7->select("SELECT count(idVisita) from funcionario join visita on funcionario.idFuncionario=visita.idFuncionario where funcionario.origem=:origem and data_prevista>=:data_inicio and data_prevista<=:data_termino", 
      array(":origem"=>$origem,
            ":data_inicio"=>$data_inicio,
            ":data_termino"=>$data_termino));
    $dados[$cont]['totalVisitas'] = $result7[0]['count(idVisita)'];
 





    $cont++;
  }

    return $dados;

}


public static function getTotaisSindicatos($dadosSindicatos){

  $totais = array();

  $total_empresas_selecionadas = 0;
  $total_visitas_realizadas = 0;
  $total_visitas_agendadas = 0;
  $total_EmAndamento = 0;
  $total_associacao_em_negociacao = 0;
  $total_associacaoEfetivada = 0;
  $total_total_visitas = 0; 



  foreach ($dadosSindicatos as $dadoSindicato) {
      
      $total_empresas_selecionadas += $dadoSindicato['empresas_selecionadas'];
      $total_visitas_realizadas += $dadoSindicato['visitas_realizadas'];
      $total_visitas_agendadas += $dadoSindicato['visitas_agendadas'];
      $total_EmAndamento += $dadoSindicato['EmAndamento'];
      $total_associacao_em_negociacao += $dadoSindicato['associacao_em_negociacao'];
      $total_associacaoEfetivada += $dadoSindicato['associacaoEfetivada'];
      $total_total_visitas += $dadoSindicato['totalVisitas'];

      
  }

  $totais['total_empresas_selecionadas'] = $total_empresas_selecionadas;
  $totais['total_visitas_realizadas'] = $total_visitas_realizadas;
  $totais['total_visitas_agendadas'] = $total_visitas_agendadas;
  $totais['total_EmAndamento'] = $total_EmAndamento;
  $totais['total_associacao_em_negociacao'] = $total_associacao_em_negociacao;
  $totais['total_associacaoEfetivada'] = $total_associacaoEfetivada;
  $totais['total_total_visitas'] = $total_total_visitas;


  return $totais;


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
