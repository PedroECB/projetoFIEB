<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <small>Cadastro de usuário</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="/admin"><i class="fa fa-home"></i> Início</a></li>
    <li><a href="/admin/users">Usuários</a></li>
    <li class="active"><a href="/admin/users/create">Cadastrar</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
         <div class="col-md-12"> 
          <h3 class="box-title" style="vertical-align: middle;">NOVO USUÁRIO</h3>
          <a href="javascript:history.back()" style="margin-left: 60px;"><button type="button" class="btn btn-link navbar-right"><b>Voltar</b></button></a>
         </div> 
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="/admin/users/create" method="post">
          <div class="box-body">
            <div class="form-group">
              <label for="campoNome">Nome: <span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="campoNome" name="nome_func" placeholder="Ex: João Silva" autofocus="" required="" maxlength="25">
            </div>

            <div class="form-group">
              <label for="campoRG" >RG (Somente administradores poderão visualizar): <span class="text-danger">*</span></label></label>
              <input type="tel" class="form-control" id="campoRG" name="rg_func" placeholder="Apenas números" required="" maxlength="11">
            </div>

            <div class="form-group">
              <label for="cargo">Cargo: <span class="text-danger">*</span></label></label>
              <input type="text" class="form-control" id="campoCargo" name="cargo" placeholder="Ex: Agente/Diretor/Executivo" required="" maxlength="25">
            </div>

            <div class="form-group">
              <label for="campoTipo">Tipo de usuário (Nível de acesso): <span class="text-danger">*</span></label></label>
              <select id="campoTipo" class="form-control" name="nivel_acesso">
                  <option value="1">Administrador</option>
                  <option value="2">Ponto focal</option>
                  <option value="3">Fúncionário comum CASA/SINDICATO</option>
              </select>
            </div>

            <div class="form-group">
              <label for="campoOrigem">Origem (Entidade a qual pertence o usuário): <span class="text-danger">*</span></label></label>
              <select id="campoOrigem" class="form-control" name="origem">
                <option value="FIEB">FIEB</option>
                <optgroup  label="CASAS">
                  <option value="IEL">IEL</option>
                  <option value="SENAI">SENAI</option>
                  <option value="CIEB">CIEB</option>
                  <option value="SESI">SESI</option>
                </optgroup>
                  <optgroup  label="SINDICATOS">
                  <option value="SINDVEST">SINDVEST</option>
                  <option value="SINDSABÕES">SINDSABÕES</option>
                  <option value="SINDPROCIM">SINDIPROCIM</option>
                  <option value="SINDBA">SINDBA</option>
                  <option value="SINDRATAR">SINDRATAR</option>
                  <option value="SINDFIT">SINDFIT</option>
                  <?php $counter1=-1;  if( isset($sindicatos) && ( is_array($sindicatos) || $sindicatos instanceof Traversable ) && sizeof($sindicatos) ) foreach( $sindicatos as $key1 => $value1 ){ $counter1++; ?>

                    <option value="<?php echo htmlspecialchars( $value1["nome_sindicato"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["nome_sindicato"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                  <?php } ?>

                </optgroup>
              </select>
            </div>

           

               <div class="form-group">
                <label>Telefone (Opcional):</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-phone"></i>
                  </div>
                  <input type="tel" id="campoTel" class="form-control" data-inputmask="'mask': ['999-999-9999 [x99999]', '+099 99 99 9999[9]-9999']" data-mask placeholder="(DDD) 7777-8888" name="telefone">
                </div>
                <!-- /.input group -->
              </div>


            

         <div class="form-group">
              <label for="campoEmail">E-mail (E-mail que será utilizado para efetuar login): <span class="text-danger">*</span></label></label>
            <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-at"></i>
                </div> 
                  <input type="email" class="form-control" id="campoEmail" name="email" placeholder="email@exemplo.com" required="">
            </div>  
        </div>

            <div class="form-group">
              <label for="campoSenha1">Senha (No máximo 15 caracteres): <span class="text-danger">*</span></label></label>

               <div class="input-group">
               <div class="input-group-addon">
                  <i class="fa fa-lock"></i>
                </div> 
              <input type="password" class="form-control" id="campoSenha1" name="senha1" placeholder="Digite a senha" required="" maxlength="15">
            </div>
          </div>

             <div class="form-group">
              <label for="campoSenha2">Confirmar senha: <span class="text-danger">*</span></label></label>
             <div class="input-group">
               <div class="input-group-addon">
                  <i class="fa fa-lock"></i>
                </div>  
              <input type="password" class="form-control" id="campoSenha2" name="senha2" placeholder="Confirme a senha" required="" maxlength="15">
            </div>
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
