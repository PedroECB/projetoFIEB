<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Lista de Usuários
  </h1>
  <ol class="breadcrumb">
    <li><a href="/admin"><i class="fa fa-home"></i> Início</a></li>
    <li class="active"><a href="/admin/users">Usuários</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <div class="row">
  	<div class="col-md-12">
  		<div class="box box-primary">
            
            <div class="box-header">
              <a href="/admin/users/create" class="btn btn-primary"><b>CADASTRAR USUÁRIO</b></a>
            </div>

            <div class="box-body no-padding">
              <table class="table table-striped table-bordered text-center table-responsive table-hover">
                <thead>
                  <tr>
                   <!-- <th style="width: 120px">RG</th>-->
                    <th style="width: 100px">Nome</th>   
                    <th style="width: 85px">Cargo</th>
                    <th style="width: 85px" class="md2-some">Origem</th>
                   <!-- <th>E-mail</th>-->
                    <th style="width: 120px">Nível de acesso</th>
                    <th style="width: 40px">&nbsp;</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $counter1=-1;  if( isset($users) && ( is_array($users) || $users instanceof Traversable ) && sizeof($users) ) foreach( $users as $key1 => $value1 ){ $counter1++; ?>
                  
                  <a href="#" class=""><tr>
                   <!-- <td><?php echo htmlspecialchars( $value1["rg_func"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>-->
                    <td><?php echo htmlspecialchars( $value1["nome_func"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td class="md2-some"><?php echo htmlspecialchars( $value1["cargo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td><?php echo htmlspecialchars( $value1["origem"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td/>
                  
                    <td><?php if( $value1["nivel_acesso"] == 1 ){ ?><span class="text-success">Administrador</span><?php } ?>
                        <?php if( $value1["nivel_acesso"] == 2 ){ ?><span class="text-primary">Ponto Focal</span><?php } ?>
                        <?php if( $value1["nivel_acesso"] == 3 ){ ?>Comum<?php } ?>

                      </td>

                    <td>
                      <a href="/admin/users/<?php echo htmlspecialchars( $value1["idFuncionario"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-info btn-xs"><i class="fa fa-info"></i> <b>Info</b></a>
                      <a href="/admin/users/<?php echo htmlspecialchars( $value1["idFuncionario"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/delete" onclick="return confirm('Deseja realmente excluir este usuário?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> <b>Excluir</b></a>
                    </td>
                  
                  </tr>
                  </a>
                
                 
                  <?php } ?>
                 <!--  <tr>
                    <td>1431692387</td>
                    <td>Vinicius dos Santos Lima</td>
                    <td>Executivo</td>
                    <td>FIEB</td>
                    <td>Administrador</td>
                    <td>
                      <a href="/admin/users/" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Editar</a>
                      <a href="/admin/users//delete" onclick="return confirm('Deseja realmente excluir este usuário?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Excluir</a>
                    </td>
                  </tr> -->
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
  	</div>
  </div>

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
