<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
 
  
  <h1>
     <small><b>SINDICATOS</b></small>
  </h1>

  <br><a href="/admin/sindicatos-create"><button type="button" class="btn btn-primary"><b>NOVO SINDICATO</b></button></a>

  <ol class="breadcrumb">
    <button class="btn btn-xs"><li><a href="/admin"><i class="fa fa-home"></i> Início</a></li></button>
    <button class="btn btn-xs"><li><a href="/admin/sindicatos">Sindicatos</a></li></button>
  </ol>
</section>

<!-- Main content -->
<section class="content">

    <div class="row">

      <?php $counter1=-1;  if( isset($sindicatos) && ( is_array($sindicatos) || $sindicatos instanceof Traversable ) && sizeof($sindicatos) ) foreach( $sindicatos as $key1 => $value1 ){ $counter1++; ?>

         <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue" title="<?php echo htmlspecialchars( $value1["nome_sindicato"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
            <div class="inner">
             <h4><b><?php echo htmlspecialchars( $value1["nome_sindicato"], ENT_COMPAT, 'UTF-8', FALSE ); ?></b></h4>
             <!-- <p>Bounce Rate</p>-->
            </div>
            <div class="icon">
              <!--<i class="ion ion-stats-bars"></i>-->
            </div>
            <a href="/admin/relatorio-sindicato/<?php echo htmlspecialchars( $value1["idSindicato"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="small-box-footer">
              Relatórios &nbsp<i class="fa fa-pie-chart"></i>
            </a>

            <a href="/admin/sindicato-edit/<?php echo htmlspecialchars( $value1["idSindicato"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="small-box-footer">
              Editar &nbsp<i class="fa fa-pencil-square"></i>
            </a>
          </div>
        </div>






      <?php } ?>



      </div>

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
