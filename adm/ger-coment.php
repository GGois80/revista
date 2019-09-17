<html>
  <head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type='text/css' href="css/estilo.css"/>
    <?php include_once ('icon.php'); ?>
  </head>
  <body>
    <?php
      include_once ('../conexao.php');
      include_once ('verifica-login.php');
      include_once ('menus/menu-index.php');
    ?>
      <h2>Bem vindo! <?php echo $_SESSION['nome'];?> Administrador</h2><br/>

        <table>
            <tr>
              <td>Comentario</td>
              <td>Aprovar</td>
              <td>Excluir</td>
            </tr>
      <?php $sql = "SELECT id_com,comentario FROM comentarios WHERE moderado = 1 ORDER BY comentario ASC";
          $query = mysqli_query($conexao,$sql);
          //print_r($teste); exit();
          while($com = mysqli_fetch_assoc($query)){
              echo "
                <tr>
                  <td>$com[comentario]</td>
                  <form action='aprov-com.php' method='POST'>
                      <td><input type='submit' name='escolha' value='aprovado'/></td>
                      <input type='hidden' name='idcom' value='$com[id_com]'/>
                  </form>
                  <form action='aprov-com.php' method='POST'>
                      <td><input type='submit' name='escolha' value='excluir'/></td>
                      <input type='hidden' name='idcom' value='$com[id_com]'/>
                  </form>
                </tr>
              ";
          };
          echo "</table>";

      ?>
  </body>
</html>
