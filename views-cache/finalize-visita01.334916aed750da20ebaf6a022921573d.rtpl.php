<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <small>FINALIZAR VISITA</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="/user"><i class="fa fa-home"></i> Início</a></li>
    <li><a href="/user/visitas">Visitas</a></li>
    
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">


<div class="box-header">
    <center><h4 class=""><b>FINALIZAR VISITA</b><a href="javascript:history.back()"><button class="btn btn-link navbar-right" style="margin-left: 50px;"><b>Cancelar</b></button></a></h4></center>

<br>
<form role="form" action="/user/finalize-visita/<?php echo htmlspecialchars( $visita["idVisita"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="post" id="formEmpresa">
  <div class="form-group">
          <input hidden name="idVisita" value="<?php echo htmlspecialchars( $visita["idVisita"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
              <label for="campoAgenteAtend">Agente de Mercado que Atendeu: *</label>
              <input type="tel" class="form-control" id="campoAgenteAtend" name="campoAgenteAtend" placeholder="Nome do Agente" value="" maxlength="25" required>
            </div>





<div class="row">
  <div class="col-md-6">
    <div class="form-group">
        <label for="dataRealização">Data de Realização da Visita: *</label>
        <input type="date" class="form-control" id="dataRealização" name="dataRealização" placeholder="dd/mm/aaaa" value=""   maxlength="10" required>
      </div>
  </div>

  <div class="col-md-6">
    <label for="campoNegociacao" >Negociação: </label>
    <select name="campoNegociacao" class="form-control" id="campoNegociacao">
      <option value="Não Negociada">Não Negociada</option>
      <option value="Negociada">Negociada</option>
      <option value="Em Negociação">Em Negociação</option>
    </select>
  </div>
</div>
  <div class="row">
    <div class="col-md-6">
            
 <label for="campoFamilia">Família do Produto Ofertado:</label>
        <select name="campoFamilia" id="campoFamilia" class="form-control">
          <option value="<?php echo htmlspecialchars( $visita["familia_prod"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $visita["familia_prod"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
          <option value="Qualidade de Vida">Qualidade de Vida</option>
          <option value="Desenvolvimento de Carreiras">Desenvolvimento de Carreiras</option>
          <option value="Desenvolvimento Empresarial">Desenvolvimento Empresarial</option>
          <option value="Educação">Educação</option>
        </select>

      </div>


      <div class="col-md-6">
       
        
        <div class="form-group">
              <label for="campoValorProduto">Valor do Produto: </label> 
              <input type="text" class="form-control" id="campoValorProduto" name="campoValorProduto" placeholder=""  maxlength="10">
            </div>
      </div>
    
  </div>
  


  <div class="row">

    <div class="col-md-6">   
         <div class="form-group">
              <label for="campoSitAssoc" >Situação da Associação: *</label>
              <select name="sitAssoc" class="form-control" onchange="verificaAssoc();">
                <option value="<?php echo htmlspecialchars( $visita["situacao_associacao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $visita["situacao_associacao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                <option value="Não Associada">Não Associada</option>
                <option value="Associada">Associada</option>
                <option value="Associação em Negociação">Associacão em Negociação</option>
                <option value="Associação Efetivada">Associação Efetivada</option>

              </select>
            </div>
      </div>
      



      <div class="col-md-6">   
          <div class="form-group">
              <label for="campoDemandas" >Demanda Identificada na Visita:</label>
              <select name="campoDemandas" class="form-control">

                <option value="">Nenhuma Demanda Identificada</option>
               <optgroup label="CASAS">
                <option value="SESI">SESI</option>
                <option value="SENAI">SENAI</option>
                <option value="IEL">IEL</option>
                <option value="CIEB">CIEB</option>
               </optgroup>
               <optgroup label="SINDICATOS">
               <?php $counter1=-1;  if( isset($sindicatos) && ( is_array($sindicatos) || $sindicatos instanceof Traversable ) && sizeof($sindicatos) ) foreach( $sindicatos as $key1 => $value1 ){ $counter1++; ?> 
                 <option value="<?php echo htmlspecialchars( $value1["nome_sindicato"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["nome_sindicato"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                <?php } ?> 
               </optgroup>  

              </select>
            </div>
      </div>
    <div class="col-md-12">   
        <br>
        <label>Observação:</label><textarea name="campoObservacao" class="form-control"><?php echo htmlspecialchars( $visita["observacao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></textarea>
    </div>
  
  </div>













</div>



        </div>
        <!-- /.box-header -->
        <!-- form start -->
        
          <div class="box-body">



        <!--  <div class="form-group">
              <label for="campoCNPJ">CNPJ: *</label>
              <input type="tel" class="form-control" id="campoCNPJ" name="cnpj" placeholder="Digite apenas números" value="" onkeyup="formatCNPJ();"  maxlength="15" required>
            </div>
        -->


          
          




</div>
        

          
       



          <!-- /.box-body -->
          <div class="box-footer">
           <div class="col-md-12"> 

          

           
            <a><button type="submit" class="btn btn-danger"><b><i class="fa fa-check"></i>&nbsp FINALIZAR</b></button></a>  
            <a href="javascript:history.back();"><button type="button" class="btn btn-default navbar-right"><b>&nbsp VOLTAR</b></button></a>
    


          </div>
          </div>
        </form>
      </div>
    </div>
  </div>

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
