<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
 <!--  <h1>
    <small><b>CONTATOS</b></small>
  </h1> -->
 <a href="/user2/contatos-create"><button class="btn btn-primary btn-sm" type="button"><b>NOVO CONTATO</b></button></a>
  <ol class="breadcrumb">
    <button class="btn btn-xs"><li><a href="/user2"><i class="fa fa-home"></i> Início</a></li></button>
    <button class="btn btn-xs"><li class="active"><a href="/user2/contatos"><i class="fa fa-fax"></i> Contatos</a></li></button>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <div class="row">
  	<div class="col-md-12">
  		<div class="box box-primary">
            
            <div class="box-header">
             
                <h4 class="text-primary text-center"><b>CONTATOS</b></h4>
           
            </div>


            <div class="box-body no-padding">
              <table class="table table-striped table-bordered text-center table-responsive table-hover">
                <thead>
                  <tr>
                    <th style="width: 40px">Nome</th>   
                    <th style="width: 30px" class="md2-some">Entidade</th>
                    <th style="width: 40px" class="orig">Telefone</th>
                    <th style="width: 40px" class="orig">Celular</th>
                    <th style="width: 60px" class="nv">Email</th>
                    <th style="width: 30px">&nbsp;</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- <tr>
                    <td>Paulo Carneiro</td>
                    <td class="md2-some">SESI</td>
                    <td class="orig">71 3393-6678</td>
                    <td>paulodosesi@sesi.com</td>
                    <td>
                      <button class="btn btn-default btn-xs" title="Visualizar"><i class="fa fa-eye"></i></button>
                      <button class="btn btn-danger btn-xs" title="Remover"><i class="fa fa-close"></i></button>
                    </td>
                  </tr> -->


                  <?php $counter1=-1;  if( isset($contatos) && ( is_array($contatos) || $contatos instanceof Traversable ) && sizeof($contatos) ) foreach( $contatos as $key1 => $value1 ){ $counter1++; ?>
                    <tr>
                      <td><?php echo htmlspecialchars( $value1["nome"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                      <td class="md2-some"><?php echo htmlspecialchars( $value1["entidade"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                      <td class="orig"><?php echo htmlspecialchars( $value1["telefone"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                      <td class="orig"><?php echo htmlspecialchars( $value1["telefone2"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                      <td><?php echo htmlspecialchars( $value1["email"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                      <td>
                        <a href="/<?php echo htmlspecialchars( $value1["id_contatos"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/user2/contatos"><button class="btn btn-default btn-xs" title="Visualizar"><i class="fa fa-eye"></i></button></a>
                        
                        <?php if( $value1["id_funcionario"] == $session["idFuncionario"] ){ ?>
                             <a href="/user2/contatos/<?php echo htmlspecialchars( $value1["id_contatos"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/remove"><button class="btn btn-danger btn-xs" title="Remover"><i class="fa fa-close"></i></button></a> 
                        <?php } ?>
                      </td>
                    </tr>
                  <?php } ?>

                      <tr><td colspan="5">&nbsp</td></tr>
                  
                   <?php $counter1=-1;  if( isset($contatos2) && ( is_array($contatos2) || $contatos2 instanceof Traversable ) && sizeof($contatos2) ) foreach( $contatos2 as $key1 => $value1 ){ $counter1++; ?>
                    <tr>
                      <td><?php echo htmlspecialchars( $value1["nome_func"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                      <td class="md2-some"><?php echo htmlspecialchars( $value1["origem"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                      <td class="orig"><?php echo htmlspecialchars( $value1["telefone"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                      <td class="orig"><?php echo htmlspecialchars( $value1["telefone2"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                      <td><?php echo htmlspecialchars( $value1["email"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                      <td>

                      </td>
                    </tr>
                  <?php } ?>

 
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->

             <!-- <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
                <?php $counter1=-1;  if( isset($pages) && ( is_array($pages) || $pages instanceof Traversable ) && sizeof($pages) ) foreach( $pages as $key1 => $value1 ){ $counter1++; ?>
                <li><a href="<?php echo htmlspecialchars( $value1["href"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["text"], ENT_COMPAT, 'UTF-8', FALSE ); ?></a></li>
                <?php } ?>
              </ul>
            </div> -->



          </div>
  	</div>
  </div>

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
