<?php if(!class_exists('Rain\Tpl')){exit;}?>




<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">

  <h1>
     <small><b>EMPRESAS CADASTRADAS </b></small>
  </h1>
  
  <ol class="breadcrumb">
    <button class="btn btn-xs"><li><a href="/user2"><i class="fa fa-home"></i> Início</a></li></button>
    <button class="btn btn-xs"><li class="active"><a href="/user2/empresas"><i class="fa fa-industry"></i> Empresas geral</a></li></button>
    <button class="btn btn-xs"><li class="active"><a href="/user2/empresas/origem"><i class="fa fa-square"></i> Todas empresas <?php echo htmlspecialchars( $origem, ENT_COMPAT, 'UTF-8', FALSE ); ?></a></li></button>
    <button class="btn btn-xs"><li class="active"><a href="/user2/empresas-ciclo-atual"><i class="fa fa-circle-o-notch"></i> Empresas <?php echo htmlspecialchars( $origem, ENT_COMPAT, 'UTF-8', FALSE ); ?> ciclo atual</a></li></button>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
            
            <div class="box-header">
              <!--<a href="#" class="btn btn-success btn-block"> --><h4 class="text-primary"><center><b>EMPRESAS - GERAL</b></center></h4> <!--</a>-->
  
              <div class="box-tools">
                <form action="/user2/empresas">
                  <div class="input-group input-group-md" style="width: 205px; margin-top: 10px;">
                    <input type="text" name="search" class="form-control pull-right" placeholder="Buscar" value="<?php echo htmlspecialchars( $search, ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                    <div class="input-group-btn">
                      <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                    </div>
                  </div>
                </form>
              </div>
              <hr>
            </div>

            <div class="box-body no-padding">
              <table class="table table-striped table-bordered text-center table-responsive table-hover">
                <thead >
                  <tr>
                   <!-- <th style="width: 120px">RG</th>-->
                    <th style="width: 30px; vertical-align: middle;" class="md2-some">CNPJ</th>   
                    <th style="width: 100px; vertical-align: middle;">Razão Social</th>
                    <th style="width: 60px; vertical-align: middle;">Situação da Associação</th>
                    <th  style="width:30px; vertical-align: middle;" class="md2-some">Município</th>
                    <th style="width: 40px; vertical-align: middle;" class="md2-some">Entidade</th>
                    <th style="width: 140px; vertical-align: middle;">&nbsp;</th>
                  </tr>
                </thead>
                <tbody>

               

                <?php $counter1=-1;  if( isset($empresas) && ( is_array($empresas) || $empresas instanceof Traversable ) && sizeof($empresas) ) foreach( $empresas as $key1 => $value1 ){ $counter1++; ?>


                 <tr>
                    <td class="md2-some"><?php echo htmlspecialchars( $value1["cnpj"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td><?php echo htmlspecialchars( $value1["razao_social"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>

                    <!--<td><?php echo htmlspecialchars( $value1["situacao_associacao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>-->
                    <td>
                    <?php if( $value1["situacao_associacao"] == 'Não Associada' ){ ?><span class="text-danger">Não Associada</span><?php } ?>

                    <?php if( $value1["situacao_associacao"] == 'Associada' ){ ?><span class="text-success">Associada</span><?php } ?>

                    <?php if( $value1["situacao_associacao"] == 'Associação em Negociação' ){ ?><span class="text-primary">Associação em Negociação</span><?php } ?>

                    <?php if( $value1["situacao_associacao"] == 'Associação Efetivada' ){ ?><span class="text-warning">Associação Efetivada</span><?php } ?>

                  </td>

                    <td class="md2-some"><?php echo htmlspecialchars( $value1["municipio"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td class="md2-some"><?php echo htmlspecialchars( $value1["origem_cadastro"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td>
                      <a href="/user2/agendarvisita/<?php echo htmlspecialchars( $value1["idEmpresas"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-default btn-xs"><i class="fa fa-calendar-o"></i><b> Agendar Visita</b></a>
                      <a href="/user2/empresas/<?php echo htmlspecialchars( $value1["idEmpresas"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"  class="btn btn-primary btn-xs">&nbsp&nbsp&nbsp&nbsp&nbsp<i class="fa fa-info"></i> <b>&nbsp&nbsp&nbsp Detalhes &nbsp&nbsp&nbsp&nbsp&nbsp</b></a>
                    </td>
                  </tr>


                <?php } ?>







                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
                
                 <a href="/user2/export-empresas-geral" style="color:white;"><button class="btn btn-success btn-xs"><b><i class="fa fa-th"></i> Exportar para o Excel</b></button></a>

              <ul class="pagination pagination-sm no-margin pull-right">
                <?php $counter1=-1;  if( isset($pages) && ( is_array($pages) || $pages instanceof Traversable ) && sizeof($pages) ) foreach( $pages as $key1 => $value1 ){ $counter1++; ?>

                <li><a href="<?php echo htmlspecialchars( $value1["href"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["text"], ENT_COMPAT, 'UTF-8', FALSE ); ?></a></li>
                <?php } ?>

              </ul>
            </div>
          </div>
    </div>
  </div>

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
