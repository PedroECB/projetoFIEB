<?php if(!class_exists('Rain\Tpl')){exit;}?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">

  <h1>
     <small>CLIQUE NO BOTÃO DE INFORMAÇÕES PARA OBTER MAIS DETALHES SOBRE O USUÁRIO</small>
  </h1>
  
  <ol class="breadcrumb">
    <li><a href="/admin"><i class="fa fa-home"></i> Início</a></li>
    <li class="active"><a href="/admin/users">Usuários</a></li>
    <li class="active"><a href="/admin/solicitations">Solicitações</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
            
            <div class="box-header">
              <!--<a href="#" class="btn btn-success btn-block"> --><h4 class="text-primary"><center><b>SOLICITAÇÕES PENDENTES</b></center></h4> <!--</a>-->
            </div>

            <div class="box-body no-padding">
              <table class="table table-striped table-bordered text-center table-responsive table-hover">
                <thead>
                  <tr>
                   <!-- <th style="width: 120px">RG</th>-->
                    <th style="width: 100px">Nome</th>   
                    <th style="width: 85px">Cargo</th>
                    <th style="width: 85px">Origem</th>
                   <!-- <th>E-mail</th>-->
                    <th style="width: 120px">Email</th>
                    <th style="width: 140px">&nbsp;</th>
                  </tr>
                </thead>
                <tbody>

                

                  <?php $counter1=-1;  if( isset($solicitations) && ( is_array($solicitations) || $solicitations instanceof Traversable ) && sizeof($solicitations) ) foreach( $solicitations as $key1 => $value1 ){ $counter1++; ?>
                  <tr>
                    
                    <td><?php echo htmlspecialchars( $value1["nome_func"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td><?php echo htmlspecialchars( $value1["cargo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td><?php echo htmlspecialchars( $value1["origem"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td/>
                    <td><?php echo htmlspecialchars( $value1["email_func"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td/>
                  


                    <td>
                      <a href="/admin/solicitations-info/<?php echo htmlspecialchars( $value1["idCadastro"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-info btn-xs"><i class="fa fa-info"></i> <b>Info</b></a>
                      <a href="/admin/solicitations/<?php echo htmlspecialchars( $value1["idCadastro"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/aprove" class="btn btn-success btn-xs"><i class="fa fa-check"></i> <b>Aprovar</b></a>
                      <a href="/admin/solicitations/<?php echo htmlspecialchars( $value1["idCadastro"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/recuse" onclick="return confirm('Deseja realmente recusar a solicitação desse usuário?')" class="btn btn-danger btn-xs"><i class="fa fa-close"></i> <b>Recusar</b></a>
                    </td>
                  </tr>
                 
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
             <?php if( !$solicitations ){ ?><center><h3 class="text-primary">Nenhuma Solicitação Disponível</h3> </center><br><?php } ?>
            <!-- /.box-body -->
          </div>
    </div>
  </div>

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
