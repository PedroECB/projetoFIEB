<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <small>Inclusão de Novo Sindicato</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="/admin"><i class="fa fa-home"></i> Início</a></li>
    <li><a href="/admin/sindicatos">Sindicatos</a></li>
    <li class="active"><a href="#">Novo Sindicato</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
         <div class="col-md-12"> 
          <center><h3 class="box-title" style="vertical-align: middle;"><b>NOVO SINDICATO</b></h3> <a href="javascript:history.back();"><button type="button" class="btn btn-link navbar-right"><b>Voltar</b></button></a></center>
          <!--<a href="javascript:history.back()" style="margin-left: 60px;"><button type="button" class="btn btn-link navbar-right"><b>Voltar</b></button></a>-->
         </div> 
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="/admin/sindicatos-create" method="post" id="formSindicato">
          <div class="box-body">
            <div class="form-group">
              <label for="campoNomeSindicato">Nome do sindicato: <span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="campoNomeSindicato" name="nomeSindicato" placeholder="Ex: SINDTESTE" autofocus="" required="" maxlength="25" onkeyup="toUpperSind();" onblur="confirmUpper();">
            </div>

          
            <label for="campoDescSind">Descrição (Opcional):</label>
            <textarea class="form-control" id="campoDescSind" name="descricaoSindicato" cols="20" rows="5" maxlength="400"></textarea>

   
           

        

            


      



<!--
            <div class="checkbox">
              <label>
                <input type="checkbox" name="inadmin" value="1"> Acesso de Administrador
              </label>
            </div>
          </div>
-->

          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-primary "><b>CADASTRAR</b></button>
          </div>
        </form>
      </div>
    </div>
  </div>

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
