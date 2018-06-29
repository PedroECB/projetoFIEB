<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header" style="margin-bottom:25px;">
  <h1>
   
  </h1>
  <ol class="breadcrumb">
    <li><a href="/admin"><i class="fa fa-home"></i> Início</a></li>
    <li class="active"><a href="/admin/edit-profile">Editar perfil</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
 
  <div class="row">
  	<div class="col-md-12">
  		<div class="box box-primary">
        <div class="box-header with-border ">
         <div class="col-md-12"> 
          <h3 class="box-title" style="vertical-align: middle; margin-right:-25px;" >EDITAR PERFIL</h3>
          <a href="javascript:history.back()" style="margin-left: 62px;"><button type="button" class="btn btn-link navbar-right"><b>Voltar</b></button></a>
         </div> 
        </div>
        <!-- /.box-header -->
      
        <!-- form start -->
        <form role="form" action="/admin/edit-profile" method="post">
          <div class="box-body">

            <div class="form-group">
              <label for="desperson">Nome: *</label>
              <input type="text" class="form-control" id="desperson" name="cNome" placeholder="Digite o nome" value="<?php echo htmlspecialchars( $user["nome_func"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" maxlength="25" required>
            </div>

             <div class="form-group">
              <label for="cRg">RG</label>
              <input type="text" class="form-control" id="cRg" name="cRg" placeholder="" value="<?php echo htmlspecialchars( $user["rg_func"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" disabled>
            </div>
            

            <div class="form-group">
              <label for="cCargo">Cargo: *</label>
              <input type="text" class="form-control" id="cCargo" name="cCargo" placeholder="Ex: Agente/Executivo" value="<?php echo htmlspecialchars( $user["cargo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" maxlength="25" required>
            </div>

            <div class="form-group">
              <label for="cOrigem">Origem</label>
              <input type="text" class="form-control" id="desemail" name="cOrigem" placeholder="Digite o e-mail" value="<?php echo htmlspecialchars( $user["origem"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" disabled>
            </div>



            <div class="form-group">
              <label for="desemail">E-mail (E-mail que será utilizado para efetuar login): *</label>
              <input type="email" class="form-control" id="desemail" name="cEmail" placeholder="Digite o e-mail" maxlength="43" value="<?php echo htmlspecialchars( $user["email"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required>
            </div>


            <div class="form-group">
              <label for="nrphone">Telefone:</label>
              <input type="tel" class="form-control" id="nrphone" name="cTelefone" placeholder="(DDD) 7777-8888"  value="<?php echo htmlspecialchars( $user["telefone"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" maxlength="16">
            </div>

             <div class="form-group">
              <label for="nrphone2">Telefone alternativo:</label>
              <input type="tel" class="form-control" id="nrphone2" name="cTelefone2" placeholder="(DDD) 7777-8888"  value="<?php echo htmlspecialchars( $user["telefone2"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" maxlength="16">
            </div>
           
    
            <div class="form-group">
              <a href="/admin/alter-password"><button type="button" class="btn btn-link"><b>Alterar Senha</b></button></a>
            </div>



          </div>
          <!-- /.box-body -->
          <div class="box-footer">
           <div class="col-md-12">
           <button type="submit" class="btn btn-primary" onclick="return confirm('Deseja realmente salvar as alterações no perfil?')"><b>SALVAR</b></button> 
            <a href="javascript:history.back()"><button type="button" class="btn btn-default navbar-right"><b>VOLTAR</b></button></a>
            
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
