<?php if(!class_exists('Rain\Tpl')){exit;}?>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">

  <h1>
     <small><b>TODAS AS VISITAS</b></small>
  </h1>
  
  <ol class="breadcrumb">
    <button class="btn btn-xs"><li><a href="/admin"><i class="fa fa-home"></i> Início</a></li></button>
    <button class="btn btn-xs"><li class="active"><a href="/admin/visitas">Visitas geral</a></li></button>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
            
            <div class="box-header">
              <h4 class="text-primary"><center><b>VISITAS - GERAL</b></center></h4>
              <div class="box-tools">
                <form action="/admin/visitas">
                  <div class="input-group input-group" style="width: 200px;top:9px;">
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
                    <th style="width: 30px; vertical-align: middle;">Empresa</th>   
                    <th style="width: 100px; vertical-align: middle;">Situação da Visita</th>
                    <th style="width: 50px; vertical-align: middle;" class="xs-some">Sindicato/Casa</th>
                    <th  style="width:30px; vertical-align: middle;" class="md-some">Município</th>
                    <th style="width: 50px; vertical-align: middle;" class="md-some">Data Prevista</th>
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
                    <td class="md-some"><?php echo date('d/m/Y',strtotime($value1["data_prevista"])); ?></td>
                    <td>
                     <!-- <a href="#" class="btn btn-default btn-xs"><i class="fa fa-calendar-o"></i><b> &nbspAgendar Visita</b></a>-->
                      <a href="/admin/visitas-info/<?php echo htmlspecialchars( $value1["idVisita"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"  class="btn btn-primary btn-xs"><i class="fa fa-info"></i> <b>Detalhes</b></a>
                    </td>
                  </tr> 

                <?php } ?>







                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <button class="btn btn-success btn-xs"><a href="" style="color:white;"><b>Exportar para o Excel</b></a></button>
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
