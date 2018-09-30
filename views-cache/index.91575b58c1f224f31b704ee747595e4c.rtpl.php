<?php if(!class_exists('Rain\Tpl')){exit;}?>

<body class="hold-transition  azul">
<div class="login-box">


  <div class="register-logo">
    <div class="lockscreen-logo">
    <img src="../res/site/dist/img/LOGO01BRANCO.png" height="" class="img-responsive"></img>
  </div>
  </div>


  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Inicie sua sessão</p>

    <form action="/login" method="post">
      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Email" name="login" required="">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Senha" name="senha" required="">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Me mantenha conectado
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat"><B>ENTRAR</B></button>
        </div>
        <!-- /.col -->
      </div>
    </form>

<!--

    <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a> 
    </div>

    -->
    <!-- /.social-auth-links -->

    <a href="/forgot">Esqueci minha senha</a><br>
    <a href="/register" class="text-center">Cadastre-se</a>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

