<!DOCTYPE html>
<html lang="pt" dir="ltr">
  <head>
    <meta charset="utf-8"/>
      <title>Tela de Login</title>
    <link rel="stylesheet" type="text/css" href="css/estilo.css"/>
    <?php include_once ('icon.php'); ?>
  </head>
  <body>
    <?php include 'menu/men_index.php'; ?>
    <h1>Tela de login</h1>
    <?php session_start();
          if(isset($_SESSION['nao_autenticado'])){ ?>
            <h3>ERRO: Usuario ou senha invalidos</h3>
      <?php };
          unset($_SESSION['nao_autenticado']);
      ?>
    <div class="main_login">
        <fieldset>
            <form action="proc-login.php" method="POST">
                <p>E-mail:</p>
                  <p><input type="text" name="login" placeholder="Digite seu nome"/></p>
                <p>Senha:</p>
                  <p><input type="password" name="senha" placeholder="Digite sua Senha"/></p>
                  <div class="centro padding">
        				<button>Entrar</button>
        		   </div>
            </form>
        </fieldset>
    </div>
  </body>
</html>
