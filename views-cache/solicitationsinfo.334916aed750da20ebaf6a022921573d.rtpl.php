<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <small>Informações Sobre Solicitação de Acesso ao Sistema</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="/admin"><i class="fa fa-home"></i> Início</a></li>
    <li><a href="#">Solicitações</a></li>
    
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">

        <div class="col-md-12">
          <h3 class="box-title">Dados do Usuário</h3>
          <a href="javascript:history.back();" class="navbar-right"><button class="btn-link" style="margin-left: 30px;"><b>Voltar</b></button></a>
         </div> 

        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="#" method="post">
          <div class="box-body">



            <div class="form-group">
              <label for="campoNome">Nome:</label>
              <input type="text" class="form-control" id="campoNome" name="nome" placeholder="" readonly="" value="<?php echo htmlspecialchars( $user["nome_func"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
            </div>

            <div class="form-group">
              <label for="campoRG" >RG:</label>
              <input type="tel" class="form-control" id="campoRG" name="rg" placeholder="" readonly="" value="<?php echo htmlspecialchars( $user["rg_func"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
            </div>

            <div class="form-group">
              <label for="campoCargo">Cargo:</label>
              <input type="text" class="form-control" id="campoCargo" name="cargo" placeholder="" readonly="" value="<?php echo htmlspecialchars( $user["cargo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
            </div>



                  <div class="form-group">
                   <label for="campoEmail">E-mail: </label>
                    <div class="input-group">
                      <div class="input-group-addon">
                         <i class="fa fa-at"></i>
                      </div> 
                    <input type="email" class="form-control" id="campoEmail" name="email" placeholder="" readonly="" value="<?php echo htmlspecialchars( $user["email_func"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                  </div>  
                </div>



               <div class="form-group">
                <label for="campoTel">Telefone:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-phone"></i>
                  </div>
                  <input type="tel" id="campoTel" class="form-control" data-inputmask="'mask': ['999-999-9999 [x99999]', '+099 99 99 9999[9]-9999']" data-mask placeholder="Sem Telefone" name="telefone" readonly="" value="<?php echo htmlspecialchars( $user["telefone"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                </div>
                <!-- /.input group -->
              </div>


               <div class="form-group">
                <label for="campoTel2">Telefone 2:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-phone"></i>
                  </div>
                  <input type="tel" id="campoTel2" class="form-control" data-inputmask="'mask': ['999-999-9999 [x99999]', '+099 99 99 9999[9]-9999']" data-mask placeholder="Sem Telefone Alternativo" name="telefone" readonly="" value="<?php echo htmlspecialchars( $user["telefone2"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                </div>
                <!-- /.input group -->
              </div>

            

  



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
           <div class="col-md-12"> 

          

           
            <a href="/user/solicitations/<?php echo htmlspecialchars( $user["idCadastro"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/aprove"><button type="button" class="btn btn-success"><b><i class="fa fa-check"></i>&nbsp Aprovar</b></button></a>  
            <a><button type="button" class="btn btn-danger navbar-right"><b><i class="fa fa-close"></i>&nbsp Recusar</b></button></a>
    


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
