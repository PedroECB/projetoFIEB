<?php if(!class_exists('Rain\Tpl')){exit;}?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <small><b>CADASTRO DE EMPRESA PARA VISITAS</b></small>
  </h1>
  <ol class="breadcrumb">
    <button class="btn btn-xs"><li><a href="/user2"><i class="fa fa-home"></i> Início</a></li></button>
    <button class="btn btn-xs"><li><a href="/user2/empresa-create">Cadastrar Empresa</a></li></button>
    
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
            <h3 class="box-title" style="vertical-align: middle;"><b>CADASTRO DE EMPRESA</b></h3>
            <a href="javascript:history.back();"><button class="btn btn-link navbar-right"><b>Voltar</b></button></a>
          </center>
          <?php if( isset($error["error"]) ){ ?><br>
          <div class="alert alert-danger" role="alert">
            <center><b><?php echo htmlspecialchars( $error["error"], ENT_COMPAT, 'UTF-8', FALSE ); ?></b></center>
          </div>

          <?php } ?>


        </div>

        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="/user2/empresa-create" method="post" id="formEmpresa">
          <div class="box-body">

          <div class="form-group">
              <label for="campoCNPJ">CNPJ: *</label>
              <input type="tel" class="form-control" id="campoCNPJ" name="cnpj" placeholder="Digite apenas números" value="<?php if( isset($dados["cnpj"]) ){ ?><?php echo htmlspecialchars( $dados["cnpj"], ENT_COMPAT, 'UTF-8', FALSE ); ?><?php } ?>" onkeyup="formatCNPJ();"  maxlength="15" required>
            </div>




            <div class="form-group">
              <label for="campoRazaoSocial">Razão Social: *</label> 
              <input type="text" class="form-control" id="campoRazaoSocial" name="razaoSocial" placeholder=""  value="<?php if( isset($dados["razaoSocial"]) ){ ?><?php echo htmlspecialchars( $dados["razaoSocial"], ENT_COMPAT, 'UTF-8', FALSE ); ?><?php } ?>" onkeypress="formatRazaoSocial();" maxlength="50" required>
            </div>

            <div class="form-group">
              <label for="campoNomeFantasia" >Nome Fantasia: *</label>
              <input type="text" class="form-control" id="campoNomeFantasia" name="nomeFantasia" placeholder="" onkeypress="formatNomeFantasia();" required value="<?php if( isset($dados["nomeFantasia"]) ){ ?><?php echo htmlspecialchars( $dados["nomeFantasia"], ENT_COMPAT, 'UTF-8', FALSE ); ?><?php } ?>">
            </div>

            <div class="form-group">
              <label for="campoSitAssoc" >Situação da Associação: *</label>
              <select name="sitAssoc" class="form-control" onchange="verificaAssoc();verificaPoss();">
                <?php if( isset($dados["sitAssoc"]) ){ ?><option value="<?php echo htmlspecialchars( $dados["sitAssoc"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" selected><?php echo htmlspecialchars( $dados["sitAssoc"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option><?php } ?>

                <option value="Não Associada">Não Associada</option>
                <option value="Associada">Associada</option>
                <option value="Associação em Negociação">Associação em Negociação</option>

              </select>
            </div>



         <div class="row">
           <div class="col-md-6">
             <label for="campoAssoc" >Sindicato: </label>
              <select name="Assoc" class="form-control" id="Assoc" disabled>
                <?php if( isset($dados["Assoc"]) ){ ?><option value="<?php echo htmlspecialchars( $dados["Assoc"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" selected><?php echo htmlspecialchars( $dados["Assoc"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option><?php } ?>

                <option value="Não Associada">Não Associada</option>
                

                <optgroup label="SINDICATO">
                 <?php $counter1=-1;  if( isset($sindicatos) && ( is_array($sindicatos) || $sindicatos instanceof Traversable ) && sizeof($sindicatos) ) foreach( $sindicatos as $key1 => $value1 ){ $counter1++; ?> 
                  <option value="<?php echo htmlspecialchars( $value1["idSindicato"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["nome_sindicato"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                  <?php } ?> 

                <!--  <option value="SINDVEST">SINDVEST</option>
                  <option value="SINDPROCIM">SINDPROCIM</option>
                  <option value="SINDTESTE">SINDTESTE</option>
                -->

                </optgroup>
                
                
              </select>
           </div>


           <div class="col-md-6">
              <label for="posAssoc" >Possibilidade de associação: </label>
              <select name="posAssoc" class="form-control" id="posAssoc" required="">
                <?php if( isset($dados["possAssoc"]) ){ ?><option value="<?php echo htmlspecialchars( $dados["possAssoc"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" selected><?php echo htmlspecialchars( $dados["possAssoc"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option><?php } ?>

                <option value="Selecione uma opção">Selecione uma opção</option>
                

                <optgroup label="SINDICATO">
                 <?php $counter1=-1;  if( isset($sindicatos) && ( is_array($sindicatos) || $sindicatos instanceof Traversable ) && sizeof($sindicatos) ) foreach( $sindicatos as $key1 => $value1 ){ $counter1++; ?> 
                  <option value="<?php echo htmlspecialchars( $value1["nome_sindicato"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["nome_sindicato"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                  <?php } ?> 

                <!--  <option value="SINDVEST">SINDVEST</option>
                  <option value="SINDPROCIM">SINDPROCIM</option>
                  <option value="SINDTESTE">SINDTESTE</option>
                -->

                </optgroup>
                
                
              </select>
           </div>
         </div>  <!-- Row--> 




            <div class="form-group">
              
              
              
            </div>




  <div class="row">

    <div class="col-md-6">
            <div class="form-group">
                 <label for="campoCidade" >Cidade/Município: *</label>
                     <select name="campoCidade" id="campoCidade" onchange="validaCidade();" class="form-control">
                            <?php if( isset($dados["campoCidade"]) ){ ?><option value="<?php echo htmlspecialchars( $dados["campoCidade"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $dados["campoCidade"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option><?php } ?>

                            <option value="">Selecione a cidade</option>
                            <option value="Abaíra">Abaíra</option>
                            <option value="Abaré">Abaré</option>
                            <option value="Feira de Santana">Feira de Santana</option>
                            <option value="Paulo Afonso">Paulo Afonso</option>  
                            <?php $counter1=-1;  if( isset($cidades) && ( is_array($cidades) || $cidades instanceof Traversable ) && sizeof($cidades) ) foreach( $cidades as $key1 => $value1 ){ $counter1++; ?>

                              <option value="<?php echo htmlspecialchars( $value1["cidade"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["cidade"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option> 
                            <?php } ?>      
                      </select>
              </div>

      </div>

      <div class="col-md-6">

          <div class="form-group">
              <label for="campoRegiao">Região:</label>
              <input type="text" class="form-control" id="campoRegiao" name="CampoRegiao" placeholder="" readonly="" required value="<?php if( isset($dados["CampoRegiao"]) ){ ?><?php echo htmlspecialchars( $dados["CampoRegiao"], ENT_COMPAT, 'UTF-8', FALSE ); ?><?php } ?>">
            </div>
      </div>

  </div>







        
          <div class="form-group">
              <label for="campoBairro">Bairro:</label>
              <input type="text" class="form-control" id="campoBairro" name="campoBairro" placeholder="Nome do bairro" maxlength="28" onkeypress="formatBairro();" value="<?php if( isset($dados["campoBairro"]) ){ ?><?php echo htmlspecialchars( $dados["campoBairro"], ENT_COMPAT, 'UTF-8', FALSE ); ?><?php } ?>">
            </div>


            <div class="form-group">
              <label for="campoEndereco">Endereço: </label>
              <input type="text" class="form-control" id="campoEndereco" name="campoEndereco" placeholder="Ex: Rua Américo de Oliveira, N47"
               value="<?php if( isset($dados["campoEndereco"]) ){ ?><?php echo htmlspecialchars( $dados["campoEndereco"], ENT_COMPAT, 'UTF-8', FALSE ); ?><?php } ?>" maxlength="80" onkeypress="formatEndereco();">
            </div>



              <div class="form-group">
              <label for="campoEmail">E-mail de Contato: </label>
            <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-at"></i>
                </div> 
                  <input type="email" class="form-control" id="campoEmail" name="email" placeholder="empresa@dominio.com" maxlength="50" value="<?php if( isset($dados["email"]) ){ ?><?php echo htmlspecialchars( $dados["email"], ENT_COMPAT, 'UTF-8', FALSE ); ?><?php } ?>">
            </div>  
        </div>


<div class="row">

      <div class="col-md-6">
             <div class="form-group">
                <label for="campoTelefone">Telefone:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-phone"></i>
                  </div>
                  <input type="tel" id="campoTelefone" class="form-control" placeholder="(71) 3333-2222" name="campoTelefone" onkeyup="validaTelefone();" maxlength="14" value="<?php if( isset($dados["campoTelefone"]) ){ ?><?php echo htmlspecialchars( $dados["campoTelefone"], ENT_COMPAT, 'UTF-8', FALSE ); ?><?php } ?>">
                </div>
                <!-- /.input group -->
              </div>
        </div>

        <div class="col-md-6">
              <div class="form-group">
                <label for="campoTelefone2">Celular:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-mobile"></i>
                  </div>
                  <input type="tel" id="campoTelefone2" class="form-control"  placeholder="(71) 98888-0000" name="campoTelefone2" onkeyup="validaCelular();" maxlength="15" value="<?php if( isset($dados["campoTelefone2"]) ){ ?><?php echo htmlspecialchars( $dados["campoTelefone2"], ENT_COMPAT, 'UTF-8', FALSE ); ?><?php } ?>" >
                </div>
                <!-- /.input group -->
              </div>
        </div>

</div>
          


        

            

       



<!--
            <div class="checkbox">
              <label>
                <input type="checkbox" name="inadmin" value="1"> Acesso de Administrador
              </label>
            </div>
          </div>
-->

          <!-- /.box-body -->
          <div class="box-footer">
           <div class="col-md-12"> 

          

           
            <a><button type="submit" class="btn btn-primary"><b><i class="fa fa-check"></i>&nbsp CADASTRAR</b></button></a>  
            <a href="javascript:history.back();"><button type="button" class="btn btn-default navbar-right"><b>&nbsp VOLTAR</b></button></a>
    


          </div>
          </div>
        </form>
      </div>
    </div>
  </div>

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
