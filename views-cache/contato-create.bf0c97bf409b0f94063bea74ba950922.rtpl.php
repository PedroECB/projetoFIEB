<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <small><b>CADASTRO DE CONTATO</b></small>
  </h1>
  <ol class="breadcrumb">
    <button class="btn btn-xs"><li><a href="/admin"><i class="fa fa-home"></i> Início</a></li></button>
    <button class="btn btn-xs"><li><a href="/admin/contatos"><i class="fa fa-fax"></i> Contatos</a></li></button>
    <button class="btn btn-xs"><li class="active"><a href="/admin/contatos-create"><i class="fa fa-plus"></i> Novo contato</a></li></button>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
         <div class="col-md-12"> 
         
         <center> 
          <h3 class="box-title" style="vertical-align: middle;"><b>NOVO CONTATO</b></h3>
          <a href="javascript:history.back()"><button type="button" class="btn btn-link navbar-right" style="margin-left: 15px;"><b>Voltar</b></button></a>
         </center>
         

          <?php if( isset($error["error"]) ){ ?>

          <br>
          <div class="alert alert-danger" role="alert">
              <center><b><?php echo htmlspecialchars( $error["error"], ENT_COMPAT, 'UTF-8', FALSE ); ?></b></center>
          </div>

         <?php } ?>


         </div>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="/admin/contatos-create" method="post">
          <div class="box-body">


        <div class="row">

          <div class="col-md-6">
            <div class="form-group">
              <label for="campoNome">Nome: <span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="campoNome" name="nome" placeholder="Ex: João Silva" autofocus="" required="" maxlength="25" value="<?php if( isset($dados["nome_func"]) ){ ?><?php echo htmlspecialchars( $dados["nome_func"], ENT_COMPAT, 'UTF-8', FALSE ); ?><?php } ?>">
            </div>
           </div>

          <div class="col-md-6">
            <div class="form-group">
              <label for="campoEntidade">Entidade:</label>
              <input type="text" class="form-control" id="campoEntitade" name="entidade" placeholder=""  maxlength="30" value="<?php if( isset($dados["cargo"]) ){ ?><?php echo htmlspecialchars( $dados["cargo"], ENT_COMPAT, 'UTF-8', FALSE ); ?><?php } ?>">
            </div>
           </div>

        </div>
           



         <div class="row">

            <div class="col-md-6">
               <div class="form-group">
                <label for="campoTel">Telefone (Opcional):</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-phone"></i>
                  </div>
                  <input type="tel" id="campoTel" class="form-control" placeholder="(DDD) 7777-8888" name="telefone" value="<?php if( isset($dados["telefone"]) ){ ?><?php echo htmlspecialchars( $dados["telefone"], ENT_COMPAT, 'UTF-8', FALSE ); ?><?php } ?>" maxlength="19">
                </div>
              </div>
           </div>


            <div class="col-md-6">
                <div class="form-group">
                <label for="campoTel2">Telefone Alternativo (Opcional):</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-phone"></i>
                  </div>
                  <input type="tel" id="campoTel2" class="form-control"  placeholder="(DDD) 7777-8888" name="telefone2" value="<?php if( isset($dados["telefone2"]) ){ ?><?php echo htmlspecialchars( $dados["telefone2"], ENT_COMPAT, 'UTF-8', FALSE ); ?><?php } ?>" maxlength="19">
                </div>
                <!-- /.input group -->
              </div>
             </div> 

          </div>

            

         <div class="form-group">
              <label for="campoEmail">E-mail:</label></label>
            <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-at"></i>
                </div> 
                  <input type="email" class="form-control" id="campoEmail" name="email" placeholder="email@contato.com"  value="<?php if( isset($dados["email"]) ){ ?><?php echo htmlspecialchars( $dados["email"], ENT_COMPAT, 'UTF-8', FALSE ); ?><?php } ?>" maxlength="45">
            </div>  
         </div>

        <div class="form-group">
          <label>Observação:</label>
          <textarea name="observacao" class="form-control" maxlength="200"></textarea>
        </div>


          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save"></i><b> SALVAR</b></button>
            <button type="submit" class="btn btn-default btn-sm navbar-right" onclick="javascript:history.back();"><b> VOLTAR</b></button>
          </div>
        </form>
      </div>
    </div>
  </div>

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
