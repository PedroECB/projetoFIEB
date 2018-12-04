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



<!-- RELATÓRIOS NEW -->

      <div class="box-header" id="casas">
        <h4 class="text-center text-primary"><b>RELATÓRIOS DO CICLO</b></h4>
        <hr style="margin-bottom: -5px;">  
      </div>



      <div class="row">
       <div class="col-md-10">

        <table class="table table-responsive text-center table-bordered table-hover table-striped">
          <thead>
            <th style="width: 35px;">Sindicato</th>
            <th style="width: 30px">Nº de Emp. Selecionadas</th>
            <th style="width: 15px">Visitas Realizadas</th>
            <th style="width: 15px">Agendadas</th>
            <th style="width: 15px">Ass. em Andamento</th>
            <th style="width: 15px">Ass. em Negociação</th>
            <th style="width: 15px">Novas Associações</th>
            <th style="width: 15px">Total Visitas</th>
          </thead>
          <tbody>
            
            <tr>
              <td class="text-primary"><b>SINDIREPA</b></td>
              <td>37</td>
              <td>12</td>
              <td>3</td>
              <td>32</td>
              <td>5</td>
              <td>3</td>
              <td>10</td>
            </tr>

             <tr>
              <td class="text-primary"><b>SINDRATAR</b></td>
              <td>37</td>
              <td>12</td>
              <td>3</td>
              <td>32</td>
              <td>5</td>
              <td>3</td>
              <td>10</td>
            </tr>

             <tr>
              <td class="text-primary"><b>SINDLEITE</b></td>
              <td>37</td>
              <td>12</td>
              <td>3</td>
              <td>32</td>
              <td>5</td>
              <td>3</td>
              <td>10</td>
            </tr>
             <tr style="background-color: #dddddd;">
              <td><b>TOTAL</b></td>
              <td>37</td>
              <td>12</td>
              <td>3</td>
              <td>32</td>
              <td>5</td>
              <td>3</td>
              <td>10</td>
            </tr>
          </tbody>
        </table>

       <table class="table text-center table-striped table-hover">
        <thead>
          <th style="width: 25px">Casa</th>
          <th style="width: 15px">Nº de Emp. Selecionadas</th>
          <th style="width: 15px">Visitas Realizadas</th>
          <th style="width: 15px">Agendadas</th>
          <th style="width: 15px">Negociações</th>
          <th style="width: 15px">Negociações em Andamento</th>
          <th style="width: 15px">Total Visitas</th>
        </thead>
        <tbody>
           <tr>
              <td class="text-danger"><b>SESI</b></td>
              <td>37</td>
              <td>12</td>
              <td>3</td>
              <td>32</td>
              <td>5</td>
              <td>3</td>
            </tr>

            <tr>
              <td class="text-danger"><b>SENAI</b></td>
              <td>37</td>
              <td>12</td>
              <td>3</td>
              <td>32</td>
              <td>5</td>
              <td>3</td>
            </tr>

            <tr>
              <td class="text-danger"><b>IEL</b></td>
              <td>37</td>
              <td>12</td>
              <td>3</td>
              <td>32</td>
              <td>5</td>
              <td>3</td>
            </tr>

            <tr>
              <td class="text-danger"><b>CIEB</b></td>
              <td>37</td>
              <td>12</td>
              <td>3</td>
              <td>32</td>
              <td>5</td>
              <td>3</td>
            </tr>

            <tr style="background-color: #dddddd;">
              <td><b>TOTAL</b></td>
              <td>37</td>
              <td>12</td>
              <td>3</td>
              <td>32</td>
              <td>5</td>
              <td>3</td>
            </tr>
        </tbody>
      </table>

   </div>
    
    <div class="col-md-2">
     <table class="text-center">
       <thead>
         <th> - </th>
       </thead>
       <tbody>
        <tr><td class="text-primary"><b>Meta de visitas - <span class="badge bg-blue"> 295 </span></b></td></tr>
        <tr>
          <td>
                      <div class="progress progress">
                      <div class="progress-bar progress-bar-blue" style="width: 20%">50</div>
                      <div class="progress-bar progress-bar-green" style="width: 40%">120</div>
              </div>
          </td>
          <!-- <td><span class="badge bg-light-blue">13/270</span></td> -->
        </tr>

        <tr><td class="text-primary"><b>Indústrias visitadas</b></td></tr>
        <tr><td><span class="badge bg-light-blue">50%</span></td></tr>
        
        <tr><td class="text-primary"><b>Novas Associações</b></td></tr>
        <tr><td><span class="badge bg-light-blue">20%</span></td></tr>
        
        <tr><td class="text-primary"><b>Propostas Demandadas</b></td></tr>
        <tr><td><span class="badge bg-light-blue">10%</span></td></tr>

         <tr><td class="text-primary"><b>Formulário de Assoc...</b></td></tr>
        <tr><td><b>-</b></td></tr>

         <tr><td class="text-primary"><b>Contratos Assinados</b></td></tr>
        <tr><td><b>-</b></td></tr>

       </tbody>
     </table>

          <table class="text-center">
       <thead>
         <th> - </th>
       </thead>
       <tbody>
        <tr><td class="text-success"><b>Nº de Empresas</b></td></tr>
        <tr><td><span class="badge bg-green">70</span></td></tr>
        
        <tr><td class="text-success"><b>Visitas Realizadas</b></td></tr>
        <tr><td><span class="badge bg-green">25</span></td></tr>
        
        <tr><td class="text-success"><b>Visitas Agendadas</b></td></tr>
        <tr><td><span class="badge bg-green">93</span></td></tr>

         <tr><td class="text-success"><b>Negociações</b></td></tr>
        <tr><td><b>-</b></td></tr>

         <tr><td class="text-success"><b>Negociações em Andamento</b></td></tr>
         <tr><td><b>-</b></td></tr>

         <tr><td class="text-success"><b>Associação em Negociação</b></td></tr>
         <tr><td><b>-</b></td></tr>

         <tr><td class="text-success"><b>Novas Associações</b></td></tr>
        <tr><td><b>-</b></td></tr>

       </tbody>
     </table>




   </div>

</div> <!-- FIM ROW -->
 
<div class="row">
  <div class="col-md-4">
    <table class="table text-center">
      <thead>
        <tr class="bg-primary"><th colspan="3">Empresas por Região</th></tr>
        <th>Região</th>
        <th>Visitadas</th>
        <th>Empresas</th>
      </thead>
      
      <tbody>
        <tr>
          <td style="color:#001F3F"><b>Central</b></td>
          <td>12</td>
          <td>30</td>
        </tr>

       <tr>
          <td style="color:#001F3F"><b>Sudeste</b></td>
          <td>12</td>
          <td>30</td>
        </tr>

       <tr>
          <td style="color:#001F3F"><b>Sul</b></td>
          <td>12</td>
          <td>30</td>
        </tr>
      </tbody>
    
    </table>
  </div>

  <div class="col-md-4">
    <table class="table">
      <thead>
        <th colspan="3" class="text-center">Agendamentos</th>
      <!--   <th>Visitadas</th>
        <th>Empresas</th> -->
      </thead>
      
      <tbody>
        <tr>
          <td>
            <span class="badge bg-blue">SENAI 20</span>
            <span class="badge bg-red">SESI 30</span>
            <span class="badge bg-green">IEL 40</span>
            <span class="badge bg-yellow">CIEB 10</span>
          </td>
        </tr>
        <tr>
          <td colspan="3">
             <div class="progress progress">
                      <div class="progress-bar progress-bar-blue" style="width: 20%"></div>
                      <div class="progress-bar progress-bar-danger" style="width: 30%"></div>
                      <div class="progress-bar progress-bar-green" style="width: 40%"></div>
                      <div class="progress-bar progress-bar-yellow" style="width: 10%"></div>
              </div>
          </td>
        </tr>

      </tbody>
    
    </table>
  </div>

    <div class="col-md-4">
    <table class="table">
      <thead>
        <th colspan="3" class="text-center">Associações</th>
      <!--   <th>Visitadas</th>
        <th>Empresas</th> -->
      </thead>
      
      <tbody>
        <tr>
          <td>
            <span class="badge bg-blue">Não Associadas 20</span>
            <span class="badge bg-red">Associadas 12</span>
            <span class="badge bg-green">Assoc. em Negociação 5</span>
          </td>
        </tr>
        <tr>
          <td colspan="3">
             <div class="progress progress">
                      <div class="progress-bar progress-bar-blue" style="width: 20%"></div>
                      <div class="progress-bar progress-bar-danger" style="width: 12%"></div>
                      <div class="progress-bar progress-bar-green" style="width: 5%"></div>
              </div>
          </td>
        </tr>

      </tbody>
    
    </table>
  </div>

</div> <!-- ROW -->




<div class="row">
  
  <div class="col-md-4">
    <table class="table text-center">
      <thead>
        <tr class="bg-primary"><th colspan="3">RECEITA</th></tr>
        <th>Entidades</th>
        <th>Receita</th>
        <th>Produto</th>
      </thead>
      
      <tbody>
        <tr>
          <td style="color:#001F3F"><b>SESI</b></td>
          <td>R$ 0</td>
          <td> </td>
        </tr>

       <tr>
          <td style="color:#001F3F"><b>SENAI</b></td>
          <td>R$ 0</td>
          <td></td>
        </tr>

       <tr>
          <td style="color:#001F3F"><b>IEL</b></td>
          <td>R$ 0</td>
          <td></td>
        </tr>
      </tbody>
    
    </table>
  </div>

</div> <!-- ROW -->


<!-- <table class="table table-bordered">
                <tbody><tr>
                  <th style="width: 10px"></th>
                  <th>Task</th>
                  <th>Progress</th>
                  <th style="width: 40px">Label</th>
                </tr>
                <tr>
                  <td>1.</td>
                  <td>Update software</td>
                  <td>
                    <div class="progress progress-xs">
                      <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                      <div class="progress-bar progress-bar-yellow" style="width: 45%"></div>
                    </div>
                  </td>
                  <td><span class="badge bg-red">55%</span></td>
                </tr>
                <tr>
                  <td>2.</td>
                  <td>Clean database</td>
                  <td>
                    <div class="progress progress-xs">
                      <div class="progress-bar progress-bar-yellow" style="width: 70%"></div>
                    </div>
                  </td>
                  <td><span class="badge bg-yellow">70%</span></td>
                </tr>
                <tr>
                  <td>3.</td>
                  <td>Cron job running</td>
                  <td>
                    <div class="progress progress-xs progress-striped active">
                      <div class="progress-bar progress-bar-primary" style="width: 30%"></div>
                    </div>
                  </td>
                  <td><span class="badge bg-light-blue">30%</span></td>
                </tr>
                <tr>
                  <td>4.</td>
                  <td>Fix and squish bugs</td>
                  <td>
                    <div class="progress progress-xs progress-striped active">
                      <div class="progress-bar progress-bar-success" style="width: 90%"></div>
                    </div>
                  </td>
                  <td><span class="badge bg-green">90%</span></td>
                </tr>
              </tbody></table> -->





<!-- FIM RELATORIOS NEW-->

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





