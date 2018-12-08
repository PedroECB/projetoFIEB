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
        <h4 class="text-center text-primary"><b>RELATÓRIOS DO CICLO &nbsp <span class="text-success"><?php echo date('d/m/Y', strtotime($ciclo["data_inicio"])); ?> - <?php echo date('d/m/Y', strtotime($ciclo["data_termino"])); ?></span></b></h4>
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
            <?php $counter1=-1;  if( isset($dadosSindicato) && ( is_array($dadosSindicato) || $dadosSindicato instanceof Traversable ) && sizeof($dadosSindicato) ) foreach( $dadosSindicato as $key1 => $value1 ){ $counter1++; ?>


              <tr>
                <td class="text-primary"><b><?php echo htmlspecialchars( $value1["nomeSindicato"], ENT_COMPAT, 'UTF-8', FALSE ); ?></b></td>
                <td><?php echo htmlspecialchars( $value1["empresas_selecionadas"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                <td><?php echo htmlspecialchars( $value1["visitas_realizadas"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                <td><?php echo htmlspecialchars( $value1["visitas_agendadas"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                <td><?php echo htmlspecialchars( $value1["EmAndamento"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                <td><?php echo htmlspecialchars( $value1["associacao_em_negociacao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                <td><?php echo htmlspecialchars( $value1["associacaoEfetivada"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                <td><?php echo htmlspecialchars( $value1["totalVisitas"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
              </tr>


            <?php } ?>


             <tr style="background-color: #dddddd;">
              <td><b>TOTAL</b></td>
              <td><b><?php echo htmlspecialchars( $dadosTotaisSindicatos["total_empresas_selecionadas"], ENT_COMPAT, 'UTF-8', FALSE ); ?></b></td>
              <td><b><?php echo htmlspecialchars( $dadosTotaisSindicatos["total_visitas_realizadas"], ENT_COMPAT, 'UTF-8', FALSE ); ?></b></td>
              <td><b><?php echo htmlspecialchars( $dadosTotaisSindicatos["total_visitas_agendadas"], ENT_COMPAT, 'UTF-8', FALSE ); ?></b></td>
              <td><b><?php echo htmlspecialchars( $dadosTotaisSindicatos["total_EmAndamento"], ENT_COMPAT, 'UTF-8', FALSE ); ?></b></td>
              <td><b><?php echo htmlspecialchars( $dadosTotaisSindicatos["total_associacao_em_negociacao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></b></td>
              <td><b><?php echo htmlspecialchars( $dadosTotaisSindicatos["total_associacaoEfetivada"], ENT_COMPAT, 'UTF-8', FALSE ); ?></b></td>
              <td><b><?php echo htmlspecialchars( $dadosTotaisSindicatos["total_total_visitas"], ENT_COMPAT, 'UTF-8', FALSE ); ?></b></td>
            </tr> 

          </tbody>
        </table>

       <table class="table text-center table-striped table-hover">
        <thead>
          <th style="width: 15px">Casa</th>
          <th style="width: 25px">Nº de Emp. Selecionadas</th>
          <th style="width: 25px">Visitas Realizadas</th>
          <th style="width: 25px">Agendadas</th>
          <th style="width: 15px">Negociações</th>
          <th style="width: 15px">Negociações em Andamento</th>
          <th style="width: 15px">Total Visitas</th>
        </thead>
        <tbody>

          <?php $counter1=-1;  if( isset($dadosCasa) && ( is_array($dadosCasa) || $dadosCasa instanceof Traversable ) && sizeof($dadosCasa) ) foreach( $dadosCasa as $key1 => $value1 ){ $counter1++; ?>

           <tr>
              <td class="text-danger"><b><?php echo htmlspecialchars( $value1["nome_casa"], ENT_COMPAT, 'UTF-8', FALSE ); ?></b></td>
              <td><?php echo htmlspecialchars( $value1["empresas_selecionadas"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
              <td><?php echo htmlspecialchars( $value1["visitas_realizadas"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
              <td><?php echo htmlspecialchars( $value1["visitas_agendadas"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
              <td><?php echo htmlspecialchars( $value1["negociadas"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
              <td><?php echo htmlspecialchars( $value1["negociacoes_em_andamento"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
              <td><?php echo htmlspecialchars( $value1["totalVisitas"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
            </tr>
          <?php } ?>


            <tr style="background-color: #dddddd;">
              <td><b>TOTAL</b></td>
              <td><b><?php echo htmlspecialchars( $dadosTotaisCasas["total_empresas_selecionadas"], ENT_COMPAT, 'UTF-8', FALSE ); ?></b></td>
              <td><b><?php echo htmlspecialchars( $dadosTotaisCasas["total_visitas_realizadas"], ENT_COMPAT, 'UTF-8', FALSE ); ?></b></td>
              <td><b><?php echo htmlspecialchars( $dadosTotaisCasas["total_visitas_agendadas"], ENT_COMPAT, 'UTF-8', FALSE ); ?></b></td>
              <td><b><?php echo htmlspecialchars( $dadosTotaisCasas["total_negociadas"], ENT_COMPAT, 'UTF-8', FALSE ); ?></b></td>
              <td><b><?php echo htmlspecialchars( $dadosTotaisCasas["total_negociacao_em_andamento"], ENT_COMPAT, 'UTF-8', FALSE ); ?></b></td>
              <td><b><?php echo htmlspecialchars( $dadosTotaisCasas["total_total_visitas"], ENT_COMPAT, 'UTF-8', FALSE ); ?></b></td>
            </tr>
        </tbody>
      </table>

   </div>
    
    <div class="col-md-2">
     <table class="text-center">
       <thead>
         <th>       
          <tr><td class="text-primary"><b>Meta de visitas: <span class="text-success"><?php echo htmlspecialchars( $ciclo["industrias_visitadas"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span></b></td></tr>
        <tr>
      <!--   <tr><td class="text-primary"><b>Indústrias: <span class="text-success"><?php echo htmlspecialchars( $somaTotal["soma_empresas_selecionadas"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span></b></td></tr> -->
        <tr>
          <td>
                <div class="progress progress">
                  <div class="progress-bar progress-bar-green" style="width: <?php echo htmlspecialchars( $metas["distinct_visitadas"]*100/($ciclo["industrias_visitadas"]), ENT_COMPAT, 'UTF-8', FALSE ); ?>%; color:black;"><?php echo htmlspecialchars( $metas["distinct_visitadas"]*100/($ciclo["industrias_visitadas"]), ENT_COMPAT, 'UTF-8', FALSE ); ?>%</div>
                  <!-- <div class="progress-bar progress-bar-red" style="width: 40%">2</div> -->
              </div>
          </td>
          <!-- <td><span class="badge bg-light-blue">13/270</span></td> -->
        </tr></th>
       </thead>
       <tbody>
        <tr><td class="text-primary"><b>Indústrias visitadas</b></td></tr>
        <tr><td><span class="badge bg-light-blue"><?php echo htmlspecialchars( $metas["percentual_visitadas"], ENT_COMPAT, 'UTF-8', FALSE ); ?>%</span> <b><span class="text-success"><?php echo htmlspecialchars( $metas["distinct_visitadas"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/<?php echo htmlspecialchars( $somaTotal["soma_empresas_selecionadas"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span></b></td></tr>
        
        <tr><td class="text-primary"><b>Associações </b></td></tr>
        <tr><td><span class="badge bg-light-blue"><?php echo htmlspecialchars( $metas["percentual_associacoes"], ENT_COMPAT, 'UTF-8', FALSE ); ?>%</span> 
          <b><span class="text-success"><?php echo htmlspecialchars( $ciclo["novas_associacoes"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span></b></td></tr>
        
        <tr><td class="text-primary"><b>Propostas Demandadas</b></td></tr>
        <tr><td><span class="badge bg-light-blue"><?php echo htmlspecialchars( $metas["percentual_propostas_demandadas"], ENT_COMPAT, 'UTF-8', FALSE ); ?>%</span> <span class="text-success"><b><?php echo htmlspecialchars( $ciclo["propostas_demandadas"], ENT_COMPAT, 'UTF-8', FALSE ); ?></b></span></td></tr>

         <tr><td class="text-primary"><b>Interesse em Associar-se</b></td></tr>
        <tr><td><span class="badge bg-light-blue"><?php echo htmlspecialchars( $metas["percentual_interesse_em_assoc"], ENT_COMPAT, 'UTF-8', FALSE ); ?>%</span> <span class="text-success"><b><?php echo htmlspecialchars( $ciclo["interesse_em_assoc"], ENT_COMPAT, 'UTF-8', FALSE ); ?></b></span></td></tr>

<!--          <tr><td class="text-primary"><b>Receita</b></td></tr>
        <tr><td><span class="badge bg-light-blue">-</span></td></tr> -->

       </tbody>
     </table>

          <table class="text-center">
       <thead>
         <th> &nbsp </th>
       </thead>
       <tbody>
        <tr><td class="text-success"><b>Nº de Empresas</b></td></tr>
        <tr><td><span class="badge bg-green"><?php echo htmlspecialchars( $somaTotal["soma_empresas_selecionadas"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span></td></tr>
        
        <tr><td class="text-success"><b>Visitas Realizadas</b></td></tr>
        <tr><td><span class="badge bg-green"><?php echo htmlspecialchars( $somaTotal["soma_visitas_realizadas"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span></td></tr>
        
        <tr><td class="text-success"><b>Visitas Agendadas</b></td></tr>
        <tr><td><span class="badge bg-green"><?php echo htmlspecialchars( $somaTotal["soma_visitas_agendadas"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span></td></tr>

         <tr><td class="text-success"><b>Negociações</b></td></tr>
        <tr><td><span class="badge bg-green"><?php echo htmlspecialchars( $somaTotal["negociadas"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span></td></tr>

         <tr><td class="text-success"><b>Negociações em Andamento</b></td></tr>
         <tr><td><span class="badge bg-green"><?php echo htmlspecialchars( $somaTotal["negociacoes_em_andamento"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span></td></tr>

         <tr><td class="text-success"><b>Associação em Negociação</b></td></tr>
         <tr><td><span class="badge bg-green"><?php echo htmlspecialchars( $somaTotal["associacao_em_negociacao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span></td></tr>

         <tr><td class="text-success"><b>Novas Associações</b></td></tr>
        <tr><td><span class="badge bg-green"><?php echo htmlspecialchars( $somaTotal["associacaoEfetivada"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span></td></tr>

       </tbody>
     </table>




   </div>

</div> <!-- FIM ROW -->
 
<div class="row">
  

  <div class="col-md-6">
    <table class="table">
      <thead>
        <th colspan="3" class="text-center">Agendamentos</th>
      <!--   <th>Visitadas</th>
        <th>Empresas</th> -->
      </thead>
      
      <tbody>
        <tr>
          <td>
            <span class="badge bg-green"><?php echo htmlspecialchars( $dadosCasa["0"]["nome_casa"], ENT_COMPAT, 'UTF-8', FALSE ); ?>: <?php echo htmlspecialchars( $dadosCasa["0"]["visitas_agendadas"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
            <span class="badge bg-blue"><?php echo htmlspecialchars( $dadosCasa["1"]["nome_casa"], ENT_COMPAT, 'UTF-8', FALSE ); ?>: <?php echo htmlspecialchars( $dadosCasa["1"]["visitas_agendadas"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
            <span class="badge bg-red"><?php echo htmlspecialchars( $dadosCasa["2"]["nome_casa"], ENT_COMPAT, 'UTF-8', FALSE ); ?>: <?php echo htmlspecialchars( $dadosCasa["2"]["visitas_agendadas"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
            <span class="badge bg-yellow"><?php echo htmlspecialchars( $dadosCasa["3"]["nome_casa"], ENT_COMPAT, 'UTF-8', FALSE ); ?>: <?php echo htmlspecialchars( $dadosCasa["3"]["visitas_agendadas"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
            <span class="badge bg-light">Total: <?php echo htmlspecialchars( $dadosTotaisCasas["total_visitas_agendadas"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
          </td>
        </tr>
        <tr>
        <td colspan="3">
          <div class="progress progress">
          <?php if( $dadosTotaisCasas["total_visitas_agendadas"]>0 ){ ?>

              <div class="progress-bar progress-bar-green" style="width:<?php echo htmlspecialchars( $dadosCasa["0"]["visitas_agendadas"]*100/($dadosTotaisCasas["total_visitas_agendadas"]), ENT_COMPAT, 'UTF-8', FALSE ); ?>%">
              </div>

              <div class="progress-bar progress-bar-blue" style="width:<?php echo htmlspecialchars( $dadosCasa["1"]["visitas_agendadas"]*100/($dadosTotaisCasas["total_visitas_agendadas"]), ENT_COMPAT, 'UTF-8', FALSE ); ?>%">
              </div>

              <div class="progress-bar progress-bar-red" style="width:<?php echo htmlspecialchars( $dadosCasa["2"]["visitas_agendadas"]*100/($dadosTotaisCasas["total_visitas_agendadas"]), ENT_COMPAT, 'UTF-8', FALSE ); ?>%">
              </div>

              <div class="progress-bar progress-bar-yellow" style="width:<?php echo htmlspecialchars( $dadosCasa["3"]["visitas_agendadas"]*100/($dadosTotaisCasas["total_visitas_agendadas"]), ENT_COMPAT, 'UTF-8', FALSE ); ?>%">
              </div>
              <?php }else{ ?>

              <div class="progress-bar progress-bar-green" style="width:1%">
              </div>
              <?php } ?>



                    

              </div>
          </td>
        </tr>

      </tbody>
    
    </table>
  </div>

    <div class="col-md-6">
    <table class="table">
      <thead>
        <th colspan="3" class="text-center">Associações</th>
      <!--   <th>Visitadas</th>
        <th>Empresas</th> -->
      </thead>
      
      <tbody>
        <tr>
          <td>
            <span class="badge bg-blue">Associações: <?php echo htmlspecialchars( $somaTotal["associacaoEfetivada"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
            <!-- <span class="badge bg-red">Não Associadas 12</span> -->
            <span class="badge bg-green">Em Negociação: <?php echo htmlspecialchars( $somaTotal["associacao_em_negociacao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
            <span class="badge bg-dark">Total: <?php echo htmlspecialchars( $somaTotal["associacao_em_negociacao"]+$somaTotal["associacaoEfetivada"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
          </td>
        </tr>
        <tr>
          <td colspan="3">
             <div class="progress progress">
              <?php if( $somaTotal["associacaoEfetivada"]+$somaTotal["associacao_em_negociacao"]>0 ){ ?>

              <div class="progress-bar progress-bar-blue" style="width:
              <?php echo htmlspecialchars( $somaTotal["associacaoEfetivada"]*100/($somaTotal["associacaoEfetivada"]+$somaTotal["associacao_em_negociacao"]), ENT_COMPAT, 'UTF-8', FALSE ); ?>%">
              </div>
              <div class="progress-bar progress-bar-green" style="width:
              <?php echo htmlspecialchars( $somaTotal["associacao_em_negociacao"]*100/($somaTotal["associacaoEfetivada"]+$somaTotal["associacao_em_negociacao"]), ENT_COMPAT, 'UTF-8', FALSE ); ?>%">
              </div>  
                      
                      
                      <?php }else{ ?>

                        <div class="progress-bar progress-bar-blue" style="width:0%">
                        </div> 

                      <?php } ?>


              </div>
          </td>
        </tr>

      </tbody>
    
    </table>
  </div>

</div> <!-- ROW -->




<div class="row">
  
  <div class="col-md-6">
    <table class="table text-center">
      <thead>
        <tr class="bg-primary"><th colspan="3">Empresas por Região</th></tr>
        <th style="background-color: #dddddd;">Região</th>
        <th style="background-color: #dddddd;">Visitadas</th>
        <th style="background-color: #dddddd;">Empresas</th>
      </thead>
      
      <tbody>
        <?php $counter1=-1;  if( isset($dadosRegioes) && ( is_array($dadosRegioes) || $dadosRegioes instanceof Traversable ) && sizeof($dadosRegioes) ) foreach( $dadosRegioes as $key1 => $value1 ){ $counter1++; ?>

        <tr>
          <td class="text-success"><b><?php echo htmlspecialchars( $value1["regiao_estado"], ENT_COMPAT, 'UTF-8', FALSE ); ?></b></td>
          <td><?php echo htmlspecialchars( $value1["empresas_visitadas"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
          <td><?php echo htmlspecialchars( $value1["empresas_totais"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
        </tr>
        <?php } ?>


      </tbody>
    
    </table>
  </div>

  <div class="col-md-6">
    <table class="table text-center">
      <thead>
        <tr class="bg-primary"><th colspan="3">RECEITA</th></tr>
        <th style="background-color: #dddddd;">Entidades</th>
        <th style="background-color: #dddddd;">Receita</th>
        <th style="background-color: #dddddd;">Produto</th>
      </thead>
      
      <tbody>

        <?php $counter1=-1;  if( isset($dadosReceita) && ( is_array($dadosReceita) || $dadosReceita instanceof Traversable ) && sizeof($dadosReceita) ) foreach( $dadosReceita as $key1 => $value1 ){ $counter1++; ?>


        <tr>
          <td style="color:#001F3F"><b><?php echo htmlspecialchars( $value1["nome_casa"], ENT_COMPAT, 'UTF-8', FALSE ); ?></b></td>
          <td>R$ <?php echo number_format($value1["total"],2,',','&#46;'); ?></td>
          <td> </td>
        </tr>

        <?php } ?>

<!--         <tr>
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
        </tr> -->
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





