<?php if(!class_exists('Rain\Tpl')){exit;}?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <small><b>RELATÓRIOS ENTRE <?php echo date('d/m/Y', strtotime($ciclo["data_inicio"])); ?> - <?php echo date('d/m/Y', strtotime($ciclo["data_termino"])); ?></b></small>

  </h1>
  <ol class="breadcrumb">
    <button class="btn btn-xs"><li><a href="/admin"><i class="fa fa-home"></i> Início</a></li></button>
    <button class="btn btn-xs"><li><a href="/admin/ciclos-relat/"><i class="fa fa-circle-o-notch"></i> Relatórios por ciclo</a></li></button>
    <button class="btn btn-xs"><li><a href="#sindicatos"><i class="fa fa-suitcase"></i> Sindicatos</a></li></button>
    <button class="btn btn-xs"><li><a href="#casas"><i class="fa fa-home"></i> Casas</a></li></button>
  </ol>
</section>

<!-- Main content -->
<section class="content">


<div class="col-md-12">
    <div class="row">

<div class="box box-primary">

<div class="box-header">
    <h4 class="text-center text-primary"><b>SINDICATOS</b></h4>
    <hr style="margin-bottom: -5px;">  
</div>

<div class="box-body">
    <div id="sindicatos">
  <?php $counter1=-1;  if( isset($sindicatos) && ( is_array($sindicatos) || $sindicatos instanceof Traversable ) && sizeof($sindicatos) ) foreach( $sindicatos as $key1 => $value1 ){ $counter1++; ?>


      
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-blue">
              <div class="inner">
                <h4><b><?php echo htmlspecialchars( $value1["nome_sindicato"], ENT_COMPAT, 'UTF-8', FALSE ); ?></b></h4>

               <!-- <p>Bounce Rate</p>-->
              </div>
              <div class="icon">
                <!--<i class="ion ion-stats-bars"></i>-->
              </div>
              <!-- <a href="/ciclos/<?php echo htmlspecialchars( $value1["idSindicato"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/<?php echo htmlspecialchars( $ciclo["idCiclo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/" class="small-box-footer">
                Relatórios <i class="fa fa-arrow-circle-right"></i>
              </a> -->
              <a href="/admin/<?php echo htmlspecialchars( $ciclo["idCiclo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/<?php echo htmlspecialchars( $value1["idSindicato"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="small-box-footer">
                Relatórios <i class="fa fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>

  <?php } ?>

   </div>





<div class="box-header">
  
</div>
<div class="box-header" id="casas">
    <h4 class="text-center text-danger"><b>CASAS</b></h4>
    <hr style="margin-bottom: -5px;">  
</div>
<?php $counter1=-1;  if( isset($casas) && ( is_array($casas) || $casas instanceof Traversable ) && sizeof($casas) ) foreach( $casas as $key1 => $value1 ){ $counter1++; ?>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo htmlspecialchars( $value1["nome_casa"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>

             <!-- <p>Bounce Rate</p>-->
            </div>
            <div class="icon">
              <!--<i class="ion ion-stats-bars"></i>-->
            </div>
            <a href="/admin-relatorios-por-ciclo/<?php echo htmlspecialchars( $value1["idCasas"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/<?php echo htmlspecialchars( $ciclo["idCiclo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="small-box-footer">
              Relatórios <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
<?php } ?>


</div>

</div>





        <!-- ./col 
        <div class="col-lg-3 col-xs-6">
          
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>44</h3>

              <p>User Registrations</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>

-->


        <!-- ./col 
        <div class="col-lg-3 col-xs-6">
           small box 
          <div class="small-box bg-red">
            <div class="inner">
              <h3>65</h3>

              <p>Unique Visitors</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>

-->


        <!-- ./col -->
      </div>
</div>
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->





