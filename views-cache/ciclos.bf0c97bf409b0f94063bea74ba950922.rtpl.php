<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">



  <h1>  <!--<b>CICLOS</b>-->
    <small><b>CICLOS INICIADOS</b></small>
  </h1>

 
  
  <ol class="breadcrumb">
    <button class="btn btn-xs"><li><a href="/admin"><i class="fa fa-home"></i> Início</a></li></button>
    <button class="btn btn-xs"><li class="active"><a href="#">Ciclos</a></li></button>
  </ol>
   <a href="/admin/ciclo-create"><button style="margin-top: 5px;" class="btn btn-primary"><b>NOVO CICLO</b></button></a>
</section>

<!-- Main content -->
<section class="content">

  <div class="row">
    <div class="col-md-12">

    <div class="box box-primary">  
     <div class="box-header with-border">

      <div class="col-md-12">

       <center>
        <h3 class="box-title" style="vertical-align: middle;"><b>CICLOS</b></h3>
        <a href="javascript:history.back();"><button style="margin-left: 40px;" class="btn btn-link navbar-right"><b>Voltar</b></button></a>
       </center>

      </div>
         

</div>
  
<div class="box-body">

<?php $counter1=-1;  if( isset($ciclos) && ( is_array($ciclos) || $ciclos instanceof Traversable ) && sizeof($ciclos) ) foreach( $ciclos as $key1 => $value1 ){ $counter1++; ?>


      <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-blue">
              <a href="#Relatorios" style="color:white;"><span class="info-box-icon"><i class="fa fa-calendar"></i></span></a>

            <div class="info-box-content">
                    <b><span class="info-box-text text-center"><?php echo htmlspecialchars( $value1["nome_ciclo"], ENT_COMPAT, 'UTF-8', FALSE ); ?> CICLO</span></b>
                       <div class=""> 
                          <b>Início</b> - <?php echo date('d/m/Y', strtotime($value1["data_inicio"])); ?><br>
                          <b>Fim</b> - <?php echo date('d/m/Y', strtotime($value1["data_termino"])); ?>

                      </div> 
                    <!--<span class="info-box-number">01/01/2018</span>
                    <span class="info-box-number">01/01/2018</span>-->
                  <div class="col-md-12">
                    <a href="/admin/ciclos/<?php echo htmlspecialchars( $value1["idCiclo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" style="color:white;"><i class="fa fa-pencil-square navbar-right" title="Editar ciclo"></i></a>
                  </div>
            </div>
            <!-- /.info-box-content -->
          </div>
    
          <!-- /.info-box -->
        </div>

<?php } ?>


           



</div>       

</div>


















            <!-- /.box-body -->
          
    </div>
  </div>

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
