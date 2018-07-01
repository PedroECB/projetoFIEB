<?php if(!class_exists('Rain\Tpl')){exit;}?>




<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">

  <h1>
     <small>EMPRESAS CADASTRADAS</small>
  </h1>
  
  <ol class="breadcrumb">
    <li><a href="/user"><i class="fa fa-home"></i> Início</a></li>
    <li class="active"><a href="/user/empresas">Empresas</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
            
            <div class="box-header">
              <!--<a href="#" class="btn btn-success btn-block"> --><h4 class="text-primary"><center><b>EMPRESAS</b></center></h4> <!--</a>-->
            </div>

            <div class="box-body no-padding">
              <table class="table table-striped table-bordered text-center table-responsive table-hover">
                <thead >
                  <tr>
                   <!-- <th style="width: 120px">RG</th>-->
                    <th style="width: 30px; vertical-align: middle;" class="md2-some">CNPJ</th>   
                    <th style="width: 80px; vertical-align: middle;">Nome Fantasia</th>
                    <th style="width: 100px; vertical-align: middle;">Situação da Associação</th>
                    <th  style="width:30px; vertical-align: middle;" class="md2-some">Município</th>
                    <th style="width: 50px; vertical-align: middle;" class="md2-some">Região</th>
                    <th style="width: 140px; vertical-align: middle;">&nbsp;</th>
                  </tr>
                </thead>
                <tbody>

               

                <?php $counter1=-1;  if( isset($empresas) && ( is_array($empresas) || $empresas instanceof Traversable ) && sizeof($empresas) ) foreach( $empresas as $key1 => $value1 ){ $counter1++; ?>


                 <tr>
                    <td class="md2-some"><?php echo htmlspecialchars( $value1["cnpj"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td><?php echo htmlspecialchars( $value1["nome_fantasia"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>

                    <!--<td><?php echo htmlspecialchars( $value1["situacao_associacao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>-->
                    <td>
                    <?php if( $value1["situacao_associacao"] == 'Não Associada' ){ ?><span class="text-danger">Não Associada</span><?php } ?>

                    <?php if( $value1["situacao_associacao"] == 'Associada' ){ ?><span class="text-success">Associada</span><?php } ?>

                    <?php if( $value1["situacao_associacao"] == 'Associação em Negociação' ){ ?><span class="text-primary">Associação em Negociação</span><?php } ?>

                    <?php if( $value1["situacao_associacao"] == 'Associação Efetivada' ){ ?><span class="text-warning">Associação Efetivada</span><?php } ?>

                  </td>

                    <td class="md2-some"><?php echo htmlspecialchars( $value1["municipio"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td class="md2-some"><?php echo htmlspecialchars( $value1["regiao_estado"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td>
                      <a href="/user/agendarvisita/<?php echo htmlspecialchars( $value1["idEmpresas"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-default btn-xs"><i class="fa fa-calendar-o"></i><b> &nbspAgendar Visita</b></a>
                      <a href="/user/empresas/<?php echo htmlspecialchars( $value1["idEmpresas"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"  class="btn btn-primary btn-xs"><i class="fa fa-info"></i> <b>Detalhes</b></a>
                    </td>
                  </tr>


                <?php } ?>







                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
    </div>
  </div>

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
