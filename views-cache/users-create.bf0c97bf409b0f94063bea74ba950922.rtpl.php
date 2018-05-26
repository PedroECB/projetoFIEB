<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <small>Cadastro de novo usuário</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="/admin"><i class="fa fa-dashboard"></i> Início</a></li>
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
          <h3 class="box-title">Novo Usuário</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="/admin/users/create" method="post">
          <div class="box-body">
            <div class="form-group">
              <label for="nome">Nome completo:</label>
              <input type="text" class="form-control" id="desperson" name="nome" placeholder="Nome completo do novo usuário" required="">
            </div>

            <div class="form-group">
              <label for="nrphone" >RG (Somente administradores poderão visualizar):</label>
              <input type="tel" class="form-control" id="nrphone" name="nrphone" placeholder="Apenas números" required="">
            </div>

            <div class="form-group">
              <label for="nrphone">Cargo (Breve descrição do cargo):</label>
              <input type="tel" class="form-control" id="nrphone" name="nrphone" placeholder="Ex: Agente/Diretor/Executivo" required="">
            </div>

            <div class="form-group">
              <label for="nrphone">Tipo de usuário (Nível de acesso):</label>
              <select id="" class="form-control">
                  <option value="">Administrador</option>
                  <option value="">Ponto focal</option>
                  <option value="">Fúncionário comum CASA/SINDICATO</option>
              </select>
            </div>

            <div class="form-group">
              <label for="nrphone">Origem (Entidade a qual usuário pertence):</label>
              <select id="" class="form-control">
                <option value="">FIEB</option>
                <optgroup  label="CASAS">
                  <option value="">IEL</option>
                  <option value="">SENAI</option>
                  <option value="">CIEB</option>
                  <option value="">SESI</option>
                </optgroup>
                  <optgroup  label="SINDICATOS">
                  <option value="">SINDVEST</option>
                  <option value="">SINDSABÕES</option>
                  <option value="">SINDIPROCIM</option>
                  <option value="">SINDBA</option>
                  <option value="">SINDRATAR</option>
                  <option value="">SINDFIT</option>
                </optgroup>
              </select>
            </div>

           

               <div class="form-group">
                <label>Telefone (Opcional)</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-phone"></i>
                  </div>
                  <input type="text" class="form-control" data-inputmask="'mask': ['999-999-9999 [x99999]', '+099 99 99 9999[9]-9999']" data-mask placeholder="(DDD) 7777-8888">
                </div>
                <!-- /.input group -->
              </div>


            

         <div class="form-group">
              <label for="desemail">E-mail (E-mail que será utilizado para efetuar login)</label>
            <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-at"></i>
                </div> 
                  <input type="email" class="form-control" id="desemail" name="desemail" placeholder="email@exemplo.com" required="">
            </div>  
        </div>

            <div class="form-group">
              <label for="despassword">Senha (No máximo 15 caracteres):</label>
              <input type="password" class="form-control" id="despassword" name="despassword" placeholder="Digite a senha" required="">
            </div>

             <div class="form-group">
              <label for="despassword">Confirmar senha</label>
              <input type="password" class="form-control" id="despassword" name="despassword" placeholder="Confirme a senha">
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
