<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <small>CRIAÇÃO DE NOVO CICLO</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="/admin"><i class="fa fa-home"></i> Início</a></li>
    <li><a href="#">Novo Ciclo</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
         <div class="col-md-12"> 
          <center><h3 class="box-title" style="vertical-align: middle;"><b>NOVO CICLO</b></h3>
            <a href="javascript:history.back();"><button style="margin-left: 40px;" class="btn btn-link navbar-right"><b>Voltar</b></button></a>
          </center>
          <!--<a href="javascript:history.back()" style="margin-left: 60px;"><button type="button" class="btn btn-link navbar-right"><b>Voltar</b></button></a>-->
         </div> 
        </div>
        <!-- /.box-header -->
        <!-- form start -->
      <form role="form" action="/admin/ciclo-create" method="post" id="formCicloCreate">
        <div class="box-body">

          <div class="form-group">
              <label for="campoNomeCiclo">Ciclo: <span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="campoNomeCiclo" name="nomeCiclo" placeholder="Ex: 1/2/Primeiro/Segundo" autofocus="" required="" maxlength="20">
            </div>

 <div class="form-group">
      <label for="cDataInicio">Data de Início: <span class="text-danger">*</span></label>
           <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>

              <input type="date" class="form-control" id="cDataInicio" name="dataInicio" placeholder="dd/mm/aaaa" autofocus="" required="" maxlength="10">
            
          </div>
     </div>

  <br>

   <div class="form-group">
      <label for="cDataTermino">Previsão de término: <span class="text-danger">*</span></label>
           <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar-times-o"></i>
                  </div>

              <input type="date" class="form-control" id="cDataTermino" name="dataTermino" placeholder="dd/mm/aaaa" required="" maxlength="10">
            
          </div>
     </div>

        

            


      





          <!-- /.box-body -->
          <div class="box-footer">
           <div class="col-md-12"> 
            <button type="submit" class="btn btn-success "><i class="fa fa-arrow-right"></i> <b>INICIAR</b></button>
            <div class="navbar-right">
              <a href="javascript:history.back();"><button type="button" class="btn btn-default "><b>CANCELAR</b></button></a>
            </div>
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
