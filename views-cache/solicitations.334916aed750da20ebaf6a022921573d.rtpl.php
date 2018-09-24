<?php if(!class_exists('Rain\Tpl')){exit;}?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">

  <h1>
     <small><b>CLIQUE SOBRE O USUÁRIO PARA OBTER INFORMAÇÕES MAIS DETALHADAS</b></small>
  </h1>
  
  <ol class="breadcrumb">
     <button class="btn btn-xs"><li><a href="/user"><i class="fa fa-home"></i> Início</a></li></button>
     <button class="btn btn-xs"><li class="active"><a href="/user/solicitations">Solicitações</a></li></button>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
            
            <div class="box-header">
              <!--<a href="#" class="btn btn-success btn-block"> --><h4 class="text-primary"><center><b>SOLICITAÇÕES PENDENTES</b></center></h4> <!--</a>-->
            <hr></div>

            <div class="box-body no-padding">
              <table class="table table-striped table-bordered text-center table-responsive table-hover">
                <thead>
                  <tr>
                    <th style="width: 100px">Nome</th>   
                    <th style="width: 85px">Cargo</th>
                    <th style="width: 85px">Origem</th>
                   <!-- <th>E-mail</th>-->
                    <th style="width: 120px" class="md2-some">Email</th>
                    <th style="width: 140px">&nbsp;</th>
                  </tr>
                </thead>
                <tbody>

                

                  <?php $counter1=-1;  if( isset($solicitations) && ( is_array($solicitations) || $solicitations instanceof Traversable ) && sizeof($solicitations) ) foreach( $solicitations as $key1 => $value1 ){ $counter1++; ?>
                  <a href="http://www.google.com">
                  <tr>
                    
                    <td><?php echo htmlspecialchars( $value1["nome_func"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td><?php echo htmlspecialchars( $value1["cargo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td><?php echo htmlspecialchars( $value1["origem"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td class="md2-some"><?php echo htmlspecialchars( $value1["email_func"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                  


                    <td>
                      <a href="/user/solicitations-info/<?php echo htmlspecialchars( $value1["idCadastro"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-info btn-xs"><i class="fa fa-info"></i> <b>Info</b></a>
                      <a href="/user/solicitations/<?php echo htmlspecialchars( $value1["idCadastro"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/aprove" class="btn btn-success btn-xs"><i class="fa fa-check"></i> <b>Aprovar</b></a>
                      <a href="/user/solicitations/<?php echo htmlspecialchars( $value1["idCadastro"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/recuse" onclick="return confirm('Deseja realmente recusar a solicitação desse usuário?')" class="btn btn-danger btn-xs"><i class="fa fa-close"></i> <b>Recusar</b></a>
                    </td>
                  </tr>
                 </a>
                  <?php } ?>

                
              <!--
                   <tr>
                    <td>Vinicius dos Santos Lima</td>
                    <td>Executivo</td>
                    <td>FIEB</td>
                    <td>vini@gmail.com</td>
                    <td>
                      <a href="#" class="btn btn-success btn-xs"><i class="fa fa-check"></i> <b>Aprovar</b></a>
                      <a href="#" onclick="return confirm('Deseja realmente recusar a solicitação desse usuário?')" class="btn btn-danger btn-xs"><i class="fa fa-close"></i> <b>Recusar</b></a>
                    </td>
                  </tr> 

                 <tr>
                    <td>João dos Santos Lima</td>
                    <td>Gerente</td>
                    <td>FIEB</td>
                    <td>joaodoteste@gmail.com</td>
                    <td>
                      <a href="#" class="btn btn-success btn-xs"><i class="fa fa-check"></i> <b>Aprovar</b></a>
                      <a href="#" onclick="return confirm('Deseja realmente recusar a solicitação desse usuário?')" class="btn btn-danger btn-xs"><i class="fa fa-close"></i> <b>Recusar</b></a>
                    </td>
                  </tr> 



    -->

           


                </tbody>
              </table>
            </div>
             <?php if( !$solicitations ){ ?><center><h3 class="text-success">Nenhuma Solicitação Disponível</h3> </center><br><?php } ?>
            <!-- /.box-body -->
          </div>
    </div>
  </div>

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
