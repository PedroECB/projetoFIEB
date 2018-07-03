<?php if(!class_exists('Rain\Tpl')){exit;}?>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <b>CASAS</b>

  </h1>
  <ol class="breadcrumb">
    <li><a href="/admin"><i class="fa fa-home"></i> Início</a></li>
    <li><a href="#">Relatório Casas</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">


<div class="col-md-12">
    <div class="row">

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
            <a href="/admin/relatorio-casa/<?php echo htmlspecialchars( $value1["idCasas"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="small-box-footer">
              Relatórios <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
<?php } ?>


    








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
