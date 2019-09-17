<!DOCTYPE html>
<html lang="pt" dir="ltr">
  <head>
    <meta charset="utf-8">
      <title>Cadastrar Usuario</title>
    <link rel="stylesheet" type="text/css" href="css/estilo.css"/>
    <?php include_once ('icon.php'); ?>
  </head>
  <body>
      <?php include 'menu/men_index.php'; ?>
        <h1>Bem Vindo! Cadastra-se:</h1><br/>
        <?php session_start();
              if(isset($_SESSION['usuario_existe'])){ ?>
                  <h3>Email já Existe!</h3>
              <?php };
                  unset($_SESSION['usuario_existe']);
                  ?>
    <div class="main_login">
          <fieldset>
              <form action="proc-caduser.php" method="POST" enctype="multipart/form-data" >
                  <p>Nome:</p>
                    <p><input type="text" name="nome" placeholder="Digite seu nome"/></p>
                  <p>Sexo:</p>
                    <p><input type="radio" name="sexo" value="m">Masculino</p>
                    <p><input type="radio" name="sexo" value="f">Feminino</p>
                  <p>Foto:</p>
                    <p><input type="file" name='foto'/></p>
                  <p>E-Mail:</p>
                    <p><input type="text" name="email" placeholder="Digite seu E-Mail"></p>
                  <p>Celular:</p>
                    <p><input type="text" name="cel" placeholder="(xx)xxxxx-xxxx"/></p>
                  <p>Senha:</p>
                    <p><input type="password" name="senha" placeholder="Digite sua senha"/></p>
              <div class="centro padding">
                <button>Cadastrar-se</button>
              </div>
              </form>
          </fieldset>
    </div>
  </body>
</html>
