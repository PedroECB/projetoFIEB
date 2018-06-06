<?php 

namespace Hcode;

use Rain\Tpl;

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

    //$nome = isset($_SESSION['nome'])?$_SESSION['nome']:"Indefinido";
    //$cargo = isset($_SESSION['cargo'])?$_SESSION['cargo']:"Indefinido 2";


    $this->tpl->assign("nome", $_SESSION['nome']);
    $this->tpl->assign("cargo", $_SESSION['cargo']);
    $this->tpl->assign("origem", $_SESSION['origem']);


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

