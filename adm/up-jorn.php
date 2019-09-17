<?php include_once ('../conexao.php');
  session_start();
     $id = $_POST['id'];

             $sql = "SELECT * FROM usuario WHERE id_usuario= $id";
           $query = mysqli_query($conexao,$sql);
        $detalhes = mysqli_fetch_array($query);
$_SESSION['jorn'] = $detalhes['nome'];
            $sexo = $detalhes['sexo'];
             $img = $detalhes['foto'];
?>

<html>
    <head>
        <meta charset="utf-8"/>
            <title>Atualizar Dados de <?php echo $_SESSION['jorn'];?></title>
        <link rel="stylesheet" type="text/css" href="css/estilo.css"/>
        <?php include_once ('icon.php');?>
    </head>
    <body>
        <?php
              include_once ('menus/menu-index.php'); ?>
             <h2>Editar Dados do Jornalista <?php echo $_SESSION['jorn']?></h2></br>
             <div class="imgjorn">
              <img src="../img_usuarios/<?php echo $img;?>"/>
            </div>
        <div class="main_login">
            <fieldset>
                <form action="up-jornfim.php" method="POST" enctype="multipart/form-data">
                    <P>nome:</p>
                        <p><input type='text' name='nome' value='<?php echo $detalhes['nome']?>'/></p>
                    <p>sexo:</p>
                <?php switch ($sexo) {
                        case 'm':
                            echo "<p>
                                    <input type='radio' name='sexo' value='m' checked/>Masculino
                                    </p>
                                        <p>
                                            <input type='radio' name='sexo' value='f'/>Feminino
                                        </p>";
                            break;

                        case 'f':
                        echo "<p>
                                        <input type='radio' name='sexo' value='m'/>Masculino
                                    </p>
                                    <p>
                                        <input type='radio' name='sexo' value='f' checked/>Feminino
                                    </p>";
                            break;
                    };
                    ?>
                    <p>email:</p>
                        <p><input type='text' name='email' value='<?php echo $detalhes['email']?>'/></p>
                    <p>foto:</p>
                        <p><input type='file' name='foto'/></p>
                    <p>celular:</p>
                        <p><input type='text' name='cel' value='<?php echo $detalhes['cel']?>'/></p>
                    <p>Nova Senha:</p>
                        <p><input type='text' name='vsenha' placeholder="Digite a Senha"/></p>
                    <p>Confirme a senha:</p>
                        <p><input type='password' name='senha'placeholder="Digite a Senha Novamente"/></p>
                          <p><input type='hidden' name='escolha' value='editar'/></p>
                          <p><input type='hidden' name='id' value='<?php echo $detalhes['id_usuario'];?>'/></p>
                    <div class="centro padding">
                        <button>Entrar</button>
                    </div>
                </form>
            </fieldset>
        </div>
    </body>
</html>
