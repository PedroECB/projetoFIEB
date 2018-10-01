<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <small><b>ALTERAR INFORMAÇÕES DA VISITA</b></small>
  </h1>
  <ol class="breadcrumb">
    <button class="btn btn-xs"><li><a href="/user"><i class="fa fa-home"></i> Início</a></li></button>
    <button class="btn btn-xs"><li><a href="/user/visitas">Visitas</a></li></button>
    
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">


<div class="box-header">
    <center><h4 class=""><b>VISITA</b><a href="javascript:history.back();"><button type="button" class="btn btn-link navbar-right" style="margin-left: 50px;"><b>Voltar</b></button></a></h4></center>
<form action="/user/edit-visita/<?php echo htmlspecialchars( $visita["idVisita"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="post">
<br>
<div class="row">
  <div class="col-md-6">
    <input hidden name="idVisita" value="<?php echo htmlspecialchars( $visita["idVisita"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
    <div class="form-group">
        <label for="dataVisita">Data prevista para visita: *</label>
        <input type="date" class="form-control" id="dataVisita" name="dataVisita" placeholder="dd/mm/aaaa" value="<?php echo htmlspecialchars( $visita["data_prevista"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"   maxlength="10" required>
      </div>
  </div>

  <div class="col-md-6">
    <label for="campoStatus" >Status Inicial de Visita: </label>
    <select name="campoStatus" class="form-control" id="campoStatus">
      <option value="<?php echo htmlspecialchars( $visita["status_visita"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $visita["status_visita"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
      <option value="Sem Ação">Sem Ação</option>
      <option value="Visita Agendada">Visita Agendada</option>
      <option value="Visita Realizada">Visita Realizada</option>
      <option value="Sem Sucesso no Agendamento">Sem Sucesso no Agendamento</option>
      <option value="Empresa Desativada">Empresa Desativada</option>
    </select>
  </div>
</div>
  <div class="row">
    <div class="col-md-6">
      <label for="campoDemanda">Demanda inicial: *</label>
      <select name="campoDemanda" id="campoDemanda" class="form-control">
        <option value="<?php echo htmlspecialchars( $visita["demanda_inicial"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $visita["demanda_inicial"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
       <optgroup label="CASAS">
          <option value="IEL">IEL</option>
          <option value="SESI">SESI</option>
          <option value="SENAI">SESI</option>
          <option value="CIEB">CIEB</option>
       </optgroup> 

       <optgroup label="SINDICATOS">
       <!-- 
          <option value="SINDFIT">SINDFIT</option>
          <option value="SINDPROCIM">SINDPROCIM</option>
          <option value="SINDTESTE">SINDTESTE</option>

        --><?php $counter1=-1;  if( isset($sindicatos) && ( is_array($sindicatos) || $sindicatos instanceof Traversable ) && sizeof($sindicatos) ) foreach( $sindicatos as $key1 => $value1 ){ $counter1++; ?>

                <option value="<?php echo htmlspecialchars( $value1["nome_sindicato"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["nome_sindicato"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
            <?php } ?>  

       </optgroup> 
      </select>
</div>
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
    
  </div><br>
  
    
    <label for="campoObservação">Observação:</label><textarea class="form-control" name="campoObservacao" maxlength="300"><?php echo htmlspecialchars( $visita["observacao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></textarea>


  
</div>

<br>


     
        

          
       



          <!-- /.box-body -->
          <div class="box-footer">
           <div class="col-md-12"> 

          

           
            <a><button type="submit" class="btn btn-primary"><b><i class="fa fa-check"></i>&nbsp SALVAR</b></button></a>  
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
