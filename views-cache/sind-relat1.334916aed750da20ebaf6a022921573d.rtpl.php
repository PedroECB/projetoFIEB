<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">

  <h1>
     <small><b>RELATÓRIOS DO SINDICATO <?php echo htmlspecialchars( $origem, ENT_COMPAT, 'UTF-8', FALSE ); ?></b></small>
  </h1>
  
  <ol class="breadcrumb">
    <button class="btn btn-xs"><li><a href="/user"><i class="fa fa-home"></i> Início</a></li></button>
     <button class="btn btn-xs"><li class="active"><a href="#">Relatórios Sindicato</a></li></button>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
            
            <div class="box-header">
              <div class="col-md-12">
              <!--<a href="#" class="btn btn-success btn-block"> --><h3 class="text-primary"><center><b><?php echo htmlspecialchars( $dadosSindicato["nome_sindicato"], ENT_COMPAT, 'UTF-8', FALSE ); ?> - GERAL</b><a href="javascript:history.back();"><button class="btn btn-link navbar-right"><b>Voltar</b></button></a></center></h3> <!--</a>-->
              </div>
            </div>



            <div class="box-body no-padding">
            
            
                    <div class="box-footer">
                    
                    <div class="col-md-6">
                      <div class="col-sm-12"><br>
                        <center><h4><b>EMPRESAS</b></h4></center>  
                      </div>
                        <table class="table table-striped table-bordered   table-hover">
                          <thead>
                            <tr>
                             <!-- <th style="width: 120px">RG</th>-->
                              <th style="width: 10px">&nbsp</th>   
                              <th style="width: 55px">&nbsp</th>
                             <!-- <th>E-mail</th>
                              <th style="width: 190px">Observação</th>
                              <th style="width: 50px">&nbsp;</th>-->
                            </tr>
                          </thead>
                          <tbody>


                             <tr>
                              <td><b>Empresas Selecionadas</b></td><td><?php echo htmlspecialchars( $dadosEmpresas["empresas_selecionadas"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>  
                            </tr>

                             <tr>
                              <td><b>Empresas Associadas</b></td><td><?php echo htmlspecialchars( $dadosEmpresas["empresas_associadas"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>  
                            </tr> 

                             <tr>
                              <td><b>Não Associadas</b></td><td><?php echo htmlspecialchars( $dadosEmpresas["nao_associadas"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>  
                            </tr>  
                          



                          <!-- <td>Visita realizada e demanda gerada para várias casas e que ainda necessitam ser visualizadas</td>
                              <td>
                                
                                <a href="#" class="btn btn-primary btn-xs"><i class="fa fa-info"></i> <b> Detalhes da Visita</b></a>
                                <a href="#"  class="btn btn-danger btn-xs" title="Remover notificação de demanda"><i class="fa fa-close"></i> <b></b></a>
                              </td>-->



                          </tbody>
                        </table>
                       </div>


                       <div class="col-md-6">
                         <div class="col-sm-12"><br>
                        <center><h4><b>VISITAS</b></h4></center>  
                      </div>
                        <table class="table table-striped table-bordered   table-hover">
                          <thead>
                            <tr>
                             <!-- <th style="width: 120px">RG</th>-->
                              <th style="width: 10px">&nbsp</th>   
                              <th style="width: 55px">&nbsp</th>
                             <!-- <th>E-mail</th>
                              <th style="width: 190px">Observação</th>
                              <th style="width: 50px">&nbsp;</th>-->
                            </tr>
                          </thead>
                          <tbody>


                             <tr>
                              <td><b>Agendadas</b></td><td><?php echo htmlspecialchars( $dadosVisitas["visitas_agendadas"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>  
                            </tr>

                             <tr>
                              <td><b>Sem Ação</b></td><td><?php echo htmlspecialchars( $dadosVisitas["visitas_sem_acao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>  
                            </tr> 

                             <tr>
                              <td><b>Sem Sucesso no Agendamento</b></td><td><?php echo htmlspecialchars( $dadosVisitas["visitas_sem_sucesso_no_agendamento"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>  
                            </tr>

                             <tr>
                                <td><b>Visitas Realizadas</b></td><td><?php echo htmlspecialchars( $dadosVisitas["visitas_realizadas"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>  
                            </tr>

                              <tr>
                              <td><b>Empresa Desativada</b></td><td><?php echo htmlspecialchars( $dadosVisitas["empresa_desativada"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>  
                            </tr>  
                          



                          <!-- <td>Visita realizada e demanda gerada para várias casas e que ainda necessitam ser visualizadas</td>
                              <td>
                                
                                <a href="#" class="btn btn-primary btn-xs"><i class="fa fa-info"></i> <b> Detalhes da Visita</b></a>
                                <a href="#"  class="btn btn-danger btn-xs" title="Remover notificação de demanda"><i class="fa fa-close"></i> <b></b></a>
                              </td>-->



                          </tbody>
                        </table>

                       </div>



                        <div class="col-md-6">
                         <div class="col-sm-12"><br>
                        <center><h4><b>ASSOCIAÇÕES</b></h4></center>  
                      </div>
                        <table class="table table-striped table-bordered   table-hover">
                          <thead>
                            <tr>
                             <!-- <th style="width: 120px">RG</th>-->
                              <th style="width: 10px">&nbsp</th>   
                              <th style="width: 55px">&nbsp</th>
                             <!-- <th>E-mail</th>
                              <th style="width: 190px">Observação</th>
                              <th style="width: 50px">&nbsp;</th>-->
                            </tr>
                          </thead>
                          <tbody>


                             <tr>
                              <td><b>Associações Efetivadas</b></td><td><?php echo htmlspecialchars( $dadosEmpresas["associacaoEfetivada"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>  
                            </tr>

                             <tr>
                              <td><b>Associações em Negociação</b></td><td><?php echo htmlspecialchars( $dadosEmpresas["associacao_em_negociacao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>  
                            </tr> 

                          
                          



                          <!-- <td>Visita realizada e demanda gerada para várias casas e que ainda necessitam ser visualizadas</td>
                              <td>
                                
                                <a href="#" class="btn btn-primary btn-xs"><i class="fa fa-info"></i> <b> Detalhes da Visita</b></a>
                                <a href="#"  class="btn btn-danger btn-xs" title="Remover notificação de demanda"><i class="fa fa-close"></i> <b></b></a>
                              </td>-->



                          </tbody>
                        </table>

                       </div>


                        <div class="col-md-6">
                         <div class="col-sm-12"><br>
                        <center><h4><b>NÃO ASSOCIADO PARA ASSOCIADO</b></h4></center>  
                      </div>
                        <table class="table table-striped table-bordered   table-hover">
                          <thead>
                            <tr>
                             <!-- <th style="width: 120px">RG</th>-->
                              <th style="">&nbsp</th>   
                             
                             <!-- <th>E-mail</th>
                              <th style="width: 190px">Observação</th>
                              <th style="width: 50px">&nbsp;</th>-->
                            </tr>
                          </thead>
                          <tbody>


                             <tr>
                              <td><b>Total</b></td><td>0</td>  
                            </tr>

                           

                          
                          



                          <!-- <td>Visita realizada e demanda gerada para várias casas e que ainda necessitam ser visualizadas</td>
                              <td>
                                
                                <a href="#" class="btn btn-primary btn-xs"><i class="fa fa-info"></i> <b> Detalhes da Visita</b></a>
                                <a href="#"  class="btn btn-danger btn-xs" title="Remover notificação de demanda"><i class="fa fa-close"></i> <b></b></a>
                              </td>-->



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
