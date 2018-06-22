<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <small>Alterar informações/Excluir Sindicato</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="/admin"><i class="fa fa-home"></i> Início</a></li>
    <li><a href="/admin/sindicatos">Sindicatos</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
         <div class="col-md-12"> 


          <center><h3 class="box-title" style="vertical-align: middle;"><b>ALTERAR INFORMAÇÕES DE SINDICATO</b></h3><a href="javascript:history.back();"><button style="vertical-align:;" class="navbar-right btn btn-link" type="button"><b>Voltar</b></button></center></a>
          <!--<a href="javascript:history.back()" style="margin-left: 60px;"><button type="button" class="btn btn-link navbar-right"><b>Voltar</b></button></a>-->
         
         </div> 
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="/admin/sindicato-edit/<?php echo htmlspecialchars( $sindicato["idSindicato"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="post" id="formSindicato">
          <div class="box-body">
            <div class="form-group">
              <label for="campoNomeSindicato">Nome do sindicato: <span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="campoNomeSindicato" name="nomeSindicato" placeholder="Ex: SINDTESTE" autofocus="" value="<?php echo htmlspecialchars( $sindicato["nome_sindicato"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required="" maxlength="25" onkeyup="toUpperSind();" onblur="confirmUpper();">
            </div>

          
            <label for="campoDescSind">Descrição (Opcional):</label>
            <textarea class="form-control" id="campoDescSind" name="descricaoSindicato" cols="20" rows="5" maxlength="400"><?php echo htmlspecialchars( $sindicato["descricao_sindicato"], ENT_COMPAT, 'UTF-8', FALSE ); ?></textarea>

   
           

        

            


      



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
            
          </div>
          <div class="box-footer">
           <div class="col-md-12"> 
            <button type="submit" class="btn btn-primary" onclick="return confirm('Alterações no nome do sindicato poderá causar eventuais falhas em consultas no sistema. Deseja realmente alterar as informações desse sindicato?')"><i class="fa fa-save"></i> <b>SALVAR</b></button>
            <div class="navbar-right">
              <a href="/admin/sindicato/<?php echo htmlspecialchars( $sindicato["idSindicato"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/remove"><button type="button" class="btn btn-danger " onclick="return confirm('Deseja realmente remover esse sindicato do sistema?');"><i class="fa fa-close"></i> <b>REMOVER SINDICATO</b></button></a>
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
