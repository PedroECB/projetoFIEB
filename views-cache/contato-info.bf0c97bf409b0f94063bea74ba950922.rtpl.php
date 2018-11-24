<?php if(!class_exists('Rain\Tpl')){exit;}?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <small><b>INFORMAÇÕES DO CONTATO</b></small>
  </h1>
  <ol class="breadcrumb">
    <button class="btn btn-xs"><li><a href="/user2"><i class="fa fa-home"></i> Início</a></li></button>
    <button class="btn btn-xs"><li><a href="/admin/contatos">Contatos</a></li></button>
    
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">

        <div class="col-md-12">  
          <center>
            <h3 class="box-title text-primary" style="vertical-align: middle;"><b>DETALHES DO CONTATO</b></h3>
            <a href="javascript:history.back();"><button class="btn btn-link navbar-right"><b>Voltar</b></button></a>
          </center>
        </div>

        </div>
        <!-- /.box-header -->
        <!-- form start -->
        
          <div class="box-body">





            <div class="box-body"> 

                  <center>
                    <table class="table table-responsive table-hover table-info-empresa" style="">
                    <thead>
                      <tr>
                        
                      </tr>
                    </thead>
                    <tbody>
                
                      <tr> <td><b>Nome do contato</b></td> <td><?php echo htmlspecialchars( $dadosContato["nome"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td> </tr>
                      <tr> <td><b>Entidade</b></td> <td><?php echo htmlspecialchars( $dadosContato["entidade"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td> </tr>
                      <tr> <td><b>Email</b></td> <td><?php echo htmlspecialchars( $dadosContato["email"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td> </tr>
                      <tr> <td><b>Telefone</b></td> <td><?php echo htmlspecialchars( $dadosContato["telefone"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td> </tr>
                      <tr> <td><b>Telefone alternativo</b></td> <td><?php echo htmlspecialchars( $dadosContato["telefone2"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td> </tr>
                      <tr> <td><b>Observação</b></td> <td><?php echo htmlspecialchars( $dadosContato["observacao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td> </tr>

                    </tbody>
                  </table>
                </center>


            </div>

        

            

       





          <!-- /.box-body -->
          <div class="box-footer">
           <div class="col-md-12"> 
          
          <button type="" class="btn btn-default btn-sm navbar-right" onclick="javascript:history.back();"><b>VOLTAR</b></button>


          </div>
          </div>
        
      </div>
    </div>
  </div>

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->




