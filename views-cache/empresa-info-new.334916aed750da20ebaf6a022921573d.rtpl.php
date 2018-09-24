<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <small><b>INFORMAÇÕES DE EMPRESA CADASTRADA</b></small>
  </h1>
  <ol class="breadcrumb">
    <button class="btn btn-xs"><li><a href="/user"><i class="fa fa-home"></i> Início</a></li></button>
    <button class="btn btn-xs"><li><a href="/user/empresas">Empresas</a></li></button>
    
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
            <h3 class="box-title" style="vertical-align: middle;"><b>DETALHES DA EMPRESA</b></h3>
            <a href="javascript:history.back();"><button class="btn btn-link navbar-right"><b>Voltar</b></button></a>
          </center>
        </div>

        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="/user/empresas-create" method="post" id="formEmpresa">
          <div class="box-body">



   <div class="box-body"> 

          <center>
            <table class="table table-responsive table-hover table-info-empresa" style="">
            <thead>
              <tr>
                 
              </tr>
            </thead>
            <tbody>
              <tr><td><b>CADASTRADA POR</b></td>          <td> <?php if( isset($empresa["nome_func"]) ){ ?><?php echo htmlspecialchars( $empresa["nome_func"], ENT_COMPAT, 'UTF-8', FALSE ); ?><?php } ?></td><td class="text-primary info-some"><b><?php echo htmlspecialchars( $empresa["origem_cadastro"], ENT_COMPAT, 'UTF-8', FALSE ); ?></b></td></tr>
              <tr><td><b>CNPJ</b></td>                     <td> <?php echo htmlspecialchars( $empresa["cnpj"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td></tr>
              <tr><td><b>RAZÃO SOCIAL</b></td>             <td> <?php echo htmlspecialchars( $empresa["razao_social"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td></tr>
              <tr><td><b>NOME FANTASIA</b></td>            <td> <?php echo htmlspecialchars( $empresa["nome_fantasia"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td></tr>
              <tr><td><b>SITUACÃO DA ASSOCIAÇÃO</b></td>   <td> <?php echo htmlspecialchars( $empresa["situacao_associacao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td></tr>

              <tr><td><b>ASSOCIADA À</b></td>              <td> <?php if( isset($empresa["nome_sindicato"]) ){ ?><?php echo htmlspecialchars( $empresa["nome_sindicato"], ENT_COMPAT, 'UTF-8', FALSE ); ?><?php } ?></td></tr>

              <tr><td><b>CIDADE/MUNICÍPIO</b></td>         <td> <?php echo htmlspecialchars( $empresa["municipio"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td></tr>
              <tr><td><b>REGIÃO DO ESTADO</b></td>         <td> <?php echo htmlspecialchars( $empresa["regiao_estado"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td></tr>
              <tr><td><b>BAIRRO</b></td>                   <td><?php echo htmlspecialchars( $empresa["bairro"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td></tr>
              <tr><td><b>ENDEREÇO</b></td>                 <td> <?php echo htmlspecialchars( $empresa["endereco"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td></tr>
              <tr><td><b>E-MAIL DE CONTATO</b></td>        <td> <?php echo htmlspecialchars( $empresa["email"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td></tr>
              <tr><td><b>TELEFONE DE CONTATO</b></td>      <td> <?php echo htmlspecialchars( $empresa["telefone"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td></tr>
              <tr><td><b>TELEFONE ALTERNATIVO</b></td>                  <td> <?php echo htmlspecialchars( $empresa["telefone2"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td></tr>

            </tbody>
          </table>
        </center>

   </div>




          <!-- /.box-body -->
          <div class="box-footer">
           <div class="col-md-12"> 
 
            <a href="/user/agendarvisita/<?php echo htmlspecialchars( $empresa["idEmpresas"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><button type="button" class="btn btn-success btn-sm" style="margin-top: 5px;"><b><i class="fa fa-calendar"></i>&nbsp AGENDAR VISITA</b></button></a>  

            <?php if( $empresa["origem_cadastro"] == $origem["origem"] ){ ?>

            <a href="/user/empresa/<?php echo htmlspecialchars( $empresa["idEmpresas"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/delete"><button onclick="return confirm('Deseja realmente remover essa empresa do sistema?');" type="button" class="btn btn-danger btn-sm" style="margin-top: 5px;"><b><i class="fa fa-close"></i>&nbsp REMOVER EMPRESA</b></button></a>
            <?php } ?>

    

            <a href="javascript:history.back();"><button type="button" class="btn btn-default btn-sm navbar-right" style="margin-top: 5px;"><b>&nbsp VOLTAR</b></button></a>
    


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
