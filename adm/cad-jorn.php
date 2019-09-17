<!DOCTYPE html>
<html lang="pt" dir="ltr">
  <head>
    <meta charset="utf-8"/>
    <title>Cadastrar Jornalista</title>
    <link rel="stylesheet" type="text/css" href="css/estilo.css"/>
    <?php include_once ('icon.php');?>
  </head>
  <body>
    <?php
    include ('menus/menu-index.php');
           include ('verifica-login.php');?>
        <h2>Bem Vindo! Cadastra-se:</h2><br/>
        <?php
              if(isset($_SESSION['usuario_existe'])){ ?>
                  <h3>Email já Existe!</h3>
              <?php }
                if(isset($_SESSION['cadastrado-sucesso'])){ ?>
                    <h3>Cadastrado com Sucesso!</h3>
                <?php }
                  unset($_SESSION['usuario_existe']);
                  unset($_SESSION['cadastrado-sucesso']);
                  ?>
    <div class="main_login">
          <fieldset>
                  <form action="proc-cadjor.php" method="POST" enctype="multipart/form-data">
                        <p>Nome:</p>
                            <p><input type="text" name="nome" placeholder="Digite seu nome"/></p>
                        <p>Sexo:</p>
                            <p><input type="radio" name="sexo" value="m">Masculino</p>
                            <p><input type="radio" name="sexo" value="f">Feminino</p>
                        <p>Foto:</p>
                            <p><input type="file" name='foto'/></p>
                        <p>E-Mail:</p>
                            <p><input type="text" name="email" placeholder="Digite seu E-mail"></p>
                        <p>Celular:</p>
                            <p><input type="text" name="cel" placeholder="(xx)xxxxx-xxxx"/></p>
                        <p>senha:</p>
                          <p><input type="text" name="vsenha" placeholder="Digite a senha"/></p>
                        <p>Confirme a Senha:</p>
                          <p><input type="password" name="senha" placeholder="Digite a senha novamente"/></p>
                    <div class="centro padding">
                      <button>Cadastrar-se</button>
                    </div>
                </form>
          </fieldset>
    </div>
  </body>
</html>
