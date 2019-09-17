<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8"/>
    <title>Criar Noticias</title>
  <?php include_once ('icon.php');?>
    <link rel="stylesheet" type='text/css' href="css/estilo.css"/>
    <script src="https://cdn.tiny.cloud/1/0cyyd9chleyesdrd8ykoku69kactuksxhquf2xql0z2jahi3/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>tinymce.init({selector:'textarea'});</script>
</head>
<body>
    <?php
      include_once ('../conexao.php');
      include_once ('verifica-login.php');
      include_once ('menus/menu-index.php');
    ?>
      <h2>Desenvolvimento de noticia</h2>
    <fieldset>
        <form action="cad-not.php" method="post" enctype="multipart/form-data"/>
            <p>Titulo:</p>
                <p><input type="text" name="titulo"/></p>
                <P>Escolha a Foto:</p>
                    <p><input type="file" name="img"/></p>
            <textarea name="noticia">Crie sua noticia!</textarea>
                <input type="hidden" name="id" value="<?php echo $_SESSION['id_user'];?>"/>
             <div class="centro padding">
                 <button>Enviar</button>
             </div>
        </form>
    </fieldset>
          <h2>Noticias Já Criadas</h2>

    <table border= 1 class='tabela_not'>
      <tr>
        <td>Noticia</td>
        <td>Editar</td>
        <td>Excluir</td>
      </tr>
      <?php
         $id = $_SESSION['id_user'];

        $sql = "SELECT * FROM noticia WHERE id_usunot= $id";
      $query = mysqli_query($conexao,$sql);
      while($nots = mysqli_fetch_assoc($query)){
          echo "
                <tr>
                    <td>$nots[titulo]</td>
                    <form action='edit-not.php?idnot=$nots[id_not]' method='POST'>
                      <td><input type='submit' name='escolha' value='editar'/></td>
                    </form>
                    <form action='edit-notfim.php' method='POST'>
                      <td><input type='submit' name='escolha' value='excluir'/></td>
                          <input type='hidden' name='idnot' value='$nots[id_not]'/>
                    </form>
                </tr>";
      };
      echo '</table>';
      //echo $nots['id_not'];
      //echo "teste";
      ?>

</body>
</html>
