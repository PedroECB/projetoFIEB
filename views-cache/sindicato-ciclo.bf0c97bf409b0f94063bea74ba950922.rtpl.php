<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">

  <h1>
     <small><b>RELATÓRIOS DO SINDICATO NO CICLO</b></small>
  </h1>
  
  <ol class="breadcrumb">
    <button class="btn btn-xs"><li><a href="/admin"><i class="fa fa-home"></i> Início</a></li></button>
    <button class="btn btn-xs"><li class="active"><a href="#">Relatórios <?php echo htmlspecialchars( $dadosSindicato["nome_sindicato"], ENT_COMPAT, 'UTF-8', FALSE ); ?></a></li></button>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
            
            <div class="box-header">
              <div class="col-md-12">
              <!--<a href="#" class="btn btn-success btn-block"> --><h4 class="text-primary"><center><b>RELATÓRIOS <?php echo htmlspecialchars( $dadosSindicato["nome_sindicato"], ENT_COMPAT, 'UTF-8', FALSE ); ?> &nbsp&nbsp<span class="text-success"><?php echo date('d/m/Y', strtotime($ciclo["data_inicio"])); ?> - <?php echo date('d/m/Y', strtotime($ciclo["data_termino"])); ?></span></b><a href="javascript:history.back();"><button class="btn btn-link navbar-right"><b>Voltar</b></button></a></center></h4> <!--</a>-->
              </div>
            </div>



            <div class="box-body no-padding">
            
            
                    <div class="box-footer">

                                            <div class="col-md-12">
                          <table class="table table-sm table-striped table-hover table-bordered">
                            <thead>
                              <tr><td colspan="2" class="text-center text-primary"><b>EMPRESAS</b></td></tr>
                            </thead>
                            <tbody>

                      <!--         <tr><td colspan="2" class="text-center text-primary">EMPRESAS</td></tr> -->
                              <tr><td><b>Empresas Selecionadas</b></td> <td><?php echo htmlspecialchars( $dadosEmpresas["empresas_selecionadas"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td></tr>
                              <tr><td><b>Empresas Associadas</b></td><td><?php echo htmlspecialchars( $dadosEmpresas["empresas_associadas"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td> </tr>
                              <tr><td><b>Não Associadas</b></td><td><?php echo htmlspecialchars( $dadosEmpresas["nao_associadas"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td></tr>
                            </tbody>
                          </table>


                 <table class="table table-sm table-striped table-hover table-bordered">
                      <thead>
                          <tr><td colspan="2" class="text-center text-primary"><b>VISITAS</b></td></tr>
                      </thead>
                  <tbody>
                      <tr><td><b>Agendadas</b></td><td><?php echo htmlspecialchars( $dadosVisitas["visitas_agendadas"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td></tr>
                      <tr><td><b>Sem Ação</b></td><td><?php echo htmlspecialchars( $dadosVisitas["visitas_sem_acao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td> </tr>
                      <tr><td><b>Sem Sucesso no Agendamento</b></td><td><?php echo htmlspecialchars( $dadosVisitas["visitas_sem_sucesso_no_agendamento"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td></tr>
                      <tr><td><b>Visitas Realizadas</b></td><td><?php echo htmlspecialchars( $dadosVisitas["visitas_realizadas"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td> </tr>
                      <tr><td><b>Empresa Desativada</b></td><td><?php echo htmlspecialchars( $dadosVisitas["empresa_desativada"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td> </tr>
                 </tbody>
                </table>


                        <table class="table table-sm table-striped table-hover table-bordered">
                            <thead>
                              <tr><td colspan="2" class="text-center text-primary"><b>ASSOCIAÇÕES</b></td></tr>
                            </thead>
                            <tbody>

                      <!--         <tr><td colspan="2" class="text-center text-primary">EMPRESAS</td></tr> -->
                              <tr><td><b>Associações Efetivadas</b></td><td><?php echo htmlspecialchars( $dadosEmpresas["associacaoEfetivada"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td></tr>
                              <tr><td><b>Associações em Negociação</b></td><td><?php echo htmlspecialchars( $dadosEmpresas["associacao_em_negociacao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td></tr>
                             <!--  <tr><td><b>Não Associadas</b></td><td><?php echo htmlspecialchars( $dadosEmpresas["nao_associadas"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td></tr> -->
                            </tbody>
                          </table>




        </div>
                    
                   


                       







</div>




            </div>
            <!-- /.box-body -->
          </div>
    </div>
  </div>

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
