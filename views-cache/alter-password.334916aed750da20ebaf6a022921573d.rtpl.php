<?php if(!class_exists('Rain\Tpl')){exit;}?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header" style="margin-bottom:25px;">
  <h1>
   
  </h1>
  <ol class="breadcrumb">
    <li><a href="/user"><i class="fa fa-home"></i> Início</a></li>
    <li class="active"><a href="/user/alter-password">Alterar senha</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
 
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border ">
         <div class="col-md-12"> 
          <center>
            <h3 class="box-title" style="vertical-align: middle; margin-right:-25px;" ><b>ALTERAR SENHA</b></h3>
          <a href="javascript:history.back()" style="margin-left: 62px;"><button type="button" class="btn btn-link navbar-right"><b>Voltar</b></button></a>
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
        <form role="form" action="" method="post" id="formSenha">
          <div class="box-body">

            <div class="form-group">
              <label for="csenhaAtual">Senha atual: <span class="text-danger">*</span></label>
              <input type="password" class="form-control" id="csenhaAtual" name="senhaAtual" placeholder="Digite sua senha atual" value="<?php if( isset($dados["senhaAtual"]) ){ ?><?php echo htmlspecialchars( $dados["senhaAtual"], ENT_COMPAT, 'UTF-8', FALSE ); ?><?php } ?>" maxlength="15"   onblur="confere();" required autofocus>
            </div>

             <div class="form-group">
              <label for="csenha1">Nova senha: <span class="text-danger">*</span></label>
              <input type="password" class="form-control" id="csenha1" name="senha1" placeholder="Máximo 15 caracteres" value="" maxlength="15"  onkeypress="confere();" required>
            </div>
            

            <div class="form-group">
              <label for="csenha2">Confirmar senha: <span class="text-danger">*</span></label>
              <input type="password" class="form-control" id="csenha2" name="senha2" placeholder="Confirme sua nova senha" value="" maxlength="15" onkeyup="confereSenhas();"  onkeypress="confere();" required>
            </div>

       

        
      
            



          </div>
          <!-- /.box-body -->
          <div class="box-footer">
           <div class="col-md-12"> 
            
            <button type="submit" class="btn btn-primary" id="botao" disabled><b>ALTERAR SENHA</b></button>
           <a href="javascript:history.back()"><button type="button" class="btn btn-link"><b>Cancelar</b></button></a>
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



