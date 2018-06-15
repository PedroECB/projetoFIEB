<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header" style="margin-bottom:25px;">
  <h1>
   
  </h1>
  <ol class="breadcrumb">
    <li><a href="/admin"><i class="fa fa-home"></i> Início</a></li>
    <li class="active"><a href="/admin/users">Usuários</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
 
  <div class="row">
  	<div class="col-md-12">
  		<div class="box box-primary">
        <div class="box-header with-border ">
         <div class="col-md-12"> 
          <h3 class="box-title" style="vertical-align: middle; margin-right:-25px;" >INFORMAÇÕES DE USUÁRIO</h3>
          <a href="javascript:history.back()" style="margin-left: 62px;"><button type="button" class="btn btn-link navbar-right"><b>Voltar</b></button></a>
         </div> 
        </div>
        <!-- /.box-header -->
      
        <!-- form start -->
        <form role="form" action="/admin/users/<?php echo htmlspecialchars( $user["idFuncionario"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="post">
          <div class="box-body">

            <div class="form-group">
              <label for="desperson">Nome:</label>
              <input type="text" class="form-control" id="desperson" name="desperson" placeholder="Digite o nome" value="<?php echo htmlspecialchars( $user["nome_func"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" disabled="">
            </div>

             <div class="form-group">
              <label for="cRg">RG:</label>
              <input type="text" class="form-control" id="cRg" name="rg" placeholder="" value="<?php echo htmlspecialchars( $user["rg_func"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" disabled>
            </div>
            

            <div class="form-group">
              <label for="cCargo">Cargo:</label>
              <input type="text" class="form-control" id="cCargo" name="cargo" placeholder="Ex: Agente/Executivo" value="<?php echo htmlspecialchars( $user["cargo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" disabled>
            </div>

            <div class="form-group">
              <label for="cOrigem">Origem:</label>
              <input type="text" class="form-control" id="desemail" name="desemail" placeholder="Digite o e-mail" value="<?php echo htmlspecialchars( $user["origem"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" disabled>
            </div>



            <div class="form-group">
              <label for="desemail">E-mail:</label>
              <input type="email" class="form-control" id="desemail" name="desemail" placeholder="Digite o e-mail" value="<?php echo htmlspecialchars( $user["email"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" disabled>
            </div>


            <div class="form-group">
              <label for="nrphone">Telefone:</label>
              <input type="tel" class="form-control" id="nrphone" name="nrphone" placeholder="Sem telefone"  value="<?php echo htmlspecialchars( $user["telefone"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" disabled>
            </div>
           
            <div class="form-group">
              <label for="campoTipo">Tipo de usuário (Nível de acesso):</label>
              <select id="campoTipo" class="form-control" name="nivel_acesso">
                  <option value="1" <?php if( $user["nivel_acesso"] == 1 ){ ?>selected<?php } ?>>Administrador</option>
                  <option value="2"<?php if( $user["nivel_acesso"] == 2 ){ ?> selected <?php } ?>>Ponto focal</option>
                  <option value="3" <?php if( $user["nivel_acesso"] == 3 ){ ?>selected<?php } ?>>Fúncionário comum CASA/SINDICATO</option>
              </select>
            </div>

            



          </div>
          <!-- /.box-body -->
          <div class="box-footer">
           <div class="col-md-12"> 
            <a href="javascript:history.back()"><button type="button" class="btn btn-primary"><b>VOLTAR</b></button></a>
            <button type="submit" class="btn btn-link navbar-right" onclick="return confirm('Deseja realmente alterar o nível de acesso desse usuário?')"><b>SALVAR</b></button>
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
