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
    $result5 = $sql5->select("SELECT count(cnpj) from empresas where origem_cadastro=:origem and situacao_associacao='Associação Efetivada';",array(":origem"=>$origem));

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

  return $dados;
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
