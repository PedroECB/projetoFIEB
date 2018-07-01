<?php if(!class_exists('Rain\Tpl')){exit;}?>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">

  <h1>
     <small>TODAS AS VISITAS</small>
  </h1>
  
  <ol class="breadcrumb">
    <li><a href="/user2"><i class="fa fa-home"></i> Início</a></li>
    <li class="active"><a href="/user2/visitas">Visitas</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
            
            <div class="box-header">
              <!--<a href="#" class="btn btn-success btn-block"> --><h4 class="text-primary"><center><b>VISITAS</b></center></h4> <!--</a>-->
            </div>

            <div class="box-body no-padding">
              <table class="table table-striped table-bordered text-center table-responsive table-hover">
                <thead >
                  <tr>
                   <!-- <th style="width: 120px">RG</th>-->
                    <th style="width: 30px; vertical-align: middle;">Empresa</th>   
                    <th style="width: 100px; vertical-align: middle;">Situação da Visita</th>
                    <th style="width: 50px; vertical-align: middle;" class="xs-some">Sindicato/Casa</th>
                    <th  style="width:30px; vertical-align: middle;" class="md-some">Município</th>
                    <th style="width: 50px; vertical-align: middle;" class="md-some">Região</th>
                    <th style="width: 140px; vertical-align: middle;">&nbsp;</th>
                  </tr>
                </thead>
                <tbody>

      

                <?php $counter1=-1;  if( isset($visitas) && ( is_array($visitas) || $visitas instanceof Traversable ) && sizeof($visitas) ) foreach( $visitas as $key1 => $value1 ){ $counter1++; ?>

                   <tr>
                    <td><?php echo htmlspecialchars( $value1["nome_fantasia"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td><?php echo htmlspecialchars( $value1["status_visita"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td class="xs-some"><?php echo htmlspecialchars( $value1["origem"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td class="md-some"><?php echo htmlspecialchars( $value1["municipio"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td class="md-some"><?php echo htmlspecialchars( $value1["regiao_estado"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td>
                     <!-- <a href="#" class="btn btn-default btn-xs"><i class="fa fa-calendar-o"></i><b> &nbspAgendar Visita</b></a>-->
                      <a href="/user2/visitas-info/<?php echo htmlspecialchars( $value1["idVisita"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"  class="btn btn-primary btn-xs"><i class="fa fa-info"></i> <b>Detalhes</b></a>
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
