<?php if(!class_exists('Rain\Tpl')){exit;}?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SISTEMA DE GESTÃO ARTICULADA | Cadastre-se</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="../res/site/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../res/site/dist/css/AdminLTE.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../res/site/plugins/iCheck/square/blue.css">

  <link rel="stylesheet" href="../res/site/dist/css/estilo.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition register-page azul">
<div class="register-box">
  <div class="register-logo">
    <div class="lockscreen-logo">
    <img src="../res/site/dist/img/LOGO01BRANCO.png" height="" class="img-responsive"></img>
  </div>
  </div>

  <div class="register-box-body">
    <p class="login-box-msg"><b>CADASTRO DE NOVO USUÁRIO</b></p>
    <?php if( isset($error["error"]) ){ ?>

    <div class="alert alert-danger" role="alert">
          <center><b><?php echo htmlspecialchars( $error["error"], ENT_COMPAT, 'UTF-8', FALSE ); ?></b></center>
    </div>
    <?php } ?>

    <form id="register" action="" method="post">
      <div class="form-group has-feedback">
        <label for="campoNome">Nome: *</label>
        <input type="text" class="form-control" placeholder="Ex: João Silva" name="campoNome" id="campoNome" maxlength="25" required onkeypress="toUpperName();" autofocus="" value="<?php if( isset($dados["campoNome"]) ){ ?><?php echo htmlspecialchars( $dados["campoNome"], ENT_COMPAT, 'UTF-8', FALSE ); ?><?php } ?>">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <label for="campoCPF">CPF: *</label>
        <input type="tel" class="form-control" placeholder="Digite apenas números" maxlength="14" name="campoCPF" id="campoCPF" onkeyup="validaCPF(this);" required value="<?php if( isset($dados["campoCPF"]) ){ ?><?php echo htmlspecialchars( $dados["campoCPF"], ENT_COMPAT, 'UTF-8', FALSE ); ?><?php } ?>">
        <span class=" form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <label for="campoCargo">Cargo: *</label>
        <input class="form-control" type="text" name="campoCargo" placeholder="Ex: Agente/Diretor/Executivo" id="campoCargo" maxlength="25" required onkeypress="toUpperCargo();" value="<?php if( isset($dados["campoCargo"]) ){ ?><?php echo htmlspecialchars( $dados["campoCargo"], ENT_COMPAT, 'UTF-8', FALSE ); ?><?php } ?>">
        <span class="glyphicon glyphicon glyphicon-briefcase form-control-feedback"></span>
      </div>
      <div class="form-group">
        <label>Origem: </label>
        <select name="campoOrigem" class="form-control" id="campoOrigem">
          <option value="">Entidade a qual pertence o usuário</option>
          <?php if( isset($dados["campoOrigem"]) ){ ?><option value="<?php echo htmlspecialchars( $dados["campoOrigem"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" selected><?php echo htmlspecialchars( $dados["campoOrigem"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option><?php } ?>
          <option value="FIEB">FIEB</option>
         <optgroup label="CASAS"> 
          <option value="IEL">IEL</option>
          <option value="SESI">SESI</option>
          <option value="SENAI">SENAI</option>
          <option value="CIEB">CIEB</option>
         </optgroup>
          <optgroup label="SINDICATOS"> 
        
          <?php $counter1=-1;  if( isset($sindicatos) && ( is_array($sindicatos) || $sindicatos instanceof Traversable ) && sizeof($sindicatos) ) foreach( $sindicatos as $key1 => $value1 ){ $counter1++; ?>
                    <option value="<?php echo htmlspecialchars( $value1["nome_sindicato"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["nome_sindicato"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                  <?php } ?>
         </optgroup> 

        </select>
      </div>
      <div class="form-group has-feedback">
        <label>Email:</label>
        <input type="email" class="form-control" placeholder="exemplo@dominio.com" name="campoEmail" required value="<?php if( isset($dados["campoEmail"]) ){ ?><?php echo htmlspecialchars( $dados["campoEmail"], ENT_COMPAT, 'UTF-8', FALSE ); ?><?php } ?>">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <label>Senha:</label>
        <input type="password" class="form-control"  name="senha1" required maxlength="15" placeholder="No máximo 15 caracteres">
        <span class="glyphicon glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control"  required maxlength="15" name="senha2" placeholder="Confirmar senha">
        <span class="glyphicon glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
           
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat"><b>CADASTRAR</b></button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <br>
    <center><a href="/login" class="text-center">Eu já tenho uma conta</a></center>
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->

<!-- jQuery 2.2.3 -->
<script src="../res/site/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../res/site/bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="../res/site/plugins/iCheck/icheck.min.js"></script>

<script src="../../res/site/dist/js/validacoes.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
