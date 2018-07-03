<?php 

namespace Hcode;

use Rain\Tpl;
use \Hcode\DB\Sql;

class Page{
 
 private $tpl;
 private $options = [];
 private $defaults = [
    "data"=>[]

];

  public function __construct($opts = array(), $tpl_dir = "/views/"){

    $this->options = array_merge($this->defaults, $opts);

    $config = array(
        "tpl_dir"       => $_SERVER["DOCUMENT_ROOT"].$tpl_dir,
        "cache_dir"     => $_SERVER["DOCUMENT_ROOT"]."/views-cache/",
        "debug"         => false
       );

  Tpl::configure($config);

  $this->tpl = new Tpl;

  $this->setData($this->options["data"]);

        // INICIO GAMBIARRA

  if(isset($_SESSION['nivel_acesso'])){

    $this->tpl->assign("tp", $_SESSION['tp']);
    //$nome = isset($_SESSION['nome'])?$_SESSION['nome']:"Indefinido";
    //$cargo = isset($_SESSION['cargo'])?$_SESSION['cargo']:"Indefinido 2";


    $this->tpl->assign("nome", $_SESSION['nome']);
    $this->tpl->assign("cargo", $_SESSION['cargo']);
    $this->tpl->assign("origem", $_SESSION['origem']);

    if($_SESSION['nivel_acesso'] == 1){


        $sql = new Sql();
        $result = $sql->query("SELECT COUNT(nome_func) FROM cadastros");
        $not = $result->fetchAll();
        $qnt = $not[0][0];

         $this->tpl->assign("qnt", $qnt);

    }elseif($_SESSION['nivel_acesso'] == 2){

      $origem = $_SESSION['origem'];

      $sql = new Sql();
      $result = $sql->query("SELECT COUNT(nome_func) FROM cadastros WHERE origem=:orig", array(":orig"=>$origem));
      $not = $result->fetchAll();
      $qnt = $not[0][0];


      $sql2 = new Sql();
      $result2 = $sql2->query("SELECT count(demanda) FROM demandas WHERE demanda =:orig", array(":orig"=>$origem));
      $not2 = $result2->fetchAll();

      $qntD = $not2[0][0];

      $this->tpl->assign("qnt", $qnt);
      $this->tpl->assign("qntD", $qntD);


    }


  }      // FIM GAMBIARRA

     

    $this->tpl->draw("header");

  }


public function setData($data = array()){
  foreach ($data as $key=>$value) {
    $this->tpl->assign($key, $value);
  }
}



  public function setTpl($name, $data = array(), $returnHTML = false){
      $this->setData($data);
     return $this->tpl->draw($name, $returnHTML);
  }


  public function __destruct(){
    $this->tpl->draw("footer");
  }

}

