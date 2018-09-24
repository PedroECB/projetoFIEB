<?php if(!class_exists('Rain\Tpl')){exit;}?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <small><b>CADASTRO DE EMPRESA PARA VISITAS</b></small>
  </h1>
  <ol class="breadcrumb">
    <button class="btn btn-xs"><li><a href="/user2"><i class="fa fa-home"></i> Início</a></li></button>
    <button class="btn btn-xs"><li><a href="/user2/visitas">Visitas</a></li></button>
    
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
            <h3 class="box-title" style="vertical-align: middle;"><b>DETALHES DA VISITA</b></h3>
            <a href="javascript:history.back();"><button class="btn btn-link navbar-right"><b>Voltar</b></button></a>
          </center>
        </div>

        </div>
        <!-- /.box-header -->
        <!-- form start -->
        
          <div class="box-body">





            <div class="box-body"> 

                  <center>
                    <table class="table table-responsive table-hover table-info-empresa" style="">
                    <thead>
                      <tr>
                        
                      </tr>
                    </thead>
                    <tbody>
                      <tr><td><b>RESPONSÁVEL PELO CADASTRO DA VISITA</b></td>          <td><?php echo htmlspecialchars( $visita["nome_func"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td><td class="text-primary info-some"><b><?php echo htmlspecialchars( $visita["origem"], ENT_COMPAT, 'UTF-8', FALSE ); ?></b></td></tr>
                      <tr><td><b>CADASTRADA EM</b></td>                     <td><?php echo date('d/m/Y',strtotime($visita["data_de_agendamento"])); ?></td></tr>
                      <tr><td><b>DATA PREVISTA</b></td>                     <td>27/08/2018</td></tr>
                      <tr><td><b>SITUACÃO DA VISITA</b></td>             <td class="text-success" style="text-transform: uppercase;"><b><?php echo htmlspecialchars( $visita["status_visita"], ENT_COMPAT, 'UTF-8', FALSE ); ?></b></td></tr>
                      <tr><td><b>FAMÍLIA DO PRODUTO OFERTADO</b></td>            <td><?php echo htmlspecialchars( $visita["familia_prod"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td></tr>
                      <tr><td><b>DEMANDA INICIAL</b></td>   <td> <?php echo htmlspecialchars( $visita["demanda_inicial"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td></tr>
                       <tr><td></td><td><td></tr>
                      <tr><td><b>RESPONSÁVEL PELO ATENDIMENTO</b></td>         <td><?php if( isset($visita["agente_atend"]) ){ ?><?php echo htmlspecialchars( $visita["agente_atend"], ENT_COMPAT, 'UTF-8', FALSE ); ?><?php } ?></td></tr>
                      <tr><td><b>DATA DE REALIZAÇÃO</b></td>                    <td><?php if( isset($visita["data_realizacao"]) ){ ?><?php echo date('d/m/Y',strtotime($visita["data_realizacao"])); ?><?php } ?></td></tr>
                      <tr><td><b>DEMANDA IDENTIFICADA NA VISITA</b></td>        <td><?php if( isset($visita["demanda_ident"]) ){ ?><?php echo htmlspecialchars( $visita["demanda_ident"], ENT_COMPAT, 'UTF-8', FALSE ); ?><?php } ?></td></tr>
                      <tr><td><b>SITUACÃO DA NEGOCIAÇÃO </b></td>         <td><?php if( isset($visita["status_negociacao"]) ){ ?><?php echo htmlspecialchars( $visita["status_negociacao"], ENT_COMPAT, 'UTF-8', FALSE ); ?><?php } ?></td></tr>
                      <tr><td><b>PREÇO DO PRODUTO OFERTADO </b></td>         <td><?php if( isset($visita["preco_prod"]) ){ ?><?php echo number_format($visita["preco_prod"],2); ?><?php } ?></td></tr>
                      <tr><td><b>ASSOCIACAO </b></td>         <td><?php if( isset($visita["status_associacao"]) ){ ?><?php echo htmlspecialchars( $visita["status_associacao"], ENT_COMPAT, 'UTF-8', FALSE ); ?><?php } ?></td></tr>
                      <tr><td><b>OBSERVAÇÃO</b></td>              <td> <?php echo htmlspecialchars( $visita["observacao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td></tr>
                      <tr><td></td><td><td></tr>
                      <tr><td></td><td><b class="text-black">EMPRESA</b></td><td></td></tr>
                      <tr><td></td><td><td></tr>
                      <tr><td><b>CNPJ</b></td>                     <td> <?php echo htmlspecialchars( $visita["cnpj"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td></tr>
                      <tr><td><b>RAZÃO SOCIAL</b></td>             <td> <?php echo htmlspecialchars( $visita["razao_social"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td></tr>
                      <tr><td><b>NOME FANTASIA</b></td>            <td> <?php echo htmlspecialchars( $visita["nome_fantasia"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td></tr>
                      <tr><td><b>SITUACÃO DA ASSOCIAÇÃO</b></td>   <td> <?php echo htmlspecialchars( $visita["situacao_associacao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td></tr>
                    <!--  <tr><td><b>ASSOCIADA À</b></td>              <td> </td></tr> -->
                      <tr><td><b>CIDADE/MUNICÍPIO</b></td>         <td> <?php echo htmlspecialchars( $visita["municipio"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td></tr>
                      <tr><td><b>REGIÃO DO ESTADO</b></td>         <td> <?php echo htmlspecialchars( $visita["regiao_estado"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td></tr>
                      <tr><td><b>BAIRRO</b></td>                   <td><?php echo htmlspecialchars( $visita["bairro"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td></tr>
                      <tr><td><b>ENDEREÇO</b></td>                 <td> <?php echo htmlspecialchars( $visita["endereco"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td></tr>
                      <tr><td><b>E-MAIL DE CONTATO</b></td>        <td><?php echo htmlspecialchars( $visita["email"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td></tr>
                      <tr><td><b>TELEFONE DE CONTATO</b></td>      <td><?php echo htmlspecialchars( $visita["telefone"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td></tr>
                      <tr><td><b>TELEFONE ALTERNATIVO</b></td>                  <td> <?php echo htmlspecialchars( $visita["telefone2"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td></tr>


                    </tbody>
                  </table>
                </center>


            </div>

        

            

       





          <!-- /.box-body -->
          <div class="box-footer">
           <div class="col-md-12"> 
          
          <?php if( $visita["origem"] == $origem["origem"] ){ ?>

            <a href="/user2/edit-visita/<?php echo htmlspecialchars( $visita["idVisita"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><button type="button" class="btn btn-primary btn-sm" style="margin-top: 5px;"><b><i class="fa fa-pencil-square"></i>&nbsp ALTERAR DADOS DA VISITA</b></button></a>  
            <?php if( !isset($visita["agente_atend"]) ){ ?>

            <a href="/user2/finalize-visita/<?php echo htmlspecialchars( $visita["idVisita"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><button type="button" class="btn btn-danger btn-sm" style="margin-top: 5px;"><b><i class="fa  fa-check-square"></i>&nbsp FINALIZAR VISITA</b></button></a>
            <?php } ?>

          <?php } ?>

            <a href="javascript:history.back();"><button type="button" class="btn btn-default btn-sm navbar-right" style="margin-top: 5px;"><b>&nbsp VOLTAR</b></button></a>
    


          </div>
          </div>
        
      </div>
    </div>
  </div>

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->




