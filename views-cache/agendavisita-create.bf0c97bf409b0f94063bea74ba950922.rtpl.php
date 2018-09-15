<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <small>CADASTRO DE EMPRESA PARA VISITA</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="/admin"><i class="fa fa-home"></i> Início</a></li>
    <li><a href="#">Agendar Visita</a></li>
    
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">


<div class="box-header">
    <center><h4 class=""><b>VISITA</b><a href="javascript:history.back();"><button class="btn btn-link navbar-right" style="margin-left: 50px;"><b>Voltar</b></button></a></h4></center>
    <?php if( isset($error["error"]) ){ ?><br>
    <div class="alert alert-danger" role="alert">
      <center><b><?php echo htmlspecialchars( $error["error"], ENT_COMPAT, 'UTF-8', FALSE ); ?></b></center>
    </div>
    <?php } ?>

<br>
<div class="row">
  <div class="col-md-6">
     <form role="form" action="/admin/agendarvisita/<?php echo htmlspecialchars( $empresa["idEmpresas"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="post" id="formEmpresa">
      <input hidden name="idEmpresa" value="<?php echo htmlspecialchars( $empresa["idEmpresas"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"> 
    <div class="form-group">
        <label for="dataPrevista">Data prevista para visita: *</label>
        <input type="date" class="form-control" id="dataPrevista" name="dataPrevista" placeholder="dd/mm/aaaa"  maxlength="10" required value="<?php if( isset($dados["dataPrevista"]) ){ ?><?php echo htmlspecialchars( $dados["dataPrevista"], ENT_COMPAT, 'UTF-8', FALSE ); ?><?php } ?>">
      </div>
  </div>

  <div class="col-md-6">
    <label for="campoStatus" >Status Inicial de Visita: </label>
    <select name="campoStatus" class="form-control" id="campoStatus" disabled="">
      <option value="Sem Ação">Sem Ação</option>
      <option value="Visita Agendada">Visita Agendada</option>
      <option value="Visita Realizada">Visita Realizada</option>
      <option value="Sem Sucesso no Agendamento">Sem Sucesso no Agendamento</option>
    </select>
  </div>
</div>
  <div class="row">
    <div class="col-md-6">
      <label for="campoDemanda">Demanda inicial: *</label>
      <select name="campoDemanda" id="campoDemanda" class="form-control">
        <?php if( isset($dados["campoDemanda"]) ){ ?><option value="<?php echo htmlspecialchars( $dados["campoDemanda"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $dados["campoDemanda"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option><?php } ?>

       <optgroup label="CASAS"> 
          <option value="IEL">IEL</option>
          <option value="SESI">SESI</option>
          <option value="SENAI">SENAI</option>
          <option value="CIEB">CIEB</option>
       </optgroup> 

       <optgroup label="SINDICATO"> 
        <?php $counter1=-1;  if( isset($sindicatos) && ( is_array($sindicatos) || $sindicatos instanceof Traversable ) && sizeof($sindicatos) ) foreach( $sindicatos as $key1 => $value1 ){ $counter1++; ?>

          <option value="<?php echo htmlspecialchars( $value1["nome_sindicato"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" <?php if( $value1["nome_sindicato"] == $origem["origem"] ){ ?>selected<?php } ?>><?php echo htmlspecialchars( $value1["nome_sindicato"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
         <?php } ?> 
       </optgroup> 
      </select>
</div>
      <div class="col-md-6">
        <label for="campoFamilia">Família do Produto Ofertado:</label>
        <select name="campoFamilia" id="campoFamilia" class="form-control">
          <option value=""></option>
          <option value="Qualidade de Vida">Qualidade de Vida</option>
          <option value="Desenvolvimento de Carreiras">Desenvolvimento de Carreiras</option>
          <option value="Desenvolvimento Empresarial">Desenvolvimento Empresarial</option>
          <option value="Educação">Educação</option>
        </select>
        
      </div>
      

      <div class="col-sm-12"><br>
        <label for="campoObservacao">Observação:</label><textarea name="campoObservacao" id="campoObservacao" class="form-control" maxlength="300" rows="4"><?php if( isset($dados["campoObservacao"]) ){ ?><?php echo htmlspecialchars( $dados["campoObservacao"], ENT_COMPAT, 'UTF-8', FALSE ); ?><?php } ?></textarea>
      </div>
    
  </div>

</div>

<br>


        <div class="col-md-12"><br>
          <center>
            <h3 class="box-title" style="vertical-align: middle;"><b>CADASTRO DE EMPRESA/VISITA</b></h3>
            <!--<a href="javascript:history.back();"><button class="btn btn-link navbar-right"><b>Voltar</b></button></a>-->
          </center>
        </div>

        </div>
        <!-- /.box-header -->
        <!-- form start -->
       
          <div class="box-body">

          <div class="form-group">
              <label for="campoCNPJ">CNPJ: *</label>
              <input type="tel" class="form-control" id="campoCNPJ" name="cnpj" placeholder="Digite apenas números" value="<?php echo htmlspecialchars( $empresa["cnpj"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" onkeyup="formatCNPJ();"  maxlength="15" readonly>
            </div>




            <div class="form-group">
              <label for="campoRazaoSocial">Razão Social: *</label> 
              <input type="text" class="form-control" id="campoRazaoSocial" name="razaoSocial" placeholder=""  value="<?php echo htmlspecialchars( $empresa["razao_social"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" onkeypress="formatRazaoSocial();" maxlength="50" required readonly>
            </div>

            <div class="form-group">
              <label for="campoNomeFantasia" >Nome Fantasia: *</label>
              <input type="tel" class="form-control" id="campoNomeFantasia" name="nomeFantasia" placeholder="" value="<?php echo htmlspecialchars( $empresa["nome_fantasia"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" onkeypress="formatNomeFantasia();" required readonly>
            </div>

            <div class="form-group">
              <label for="campoSitAssoc" >Situação da Associação: *</label>
              <select name="sitAssoc" class="form-control" onchange="verificaAssoc();" disabled="">

                <option value="Não Associada" <?php if( $empresa["situacao_associacao"] == 'Não Associada' ){ ?>selected<?php } ?>>Não Associada</option>
                <option value="Associada" <?php if( $empresa["situacao_associacao"] == 'Associada' ){ ?>selected<?php } ?>>Associada</option>
                <option value="Associação em Negociação" <?php if( $empresa["situacao_associacao"] == 'Associação em Negociação' ){ ?>selected<?php } ?>>Associacão em Negociação</option>
                <option value="Associação Efetivada" <?php if( $empresa["situacao_associacao"] == 'Associação Efetivada' ){ ?>selected<?php } ?>>Associação Efetivada</option>

              </select>
            </div>

            <div class="form-group">
              <label for="campoAssoc" >Empresa Associada à: </label>
              <select name="Assoc" class="form-control" id="Assoc" disabled="">

                <option value="Não Associada" <?php if( $empresa["situacao_associacao"] == 'Associação em Negociação' ){ ?>selected<?php } ?>>Não Associada</option>
                

                <optgroup label="SINDICATO">
                 <?php $counter1=-1;  if( isset($sindicatos) && ( is_array($sindicatos) || $sindicatos instanceof Traversable ) && sizeof($sindicatos) ) foreach( $sindicatos as $key1 => $value1 ){ $counter1++; ?> 
                  <option value="<?php echo htmlspecialchars( $value1["idSindicato"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" <?php if( $empresa["Sindicato_idSindicato"] == $value1["idSindicato"] ){ ?>selected<?php } ?> ><?php echo htmlspecialchars( $value1["nome_sindicato"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                  <?php } ?> 

             

                </optgroup>
                
                
              </select>
            </div>




  <div class="row">

    <div class="col-md-6">
            <div class="form-group">
                 <label for="campoCidade" >Cidade/Município: *</label>
                     <select name="campoCidade" id="campoCidade" onchange="validaCidade();" class="form-control" disabled>
                            <option value="">Selecione a cidade</option>
                            <option value="Abaíra">Abaíra</option>
                            <option value="Abaré">Abaré</option>
                            <option value="Feira de Santana">Feira de Santana</option>
                            <option value="Paulo Afonso">Paulo Afonso</option>  
                            <?php $counter1=-1;  if( isset($cidades) && ( is_array($cidades) || $cidades instanceof Traversable ) && sizeof($cidades) ) foreach( $cidades as $key1 => $value1 ){ $counter1++; ?>

                              <option value="<?php echo htmlspecialchars( $value1["cidade"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" <?php if( $empresa["municipio"] == $value1["cidade"] ){ ?>selected<?php } ?>><?php echo htmlspecialchars( $value1["cidade"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option> 
                            <?php } ?>      
                      </select>
              </div>

      </div>

      <div class="col-md-6">

          <div class="form-group">
              <label for="campoRegiao">Região:</label>
              <input type="text" class="form-control" id="campoRegiao" name="campoRegiao" placeholder="" readonly="" value="<?php echo htmlspecialchars( $empresa["regiao_estado"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
            </div>
      </div>

  </div>







        
          <div class="form-group">
              <label for="campoBairro">Bairro:</label>
              <input type="text" class="form-control" id="campoBairro" name="campoBairro" placeholder="Nome do bairro" maxlength="28" onkeypress="formatBairro();" value="<?php echo htmlspecialchars( $empresa["bairro"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" readonly>
            </div>


            <div class="form-group">
              <label for="campoEndereco">Endereço: </label>
              <input type="text" class="form-control" id="campoEndereco" name="campoEndereco" placeholder="Ex: Rua Américo de Oliveira, N47" maxlength="80" onkeypress="formatEndereco();" value="<?php echo htmlspecialchars( $empresa["endereco"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" readonly>
            </div>



              <div class="form-group">
              <label for="campoEmail">E-mail de Contato: </label>
            <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-at"></i>
                </div> 
                  <input type="email" class="form-control" id="campoEmail" name="email" placeholder="empresa@dominio.com" maxlength="50" value="<?php echo htmlspecialchars( $empresa["email"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" readonly>
            </div>  
        </div>


<div class="row">

      <div class="col-md-6">
             <div class="form-group">
                <label for="campoTelefone">Telefone da empresa:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-phone"></i>
                  </div>
                  <input type="tel" id="campoTelefone" class="form-control" placeholder="(71) 3333-2222" name="campoTelefone" onkeyup="validaTelefone();" maxlength="14" value="<?php echo htmlspecialchars( $empresa["telefone"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" readonly>
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
                  <input type="tel" id="campoTelefone2" class="form-control"  placeholder="(71) 98888-0000" name="campoTelefone2" onkeyup="validaCelular();" maxlength="15" value="<?php echo htmlspecialchars( $empresa["telefone2"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" readonly>
                </div>
                <!-- /.input group -->
              </div>
        </div>

</div>
          




</div>
        

          
       



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
