<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">

  <h1>
     <small>DEMANDAS GERADAS DE OUTRAS VISITAS</small>
  </h1>
  
  <ol class="breadcrumb">
    <li><a href="/user"><i class="fa fa-home"></i> Início</a></li>
    <li class="active"><a href="">Demandas</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
            
            <div class="box-header">
              <div class="col-sm-12">
              <!--<a href="#" class="btn btn-success btn-block"> --><h4 class="text-primary"><center><b>DEMANDAS IDENTIFICADAS EM OUTRAS VISITAS</b><a href="javascript:history.back();"><button class="btn btn-link navbar-right"><b>Voltar</b></button></a></center></h4> <!--</a>-->
              </div>
            </div>

            <div class="box-body no-padding">
              <table class="table table-striped table-bordered text-center  table-hover">
                <thead>
                  <tr>
                   <!-- <th style="width: 120px">RG</th>-->
                    <th style="width: 100px">Data de Realização da Visita</th>   
                    <th style="width: 85px" class="md-some">Familia do Produto Ofertado</th>
                   <!-- <th>E-mail</th>-->
                    <th style="width: 190px">Observação</th>
                    <th style="width: 50px">&nbsp;</th>
                  </tr>
                </thead>
                <tbody>

                <!--

                  <?php $counter1=-1;  if( isset($users) && ( is_array($users) || $users instanceof Traversable ) && sizeof($users) ) foreach( $users as $key1 => $value1 ){ $counter1++; ?>

                  <tr>
                    <td><?php echo htmlspecialchars( $value1["rg_func"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td><?php echo htmlspecialchars( $value1["nome_func"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td><?php echo htmlspecialchars( $value1["cargo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td><?php echo htmlspecialchars( $value1["origem"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td/>
                  
                    <td><?php if( $value1["nivel_acesso"] == 1 ){ ?>Administrador<?php } ?>

                        <?php if( $value1["nivel_acesso"] == 2 ){ ?>Ponto Focal<?php } ?>

                        <?php if( $value1["nivel_acesso"] == 3 ){ ?>Comum<?php } ?>


                      </td>

                    <td>
                      <a href="/admin/users/<?php echo htmlspecialchars( $value1["idFuncionario"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-primary btn-xs"><i class="fa fa-info"></i> Info</a>
                      <a href="/admin/users/<?php echo htmlspecialchars( $value1["idFuncionario"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/delete" onclick="return confirm('Deseja realmente excluir este usuário?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Excluir</a>
                    </td>
                  </tr>
                 
                  <?php } ?>


                -->

                 <?php $counter1=-1;  if( isset($demandas) && ( is_array($demandas) || $demandas instanceof Traversable ) && sizeof($demandas) ) foreach( $demandas as $key1 => $value1 ){ $counter1++; ?>

                   <tr>
                    <td><?php echo date('d/m/Y', strtotime($value1["data_realizacao"])); ?></td>
                    <td class="md-some"><?php echo htmlspecialchars( $value1["familia_prod"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
        
                    <td><?php echo htmlspecialchars( $value1["observacao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td>
                      
                      <a href="/user/visitas-info/<?php echo htmlspecialchars( $value1["idVisita"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-primary btn-xs">&nbsp&nbsp<i class="fa fa-info"></i> <b> &nbsp</b></a>
                      <a href="/user/demanda/<?php echo htmlspecialchars( $value1["idDemanda"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/delete"  class="btn btn-danger btn-xs" title="Remover notificação de demanda">&nbsp<i class="fa fa-close"></i>&nbsp <b></b></a>
                    </td>
                  </tr> 
                <?php } ?>





          






                </tbody>
              </table>
                <?php if( !$demandas ){ ?>

                <br>
                <div>
                  
                  <center><h4 class="text-danger">NENHUMA NOTIFICAÇÃO DE DEMANDA DISPONÍVEL</h4></center>

                </div><br>

                <?php } ?>

            </div>
            <!-- /.box-body -->


          </div>
    </div>
  </div>

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->


